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
use App\Models\AdminUser;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class VerificationController extends AdminController
{
    protected $title = 'Daftar Tunggu Verifikasi Dokumen';

    public function grid()
    {

        $grid = new Grid(new ProgresDocument());

        $grid->model()->where('status', '=', 'PROSES VERIFIKASI DOKUMEN');
        $grid->disableRowSelector();
        $grid->disableColumnSelector();
        $grid->disableCreateButton();

        $grid->column('no_invoice', 'No. Registrasi');
        $grid->column('service.name', 'Jenis Layanan')->width(300);
        $grid->column('applicant_name', __('Nama Pemohon'));
        $grid->column('status', __('Status'))->label('warning');
        $grid->column('date_start_progres', 'Tanggal');
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
        $form->select('admin_teknis', 'Rekomendasi Teknis')->options(AdminUser::whereNotBetween('id', [1, 7])->pluck('username', 'id'));
        $form->select('status', __('Status Verifikasi'))->options(['VERIFIKASI DOKUMEN DITOLAK' => 'VERIFIKASI DOKUMEN DITOLAK', 'VERIFIKASI DOKUMEN BERHASIL' => 'VERIFIKASI DOKUMEN BERHASIL'])->rules('required');
        $form->textarea('note_verified_doc', 'Catatan Verifikator')->help('Masukan Info dinas tim terkait apabila disetujui, jika ditolak beri alasan kenapa permohonan itu ditolak dan solusi untuk pemohon agar memperbaiki kesalahan sebelum mengajukan permohonan kembali')->rules('required');
        $form->date('date_verified_doc', 'Tanggal Verifikasi')->format('YYYY-MM-DD')->rules('required');
        $form->text('verifikator', 'Verifikator')->rules('required');
        
        $form->confirm('Anda sudah yakin memverifikasi permohonan ini ?', 'edit');

        // kirim notifikasi email ke user
        $form->saved(function ($form) {
            $user = User::findOrFail($form->user_id);
            $details = [
                'title' => $form->status,
                'body' => strip_tags($form->note_verified_doc),
            ];

            Mail::to($user->email)->send(new \App\Mail\NotifFo($details));

            //dd("Email sudah terkirim.");

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
                $tools->append('<a href="' . $id . '/edit" class="btn btn-warning ">VERIFIKASI DOKUMEN</a>');
            });

        $show->field('no_invoice', __('Nomor Registasi'));
        $show->field('service.name', __('Jenis Layanan Perizinan'));
        $show->field('status', __('Status'));
        $show->field('applicant_name', __('Nama Pemohon'));
        $show->field('nik', __('NIK'));
        $show->field('no_kk', __('No. KK'));
        $show->field('npwp', __('NPWP'));
        $show->field('gender', __('Jenis Kelamin'));
        $show->field('place_of_birth', __('Tempat Lahir'));
        $show->field('date_of_birth', __('Tanggal Lahir'));;
        $show->field('phone_number', __('Telepn/Hp'));
        $show->field('address_ktp', __('Alamat sesuai KTP'));

        $show->inputs('Form Layanan', function ($input) {
            $input->disableCreateButton();
            $input->disableExport();
            $input->disableRowSelector();
            $input->disableFilter();
            $input->disableColumnSelector();
            $input->disableActions();
            $input->input_name();
            $input->value();
            $input->actions(function ($actions) {
                $actions->disableDelete();
                $actions->disableEdit();
                $actions->disableView();
            });
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
