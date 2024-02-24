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

class SignatureController extends AdminController
{
    protected $title = 'Daftar Tunggu Penerbitan Izin';

    public function grid()
    {

        $grid = new Grid(new ProgresDocument());

        $grid->model()->where('status', '=', 'VERIFIKASI TEKNIS BERHASIL');
        $grid->model()->where('number_letter', '=', null);
        $grid->disableRowSelector();
        $grid->disableColumnSelector();
        $grid->disableCreateButton();

        $grid->column('no_invoice', 'No. Registrasi');
        $grid->column('service.name', 'Jenis Layanan')->width(300);
        $grid->column('applicant_name', __('Nama Pemohon'));
        $grid->column('status', __('Status'))->label('success');
        $grid->column('updated_at', 'Tanggal')->date('Y-m-d');
        $grid->actions(function ($actions) {
            $actions->disableDelete();
            $actions->disableEdit();
        });
        $grid->export(function ($export) {

            $export->filename('daftar_tunggu_penerbitan_dokumen.csv');

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
        $form->datetime('date_end_progres', 'Waktu Terbit Izin')->format('YYYY-MM-DD HH:mm:ss')->rules('required');
        $form->text('number_letter', 'Nomor Surat Izin')->rules('required');
        $form->textarea('signature_digital', __('Tanda Tangan Digital'))->rows(10)->rules('required');
        $form->text('signature_by', 'Yang Bertanda Tangan')->rules('required');
        $form->text('signature_position', 'Jabatan Penandatangan')->rules('required');
        $form->text('signature_id_number', 'ID Penandatangan')->rules('required');
        $form->file('file_permit', 'File Surat Izin')->rules('required|mimes:pdf')->uniqueName()->move('file_permits/');

        $form->confirm('Anda sudah yakin menerbitkan permohonan ini ?', 'edit');


        return $form;
    }

    protected function detail($id)
    {
        $show = new Show(ProgresDocument::findOrFail($id));


        $show->panel()
            ->tools(function ($tools) {
                $tools->disableDelete();
                //$tools->append('<a href="'.$show->getKey().'/edit" class="btn btn-primary btn-sm">123</a>');
            });
        // $show->addButton('詳細', route('master_maker_detail', [
        //     'maker_id' => $show->getKey()
        // ]));

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
        $show->field('short_description', __('Keterangan'));


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
