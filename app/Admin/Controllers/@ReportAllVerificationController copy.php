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

class ReportAllVerificationController extends AdminController
{
    protected $title = 'Laporan Pelayanan Izin';

    public function grid()
    {

        $grid = new Grid(new ProgresDocument());

        $grid->model()->where('number_letter', '!=', null);
        $grid->disableRowSelector();
        $grid->disableFilter();
        $grid->disableColumnSelector();
        $grid->disableCreateButton();

        $grid->column('number_letter', 'No. Surat')->sortable()->filter('like');
        $grid->column('service.name', 'Jenis Layanan')->sortable()->filter('like');
        $grid->column('applicant_name', __('Nama Pemohon'))->sortable()->filter('like');
        $grid->column('date_verified_doc', 'Verifikasi Dokumen')->sortable()->filter('date')->label('warning');
        $grid->column('date_verified_teknis', 'Verifikasi Teknis')->sortable()->filter('date')->label('info');
        $grid->column('date_end_progres', 'Izin Terbit')->sortable()->filter('date')->label('success');
        
        $grid->column('status')->label([
            'PROSES VERIFIKASI' => 'warning',
            'VERIFIKASI DOKUMEN BERHASIL' => 'info',
            'VERIFIKASI TEKNIS BERHASIL' => 'success',
            'VERIFIKASI DOKUMEN DITOLAK' => 'danger',
            'VERIFIKASI TEKNIS DITOLAK' => 'danger',
        ])->sortable()->filter([
            'PROSES VERIFIKASI' => 'PROSES VERIFIKASI DOKUMEN',
            'VERIFIKASI DOKUMEN BERHASIL' => 'VERIFIKASI DOKUMEN BERHASIL',
            'VERIFIKASI TEKNIS BERHASIL' => 'VERIFIKASI TEKNIS BERHASIL',
            'VERIFIKASI DOKUMEN DITOLAK' => 'VERIFIKASI DOKUMEN DITOLAK',
            'VERIFIKASI TEKNIS DITOLAK' => 'VERIFIKASI TEKNIS DITOLAK',
        ]);
        
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

        $form->select('status', __('Status Verifikasi Teknis'))->options(['VERIFIKASI TEKNIS DITOLAK' => 'VERIFIKASI TEKNIS DITOLAK', 'VERIFIKASI TEKNIS BERHASIL' => 'VERIFIKASI TEKNIS BERHASIL'])->rules('required');
        $form->textarea('note_verified_teknis', __('Catatan Verifikator Teknis'))->rows(10)->rules('required');
        $form->datetime('date_verified_teknis', 'Waktu Verifikasi Teknis')->format('YYYY-MM-DD HH:mm:ss')->rules('required');
        $form->text('verifikator_teknis', 'Verifikator Teknis')->rules('required');
        $form->confirm('Anda sudah yakin memverifikasi permohonan ini ?', 'edit');


        return $form;
    }

    protected function detail($id)
    {
        $show = new Show(ProgresDocument::findOrFail($id));

        $show->panel()
            ->tools(function ($tools) {
                $tools->disableEdit();
                $tools->disableDelete();
            });

        $show->field('no_invoice', __('Nomor Registasi'));
        $show->field('service.name', __('Jenis Layanan Perizinan'));
        $show->field('status', __('Status'));
        $show->field('applicant_name', __('Nama Pemohon'));
        $show->field('nik', __('Nik'));
        $show->field('no_kk', __('Nomor KK'));
        $show->field('gender', __('Jenis Kelamin'));
        $show->field('place_of_birth', __('Tempat Lahir'));
        $show->field('date_of_birth', __('Tanggal Lahir'));
        $show->field('rt', __('Rt'));
        $show->field('rw', __('Rw'));
        $show->field('phone_number', __('Telepn/Hp'));
        $show->field('address_ktp', __('Alamat sesuai KTP'));
        $show->field('date_verified_doc', __('Tanggal Verifikasi Berkas'));
        $show->field('note_verified_doc', __('Catatan Verifikasi Berkas'));
        $show->field('date_verified_teknis', __('Tanggal Verifikasi Teknis'));
        $show->field('note_verified_teknis', __('Rekomendasi Verifikasi Teknis'));


        $show->documents('Dokumen Persyaratan', function ($documents) {
            $documents->disableCreateButton();
            $documents->disableExport();
            $documents->disableRowSelector();
            $documents->disableFilter();
            $documents->disableColumnSelector();
            $documents->disableActions();

            $documents->document_name();
            $documents->file_document()->downloadable();
            $documents->actions(function ($actions) {
                $actions->disableDelete();
                $actions->disableEdit();
                $actions->disableView();
            });
        });

        return $show;
    }
}
