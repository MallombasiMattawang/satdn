<?php

namespace App\Admin\Controllers;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Models\Service;
use Encore\Admin\Layout\Row;
use App\Models\ProgresDocument;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\Dashboard;
use App\Admin\Actions\Post\BatchReplicate;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Widgets\Table;
use App\Mail\MyTestMail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Encore\Admin\Widgets\Box;

class VerificationTeknisController extends AdminController
{
    protected $title = 'Daftar Tunggu Rekomendasi Tim Teknis';

    public function grid()
    {

        $grid = new Grid(new ProgresDocument());
        $admin_teknis = Auth::user()->id;
        if ($admin_teknis > 0 && $admin_teknis <= 3) {
            $grid->model()
                ->where('approval', '<', 1)
                ->whereIn('status', ['VERIFIKASI DOKUMEN BERHASIL', 'PANGGILAN KONSULTASI']);
        } else {
            $grid->model()
                ->where('admin_teknis', '=', $admin_teknis)
                ->where('approval', '<', 1)
                ->whereIn('status', ['VERIFIKASI DOKUMEN BERHASIL', 'PANGGILAN KONSULTASI']);
        }
        $grid->disableRowSelector();
        $grid->disableColumnSelector();
        $grid->disableCreateButton();

        $grid->column('no_invoice', 'No. Registrasi')->qrcode();
        $grid->column('service.name', 'Jenis Layanan');
        $grid->column('AdminTeknis.username', 'Rekomendasi Teknis');
        $grid->column('status', __('Status'))->label('warning');
        $grid->column('date_verified_doc', 'Tanggal')->date('d-m-Y');

        $grid->actions(function ($actions) {
            $actions->disableDelete();
            $actions->disableEdit();
        });
        $grid->export(function ($export) {

            $export->filename('daftar_tunggu_verifikasi_dokumen.csv');

            $export->originalValue(['no_invoice', 'service.name', 'applicant_name', 'status', 'updated_at']);
        });

        return $grid;
    }

    protected function form()
    {
        $form = new Form(new ProgresDocument());
        $form->tools(function (Form\Tools $tools) {
            // Disable `Delete` btn.
            $tools->disableDelete();
        });
        $form->footer(function ($footer) {
            // disable `View` checkbox
            $footer->disableViewCheck();
            // disable `Continue editing` checkbox
            $footer->disableEditingCheck();
            // disable `Continue Creating` checkbox
            $footer->disableCreatingCheck();
        });
        $form->hidden('user_id');
        $form->tab('Rekomendasi Teknis', function ($form) {

            $form->select('status', __('Status Verifikasi Teknis'))->options([
                'VERIFIKASI TEKNIS DITOLAK' => 'VERIFIKASI TEKNIS DITOLAK',
                'VERIFIKASI TEKNIS BERHASIL' => 'VERIFIKASI TEKNIS BERHASIL',
                'PANGGILAN KONSULTASI' => 'PANGGILAN KONSULTASI'
            ])->rules('required');
            $form->textarea('note_verified_teknis', __('Catatan dan Rekomendasi Teknis'))->help('Isi Catatan Verifikator: dengan alasan kenapa permohonan membutuhkan konsultasi langsung atau tidak langsung dengan tim teknis yang menangani, Contoh “ Terimakasih telah mengajukan permohonan, mohon kesediaannya untuk datang konsultasi terkait perlunya kunjungan tim lapangan ke lokasi pemohon. Anda bisa datang ke kantor DPMPTSP Bulukumba pada hari kerja atau hubungi nomor verifikator kami di ....')->rules('required');
            $form->date('date_verified_teknis', 'Waktu Verifikasi Teknis')->format('YYYY-MM-DD')->rules('required');
            $form->file('doc_verified_teknis', 'Dokumen Rekomendasi Teknis')->rules('mimes:pdf')->move('rekomendasi_teknis')->help('Upload surat rekomendasi untuk permohonan ini jika verifikasi berhasilS');
            $form->text('verifikator_teknis', 'Verifikator Teknis')->rules('required')->help('Isi dengan nama kamu sebagai petugas yang melakukan verifikator )');
           // $form->switch('approval', 'Lanjut Approval Pimpinan')->help('Jika Status Verifikasi Berhasil di ON-kan agar diteruskan untuk Approval KA. Seksi');
            $form->confirm('Anda sudah yakin memverifikasi permohonan ini ?', 'edit');
        })->tab('Revisi Isian Pemohon', function ($form) {

            // Subtable fields
            $form->hasMany('inputs', 'Formulir isian pemohon', function (Form\NestedForm $form) {
                //$form->text('kode','KODE');
                $form->text('input_name', '')->icon('fa-cog');
                $form->text('value', '');
            });
        });
        // kirim notifikasi email ke user
        $form->saved(function ($form) {
            $user = User::findOrFail($form->user_id);
            $details = [
                'title' => $form->status,
                'body' => strip_tags($form->note_verified_teknis),
            ];

            Mail::to($user->email)->send(new \App\Mail\NotifFo($details));

            //dd("Email sudah terkirim.");
            // redirect url
            if ($form->status == 'VERIFIKASI TEKNIS BERHASIL') {
                return redirect('/admin-panel/progres-documents');
            } else {
                return redirect('/admin-panel/verification-teknis');
            }
        });

        return $form;
    }

    protected function detail($id)
    {
        $show = new Show(ProgresDocument::findOrFail($id));
        
       $show->panel()
            ->tools(function ($tools) use ($id) {
                $tools->disableDelete();
                $tools->disableEdit();
                $tools->append('<a href="' . $id . '/edit" class="btn btn-warning ">VERIFIKASI TEKNIS</a>');
            });

       $show->field('no_invoice', __('Nomor Registasi'));
        

        $show->field('service.name', __('Jenis Layanan Perizinan'));
        $show->field('status', __('Status'))->label();
        $show->field('applicant_name', __('Nama Pemohon'));
        $show->field('nik', __('NIK'));
        $show->field('no_kk', __('No. KK'));
        $show->field('npwp', __('NPWP'));
        $show->field('gender', __('Jenis Kelamin'));
        $show->field('place_of_birth', __('Tempat Lahir'));
        $show->field('date_of_birth', __('Tanggal Lahir'));;
        $show->field('phone_number', __('Telepn/Hp'));
        $show->field('address_ktp', __('Alamat sesuai KTP'));
        $show->field('date_verified_doc', __('Waktu verifikasi Dokumen'));
        $show->field('note_verified_doc', __('Catatan Verifikator'));
        $show->field('verifikator', __('Verifikator'));

        $show->inputs('Formulir isian pemohon', function ($input) {
            $input->disableCreateButton();
            $input->disableExport();
            $input->disableRowSelector();
            $input->disableFilter();
            $input->disableColumnSelector();
            $input->disableActions();
            $input->input_name();
            $input->column('value');
        });

        $show->documents('Dokumen Persyaratan', function ($documents) {
            $documents->disableCreateButton();
            $documents->disableExport();
            $documents->disableRowSelector();
            $documents->disableFilter();
            $documents->disableColumnSelector();
            $documents->disableActions();

            $documents->document_name();

            // $documents->column('file_document')->display(function ($file_document) {

            //     return " <a class='btn btn-success btn-block' href='/view-file?download_file=$file_document' target='_blank'> <i class='fa fa-file'></i> <br> Lihat</a> ";
            // });

            $documents->column('file_document')->modal('Periksa Dokumen', function ($file_document) {
                if($file_document->file_document){
                    if ($file_document->document_type == 'pdf') {
                        return "                     
                        <embed type='application/pdf' src='/view-file?download_file=$file_document->file_document' width='100%' height='800'></embed>                    
                        ";
                    } else {
                        return "<img class='img-responsice' src='/uploads/$file_document->file_document'>";
                    }
                } else {
                    return 'FILE TIDAK ADA';
                }
                
            });

            $documents->actions(function ($actions) {
                $actions->disableDelete();
                $actions->disableEdit();
                $actions->disableView();
            });
        });

        return $show;
    }
}
