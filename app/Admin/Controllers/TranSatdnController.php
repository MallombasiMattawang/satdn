<?php

namespace App\Admin\Controllers;

use App\Models\AdminUser;
use App\Models\TranSatdn;
use App\Models\User;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Layout\Content;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SatsdnPemegangIzin;
use App\Models\configSatdn;
use App\Models\PemegangIzin;
use PhpOffice\PhpSpreadsheet\IOFactory;

class TranSatdnController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'SATS-DN PEMEGANG IZIN';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function all($tipe, Content $content)
    {
        $grid = new Grid(new TranSatdn());

        $grid->column('invoice', __('Invoice'));
        $grid->column('pemegangIzin.nama_perusahaan', __('Pemegang izin'));
        $grid->column('no_permohonan_angkut', __('No permohonan angkut'));
        $grid->column('alat_angkut', __('Alat angkut'));
        $grid->column('dari', __('Dari'));
        $grid->column('ke', __('Ke'));
        $grid->column('jenis_tsl', __('Jenis tsl'));
        $grid->column('satuan', __('Satuan'));
        $grid->column('jumlah_kirim', __('Jumlah kirim'));


        if ($tipe == 'masuk') {
            $header = 'Masuk';
            $grid->model()->whereNull('status');
            $grid->model()->orWhere('status', 'VERIFIKASI TEKNIS');
            $grid->column('posisi', __('Posisi'));
            $grid->column('status', __('Status'));
            $grid->column('status_ket', __('Status ket'));
        }
        if ($tipe == 'proses') {
            $header = 'Proses';
            $grid->model()->where('status', 'KUNJUNGAN LAPANGAN');
            $grid->model()->orWhere('status', 'PANGGILAN KONSULTASI');
            $grid->model()->orWhere('status', 'VERIFIKASI TEKNIS BERHASIL');
            $grid->column('posisi', __('Posisi'));
            $grid->column('status', __('Status'));
            // $grid->column('status_ket', __('Status ket'));
        }
        if ($tipe == 'keluar') {
            $header = 'Selesai';
            $grid->model()->where('status', 'SELESAI');
            $grid->column('dikeluarkan_di', __('Dikeluarkan di'));
            $grid->column('tgl_satdn_mulai', __('Tgl satdn mulai'));
            $grid->column('tgl_satdn_habis', __('Tgl satdn habis'));
        }
        if ($tipe == 'ditolak') {
            $header = 'Ditolak';
            $grid->model()->where('status', 'VERIFIKASI TEKNIS DITOLAK');
        }
        $grid->column('custom_url', 'Action')->display(function ($value, $column) {
            if ($this->status == 'VERIFIKASI TEKNIS BERHASIL' || $this->status == 'SELESAI') {
                return "
                    <a class='btn btn-info btn-sm' href='/admin-panel/tran-satdn/rincian/$this->id'><i class='fa fa-search'></i> Rincian</a>
                    <a class='btn btn-success btn-sm' href='/admin-panel/tran-satdn/cetak/$this->id'><i class='fa fa-print'></i> Cetak SATS-DN</a>
                ";
            } else {
                return "<a class='btn btn-info btn-sm' href='/admin-panel/tran-satdn/rincian/$this->id'><i class='fa fa-search'></i> Rincian</a>";
            }
        });

        $grid->paginate(50);
        $grid->disableCreateButton();
        $grid->disableActions();
        $grid->disableRowSelector();
        $grid->filter(function ($filter) {
            $filter->disableIdFilter();

            $filter->like('pemegangIzin.nama_perusahaan', 'Pemegang Izin');
            $filter->like('jenis_tsl', 'TSL');
            $filter->like('invoice', 'Invoice');

            // Tambahkan filter lainnya yang Anda butuhkan
        });

        return $content
            ->header('Permohonan SATS-DN Pemegang Izin ' . $header)
            // ->description('Data DTDC')
            ->body(view('admin.modules.tran-satdn.all'))
            ->body($grid);
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function rincian($id, Content $content)
    {
        $show = new Show(TranSatdn::findOrFail($id));
        $data = TranSatdn::findOrFail($id);
        $show->panel()
            ->tools(function ($tools) use ($id) {
                $tools->disableDelete();
                $tools->disableEdit();
                $tools->append('<a href="/admin-panel/tran-satdn/' . $id . '/edit" class="btn btn-warning ">VERIFIKASI TEKNIS</a>');
            });

        $show->field('invoice', __('Invoice'));
        $show->field('updated_at', __('Dibuat pada'));
        $show->field('no_permohonan_angkut', __('No permohonan angkut'));
        $show->field('tgl_permohonan_angkut', __('Tgl permohonan angkut'));

        $show->file_permohonan()->as(function ($file_permohonan) {
            return "<a href='/{$file_permohonan}' target='_blank' class='btn btn-default btn-sm'>Download Dokumen</a>";
        });
        $show->field('no_satdn_asal', __('No satdn asal'));
        $show->field('nama_penerima', __('Penerima (Nama/Perusahaan/Lembaga)'));
        $show->field('telepon_penerima', __('Telepon penerima'));
        $show->field('fax_penerima', __('Fax penerima'));
        $show->field('alamat_lengkap_penerima', __('Alamat lengkap penerima'));
        $show->field('alat_angkut', __('Alat angkut'));
        $show->field('dari', __('Dari'));
        $show->field('ke', __('Ke'));
        $show->field('jenis_tsl', __('Jenis tsl'));
        $show->field('satuan', __('Satuan'));
        $show->field('jumlah_kirim', __('Jumlah kirim'));
        $show->field('pemegangIzin.kuota_sisa', __('Sisa Kuota Pengirim'));
        $show->field('adminTeknis.name', __('Verifikator teknis'));
        // $show->field('posisi', __('Posisi'));
        // $show->field('status', __('Status'));
        // $show->field('status_ket', __('Status ket'));
        if ($show->status() == 'VERIFIKASI TEKNIS BERHASIL') {
            $show->field('date_verified_teknis', __('Date verified teknis'));
            $show->field('verifikator_teknis', __('Verifikator teknis'));
            $show->field('ket_teknis', __('Ket teknis'));
            $show->field('no_bap', __('No bap'));
            $show->field('file_bap', __('File bap'));
            $show->field('no_spt', __('No spt'));
            $show->field('file_spt', __('File spt'));
            $show->field('no_satdn', __('No satdn'));
            $show->field('dikeluarkan_di', __('Dikeluarkan di'));
            $show->field('tgl_satdn_mulai', __('Tgl satdn mulai'));
            $show->field('tgl_satdn_habis', __('Tgl satdn habis'));
            $show->field('pj_ttd', __('Pj ttd'));
            $show->field('pj_nip', __('Pj nip'));
        }



        return $content
            ->header('Permohonan SATS-DN Pemegang Izin ')
            // ->description('Data DTDC')
            ->body(view('admin.modules.tran-satdn.rincian', ['data' => $data]))
            ->body($show);
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new TranSatdn());

        $form->tab('Rincian', function ($form) {
            $form->text('pemegangIzin.nama_perusahaan', __('Pengirim / Pemegang izin Edar'))->readonly();;
            $form->hidden('user_id');
            $form->hidden('pemegang_izin_id');
            $form->text('invoice', __('Invoice'))->readonly();
            $form->text('no_permohonan_angkut', __('No permohonan angkut'));
            $form->text('no_satdn_asal', __('No satdn asal'));
            $form->text('nama_penerima', __('Nama penerima'));
            $form->text('telepon_penerima', __('Telepon penerima'));
            $form->text('fax_penerima', __('Fax penerima'));
            $form->text('alamat_lengkap_penerima', __('Alamat lengkap penerima'));
            $form->text('alat_angkut', __('Alat angkut'));
            $form->text('dari', __('Dari'));
            $form->text('ke', __('Ke'));
            $form->text('jenis_tsl', __('Jenis tsl'))->readonly();
            $form->text('satuan', __('Satuan'))->readonly();
            $form->number('jumlah_kirim', __('Jumlah kirim'));
        })->tab('Daftar TSL', function ($form) {
            $form->hasMany('tranSatdnLampiran', 'Formulir Daftar TSL', function (Form\NestedForm $form) {
                //$form->text('kode','KODE');
                $form->text('nama_indonesia', 'Nama Indonesia')->icon('fa-cog');
                $form->text('nama_latin', 'Nama Latin');
                $form->number('jumlah', 'Jumlah');
                $form->text('satuan', 'Satuan');
                $form->text('keterangan', 'Keterangan');
            });
        })->tab('Verifikasi Teknis', function ($form) {
            $form->text('posisi', 'Posisi')->readonly();
            $form->select('status', __('Status Verifikasi Teknis'))->options([
                'VERIFIKASI TEKNIS DITOLAK' => 'VERIFIKASI TEKNIS DITOLAK',
                'VERIFIKASI TEKNIS BERHASIL' => 'VERIFIKASI TEKNIS BERHASIL',
                'PANGGILAN KONSULTASI' => 'PANGGILAN KONSULTASI',
                'KUNJUNGAN LAPANGAN' => 'KUNJUNGAN LAPANGAN',
                'SELESAI' => 'SELESAI'
            ])->rules('required');
            $form->textarea('status_ket', __('Keterangan Status'));
            $form->select('admin_teknis', 'Rekomendasi Teknis')->options(AdminUser::where('id', '>', '25')->pluck('name', 'id'));
            $form->datetime('date_verified_teknis', __('Waktu verifikasi teknis'))->default(date('Y-m-d H:i:s'));
            $form->text('verifikator_teknis', __('Nama/NIP Verifikator'));
            $form->text('no_bap', __('Nomor BAP'));
            $form->file('file_bap', 'Dokumen BAP')->rules('mimes:pdf')->move('rekomendasi_teknis')->help('Upload surat BAP untuk permohonan ini jika verifikasi berhasil');
            $form->text('no_spt', __('Nomor SPT'));
            $form->file('file_spt', 'Dokumen SPT')->rules('mimes:pdf')->move('rekomendasi_teknis')->help('Upload surat SPT untuk permohonan ini jika verifikasi berhasil');
        });

        $form->saved(function ($form) {
            $user = User::findOrFail($form->user_id);
            $details = [
                'title' => 'INVOICE:#' . $form->invoice . ' | ' . $form->status,
                'body' => strip_tags($form->status_ket),
            ];

            Mail::to($user->email)->send(new \App\Mail\NotifFo($details));

            //dd("Email sudah terkirim.");
            // redirect url
            if ($form->status == 'VERIFIKASI TEKNIS DITOLAK') {
                $pemegangIzin = PemegangIzin::where("id",  $form->pemegang_izin_id)->first();

                PemegangIzin::where("id",  $pemegangIzin->id)
                    ->update([
                        'kuota_digunakan' => $pemegangIzin->kuota_digunakan - $form->jumlah_kirim,
                        'kuota_sisa' => $pemegangIzin->kuota - ($pemegangIzin->kuota_digunakan - $form->jumlah_kirim),
                    ]);
http://127.0.0.1:8000/admin-panel/users

                admin_success('Permohonan Ditolak', 'Permohonan Invoice ' . $form->invoice . ' telah ditolak');
                return redirect('/admin-panel/tran-satdn/all/ditolak');
            } else {
                admin_success('Permohonan Diterima', 'Permohonan Invoice ' . $form->invoice . ' telah diverifikasi');
                return redirect('/admin-panel/tran-satdn/all/proses');
            }
        });

        return $form;
    }

    protected function cetak($id, Content $content)
    {
        $config = configSatdn::where('id', 1)->first();
        $tahun = date('Y');
        $bulan = sprintf('%02d', date('m'));
        $data = TranSatdn::findOrFail($id);
        return $content
            ->header('Cetak SATS-DN Pemegang Izin ')
            // ->description('Data DTDC')
            ->body(view(
                'admin.modules.tran-satdn.cetak',
                [
                    'data' => $data,
                    'config' => $config,
                    'tahun'  => $tahun,
                    'bulan' => $bulan
                ]
            ));
    }

    protected function generate(Request $request)
    {
        $request->validate([
            'no_satdn' => 'required',
            'dikeluarkan_di' => 'required',
            'tgl_satdn_mulai' => 'required',
            'tgl_satdn_habis' => 'required',
            'pj_ttd' => 'required',
            'pj_nip' => 'required',
            'pj_jabatan' => 'required',
            'tgl_dikeluarkan' => 'required',
        ], [
            'required' => ':attribute harus diisi',
        ]);

        $data = TranSatdn::findOrFail($request->id);
        $config = configSatdn::where('id', 1)->first();

        TranSatdn::where("id",  $request->id,)
            ->update([
                'status' => 'SELESAI',
                'posisi' => 'SELESAI',
                'no_satdn' => $request->no_satdn,
                'dikeluarkan_di' => $request->dikeluarkan_di,
                'tgl_satdn_mulai' =>  $request->tgl_satdn_mulai,
                'tgl_satdn_habis' =>  $request->tgl_satdn_habis,
                'tgl_dikeluarkan' => $request->tgl_dikeluarkan,
                'pj_ttd' =>  $request->pj_ttd,
                'pj_nip' => $request->pj_nip,
                'pj_jabatan' => $request->pj_jabatan,
            ]);

        // Mendapatkan path ke template Excel
        $templatePath = public_path('uploads/template_surat/satdn_no_lampiran.xlsx');

        // Baca template Excel
        $spreadsheet = IOFactory::load($templatePath);
        $sheet = $spreadsheet->getActiveSheet();

        // Ganti nilai dari sel tertentu dengan nilai variabel dari controller
        $sheet->setCellValue('I1', $request->no_satdn);
        $sheet->setCellValue('I2', tgl_indo($request->tgl_satdn_mulai));
        $sheet->setCellValue('I3', tgl_no_tahun($request->tgl_satdn_mulai) . '                    ' . tgl_indo($request->tgl_satdn_habis));
        $sheet->setCellValue('F13', $data->pemegangIzin->no_sk_oss);
        $sheet->setCellValue('F14', $data->no_permohonan_angkut);
        $sheet->setCellValue('F15', $data->no_bap);
        $sheet->setCellValue('F16', $data->no_satdn_asal ? $data->no_satdn_asal : '-');
        $sheet->setCellValue('K13', tgl_indo($data->pemegangIzin->tgl_sk_oss));
        $sheet->setCellValue('K14', tgl_indo($data->tgl_permohonan_angkut));
        $sheet->setCellValue('K15', tgl_indo($data->tgl_bap));
        $sheet->setCellValue('K16', $data->tgl_satdn_asal ? tgl_indo($data->tgl_satdn_asal) : '-');

        // Mendapatkan baris awal dan kolom awal untuk memulai iterasi
        $startRow = 27;
        $startRow1 = 27;
        $startRow2 = 27;
        $startRow3 = 27;
        $startRow4 = 27;
        $column = 'A';
        $n = 1;

        // Iterasi melalui data dan memasukkannya ke dalam sel yang sesuai
        foreach ($data->tranSatdnLampiran as $rowData) {

            // Set nilai untuk sel yang sesuai
            $sheet->setCellValue($column . $startRow, $n++);


            // Set ulang kolom menjadi awal dan pindah ke baris berikutnya
            $column = 'A';
            $startRow++;
        }

        // Iterasi melalui data dan memasukkannya ke dalam sel yang sesuai
        foreach ($data->tranSatdnLampiran as $rowData) {

            // Set nilai untuk sel yang sesuai
            $sheet->setCellValue('B' . $startRow1, $rowData->nama_indonesia);


            // Set ulang kolom menjadi awal dan pindah ke baris berikutnya
            $column = 'B';
            $startRow1++;
        }

        // Iterasi melalui data dan memasukkannya ke dalam sel yang sesuai
        foreach ($data->tranSatdnLampiran as $rowData) {

            // Set nilai untuk sel yang sesuai
            $sheet->setCellValue('E' . $startRow2, $rowData->nama_latin);


            // Set ulang kolom menjadi awal dan pindah ke baris berikutnya
            $column = 'E';
            $startRow2++;
        }

        // Iterasi melalui data dan memasukkannya ke dalam sel yang sesuai
        foreach ($data->tranSatdnLampiran as $rowData) {

            // Set nilai untuk sel yang sesuai
            $sheet->setCellValue('H' . $startRow3, $rowData->jumlah);


            // Set ulang kolom menjadi awal dan pindah ke baris berikutnya
            $column = 'H';
            $startRow3++;
        }

        // Iterasi melalui data dan memasukkannya ke dalam sel yang sesuai
        foreach ($data->tranSatdnLampiran as $rowData) {

            // Set nilai untuk sel yang sesuai
            $sheet->setCellValue('I' . $startRow4, $rowData->satuan);


            // Set ulang kolom menjadi awal dan pindah ke baris berikutnya
            $column = 'I';
            $startRow4++;
        }


        // Simpan perubahan ke dalam file sementara
        $tempFilePath = public_path('uploads/temp/temp_file.xlsx');
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save($tempFilePath);

        // Unduh file Excel yang telah dimodifikasi
        return response()->download($tempFilePath)->deleteFileAfterSend(true);
        // admin_success('Proses Cetak SATS-DN SELESAI');
        // return redirect()->back();
    }
}
