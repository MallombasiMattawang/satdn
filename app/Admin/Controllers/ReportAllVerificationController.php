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
use Encore\Admin\Facades\Admin;
use Illuminate\Support\Facades\Auth;
use Encore\Admin\Widgets\Table;
use Encore\Admin\Widgets;
use App\Admin\Forms\Steps;
use Encore\Admin\Widgets\MultipleSteps;



class ReportAllVerificationController extends AdminController
{
    protected $title = 'Report Izin Terbit';

    public function grid()
    {

        $grid = new Grid(new ProgresDocument());
        $grid->filter(function (Grid\Filter $filter) {

            $filter->expand();

            $filter->column(1 / 2, function ($filter) {
                $filter->like('no_invoice');
            });

            $filter->column(1 / 2, function ($filter) {
                // $filter->equal('date_start_progres')->date();
                //$filter->between('date_start_progres')->date();
                $filter->where(function ($query) {

                    $input = $this->input;

                    $query->whereHas('service', function ($query) use ($input) {
                        $query->where('name', 'like', "%$input%");
                    });
                }, 'Jenis izin', 'service');
                $filter->like('applicant_name');
            });
        });

        $grid->model()->where('approval',  5);
        $grid->disableRowSelector();
        //$grid->disableFilter();
        $grid->disableColumnSelector();
        $grid->disableCreateButton();

        $grid->column('number_letter', 'No. Surat')->sortable()->filter('like');
        $grid->column('service.name', 'Jenis Layanan')->sortable();
        $grid->column('applicant_name', __('Nama Pemohon'))->sortable()->filter('like');

        $grid->column('date_end_progres', 'Ditandatangani')->sortable()->filter('date')->label('success');
        $grid->column('status_send', 'Kirim Surat ke pemohon')->using([
            0 => 'Belum Kirim',
            1 => 'Sudah Kirim',
        ], 'Unknown')->label([
            0 => 'danger',
            1 => 'success',
        ], 'warning');
        //$grid->column('file_permit', __('File Surat'))->downloadable();
        $grid->column('file_permit')->display(function ($file_permit) {
            if ($file_permit) {
                return "                     
                <a class='btn btn-info btn-success' href='/view-file?download_file=$file_permit' target='_blank'><i class='fa fa-print'></i>  Download Surat</a>                                    
                ";
            } else {
                return "<a href='#' class='btn btn-danger'> Surat Belum dibuat </a>";
            }
        });
        $grid->column('id', 'Generator Surat')->display(function ($id) {
            
                return "                     
                 <a href='generate?id=$id' class='btn btn-primary'>Kirim surat ke pemohon</a> 
                ";
            
        });

        $grid->disableActions();
        $grid->export(function ($export) {

            $export->filename('daftar_izin terbit_dokumen.csv');

            $export->originalValue(['no_invoice', 'service.name', 'applicant_name', 'date_verified_doc', 'date_verified_teknis', 'date_end_progres', 'file_permit']);
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
                if ($file_document->document_type == 'pdf') {
                    return "                     
                    <embed type='application/pdf' src='/view-file?download_file=$file_document->file_document' width='100%' height='800'></embed>                    
                    ";
                } else {
                    return "<img class='img-responsice' src='/uploads/$file_document->file_document'>";
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

    public function generate(Content $content)
    {

        return $content
            ->title('Kirim Surat Izin Ke Pemohon')
            // ->body(Widgets\Tab::forms([
            //     'info'     => Steps\Info::class,
            //     'profile'  => Steps\Profile::class,
            // ]));
            ->body(MultipleSteps::make([
                'info'     => Steps\Info::class,
                'profile'  => Steps\Profile::class,
            ]));
    }
}
