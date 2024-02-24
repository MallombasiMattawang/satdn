<?php

namespace App\Admin\Controllers;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Admin\Forms\Setting;
use Encore\Admin\Layout\Row;
use App\Models\ProgresDocument;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Controllers\Dashboard;
use Encore\Admin\Controllers\AdminController;

class ProgresDocumentController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Report Pelayanan Izin Berjalan';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new ProgresDocument());
        $grid->model()->where('status', '!=', 'UPLOAD DOC.');
        $grid->model()->orderBy('id', 'desc');

        $grid->filter(function (Grid\Filter $filter) {
            $filter->disableIdFilter();
            $filter->expand();

            $filter->column(1 / 2, function ($filter) {
                $filter->like('no_invoice');
                $filter->between('date_start_progres', 'Tanggal Masuk')->date();
                $filter->between('date_end_progres', 'Tanggal Selesai')->date();
            });


            $filter->column(1 / 2, function ($filter) {
                //$filter->in('service')->select(['id' => 'name']);
                $filter->where(function ($query) {

                    $input = $this->input;

                    $query->whereHas('service', function ($query) use ($input) {
                        $query->where('name', 'like', "%$input%");
                    });
                }, 'Jenis izin', 'service');
                $filter->like('verifikator_teknis');
                $filter->in('approval', 'Posisi Approval')->select([
                    0 => 'PENDING',
                    1 => 'KASI',
                    2 => 'KABID',
                    3 => 'SEKRETARIS',
                    4 => 'KADIS',
                    5 => 'selesai',
                ]);
            });
        });

        $grid->column('no_invoice', 'No. Registrasi')->width(200);
        $grid->column('service.name', 'Jenis Layanan')->width(200);
        $grid->column('verifikator', 'Front Office')->width(200);
        $grid->column('verifikator_teknis', 'Rekomendasi Teknis')->width(200);
        $grid->column('id', 'Back Office')->display(function ($id) {
            $data = ProgresDocument::select('approval')->findOrFail($id);
            if ($data->approval == 0) {
                return '                     
                <span class="label label-warning">Pending</span>
                ';
            } else {
                return '<span class="label label-success">OK</span>';
            }
        })->width(200);
        $grid->column('approval', 'Approval Pimpinan')->using([
            0 => '-',
            1 => 'KASI',
            2 => 'KABID',
            3 => 'SEKRETARIS',
            4 => 'KADIS',
            5 => 'selesai',
        ], 'Unknown')->label([
            0 => 'danger',
            1 => 'default',
            2 => 'default',
            3 => 'default',
            4 => 'default',
            5 => 'success',
        ], 'warning')->width(200);
        $grid->column('date_start_progres', 'Tanggal Masuk')->width(200);
        $grid->column('date_end_progres', 'Tanggal Selesai')->width(200);
        
        //$grid->column('approval')->progressBar($style = 'primary', $size = 'sm', $max = 100);

        $grid->actions(function ($actions) {
            $actions->disableDelete();
            $actions->disableEdit();
        });
        $grid->disableCreateButton();
        $grid->export(function ($export) {

            $export->filename('history_verifikasi_dokumen.csv');

            $export->originalValue(['no_invoice', 'service.name', 'date_start_progres']);
        });



        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {

        $show = new Show(ProgresDocument::findOrFail($id));

        $show->panel()
            ->tools(function ($tools) use ($id) {
                $tools->disableDelete();
                $tools->disableEdit();
                
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
        $show->field('verifikator', __('Operator FO'));
        $show->field('verifikator_teknis', __('Verifikator Teknis'));
        $show->doc_verified_teknis('Dok. Rekomendasi Teknis')->file();
        $show->field('date_start_progres', __('Tanggal Permohonan'));
        $show->field('date_end_progres', __('Tanggal Selesai'));
        $show->field('number_letter', __('Nomor Surat Izin'));
        $show->file_permit('Dok. Izin')->file();
        $show->field('note_ikm', __('Testimoni'));

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

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new ProgresDocument());

        $form->number('user_id', __('User id'));
        $form->number('service_id', __('Service id'));
        $form->text('status', __('Status'));
        $form->date('progres_date', __('Progres date'))->default(date('Y-m-d'));
        $form->text('qr_code', __('Qr code'));
        $form->text('no_invoice', __('No invoice'));
        $form->textarea('progres_log', __('Progres log'));
        $form->text('applicant_name', __('Applicant name'));
        $form->text('nik', __('Nik'));
        $form->text('no_kk', __('No kk'));
        $form->text('gender', __('Gender'));
        $form->text('place_of_birth', __('Place of birth'));
        $form->date('date_of_birth', __('Date of birth'))->default(date('Y-m-d'));
        $form->text('rt', __('Rt'));
        $form->text('rw', __('Rw'));
        $form->text('phone_number', __('Phone number'));
        $form->textarea('address_ktp', __('Address ktp'));
        $form->text('province_ktp', __('Province ktp'));
        $form->text('city_ktp', __('City ktp'));
        $form->text('district_ktp', __('District ktp'));
        $form->text('sub_district_ktp', __('Sub district ktp'));
        $form->text('pos_code_ktp', __('Pos code ktp'));
        $form->textarea('short_description', __('Short description'));

        return $form;
    }

    public function tes(Content $content)
    {
        return $content
            ->withError('Title', 'messages..');
    }
}
