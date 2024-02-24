<?php

namespace App\Admin\Controllers;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Models\Service;
use Encore\Admin\Layout\Row;
use App\Models\ProgresDocument;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Widgets\Table;
use App\Mail\MyTestMail;
use App\Models\User;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use Encore\Admin\Widgets\Tab;


class HistoryController extends AdminController
{
    protected $title = 'History Verifikasi ';

    public function historyTeknis(Content $content)
    {
        return $content
            ->title('History Verifikasi')
            ->description('History Verifikasi & Rekomendasi Teknis')
            //->row($this->form()->edit($id))
            ->row(Admin::grid(ProgresDocument::class, function (Grid $grid) {

                $grid->model()->where('status', '=', 'VERIFIKASI TEKNIS BERHASIL');
                $grid->model()->orderBy('id', 'desc');

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
                        $filter->like('verifikator_teknis');
                    });
                });

                $grid->column('no_invoice', 'No. Registrasi')->qrcode();
                $grid->column('service.name', 'Jenis Layanan')->sortable();
                $grid->column('verifikator_teknis', 'Verifikator Teknis')->sortable();
                $grid->column('date_start_progres', 'Tanggal')->date('Y-m-d')->sortable()->filter('like');
                $grid->column('approval', 'Approval Pimpinan')->using([
                    0 => 'Pending',
                    1 => 'On Progress',
                    2 => 'On Progress',
                    3 => 'On Progress',
                    4 => 'On Progress',
                    5 => 'Success',
                ], 'Unknown')->label([
                    0 => 'danger',
                    1 => 'info',
                    2 => 'info',
                    3 => 'info',
                    4 => 'info',
                    5 => 'success',
                ], 'warning');
                //$grid->column('approval')->progressBar($style = 'primary', $size = 'sm', $max = 100);
                $grid->column('id', 'Generator Surat')->display(function ($id) {
                    $data = ProgresDocument::select('approval')->findOrFail($id);
                    if ($data->approval == 0) {
                        return "                     
                            <a href='/print?id=$id' class='btn btn-primary btn-sm'> Generate Surat & Kirim untuk disetujui</a> 
                        ";
                    } else {
                        return '<a href="#" class="btn btn-default btn-sm" disabled> Disabled</a>';
                    }
                });
                $grid->disableActions();
                $grid->disableCreateButton();
                $grid->export(function ($export) {

                    $export->filename('history_verifikasi_dokumen.csv');

                    $export->originalValue(['no_invoice', 'service.name', 'date_start_progres']);
                });
            }));
    }

    protected function detail($id)
    {


        $show = new Show(ProgresDocument::findOrFail($id));
        $show->panel()
            ->tools(function ($tools) use ($id) {
                $tools->disableDelete();
                $tools->disableEdit();
            });

        // $show->column(1 / 2, function ($show) {
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
        // });

        // $show->column(1 / 2, function ($show) {
        $show->field('date_verified_teknis', __('Waktu Verifikasi Teknis'));

        $show->field('note_verified_teknis', __('Rekomendasi Teknis'));
        $show->field('verifikator_teknis', __('Verfikator Teknis'));
        // });


        $show->documents('Dokumen Persyaratan', function ($documents) {
            $documents->disableCreateButton();
            $documents->disableExport();
            $documents->disableRowSelector();
            $documents->disableFilter();
            $documents->disableColumnSelector();
            $documents->disableActions();

            $documents->document_name();

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
}
