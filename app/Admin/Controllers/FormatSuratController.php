<?php

namespace App\Admin\Controllers;

use App\Models\ProgresDocument;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Support\Facades\Auth;

class FormatSuratController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Pembuatan Format Surat Izin';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    public function grid()
    {

        $grid = new Grid(new ProgresDocument());
        $admin_teknis = Auth::user()->id;
        if ($admin_teknis > 0 && $admin_teknis <= 3){
            $grid->model()                        
            ->where('approval', '<' , 1)
            ->whereIn('status', ['VERIFIKASI DOKUMEN BERHASIL', 'PANGGILAN KONSULTASI']);
            
        } else {
            $grid->model()
            ->where('admin_teknis', '=', $admin_teknis)
            ->where('approval', '<' , 1)
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

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(ProgresDocument::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('user_id', __('User id'));
        $show->field('service_id', __('Service id'));
        $show->field('status', __('Status'));
        $show->field('progres_date', __('Progres date'));
        $show->field('qr_code', __('Qr code'));
        $show->field('no_invoice', __('No invoice'));
        $show->field('progres_log', __('Progres log'));
        $show->field('applicant_name', __('Applicant name'));
        $show->field('nik', __('Nik'));
        $show->field('no_kk', __('No kk'));
        $show->field('npwp', __('Npwp'));
        $show->field('gender', __('Gender'));
        $show->field('place_of_birth', __('Place of birth'));
        $show->field('date_of_birth', __('Date of birth'));
        $show->field('rt', __('Rt'));
        $show->field('rw', __('Rw'));
        $show->field('phone_number', __('Phone number'));
        $show->field('address_ktp', __('Address ktp'));
        $show->field('province_ktp', __('Province ktp'));
        $show->field('city_ktp', __('City ktp'));
        $show->field('district_ktp', __('District ktp'));
        $show->field('sub_district_ktp', __('Sub district ktp'));
        $show->field('pos_code_ktp', __('Pos code ktp'));
        $show->field('short_description', __('Short description'));
        $show->field('date_start_progres', __('Date start progres'));
        $show->field('date_verified_doc', __('Date verified doc'));
        $show->field('note_verified_doc', __('Note verified doc'));
        $show->field('verifikator', __('Verifikator'));
        $show->field('admin_teknis', __('Admin teknis'));
        $show->field('date_verified_teknis', __('Date verified teknis'));
        $show->field('note_verified_teknis', __('Note verified teknis'));
        $show->field('verifikator_teknis', __('Verifikator teknis'));
        $show->field('approval', __('Approval'));
        $show->field('date_end_progres', __('Date end progres'));
        $show->field('format_number', __('Format number'));
        $show->field('number_letter', __('Number letter'));
        $show->field('signature_digital', __('Signature digital'));
        $show->field('signature_position', __('Signature position'));
        $show->field('signature_id_number', __('Signature id number'));
        $show->field('signature_by', __('Signature by'));
        $show->field('passphrase', __('Passphrase'));
        $show->field('temp_file_permit', __('Temp file permit'));
        $show->field('file_permit', __('File permit'));
        $show->field('ikm', __('Ikm'));
        $show->field('note_ikm', __('Note ikm'));
        $show->field('rate_ikm', __('Rate ikm'));
        $show->field('deleted_at', __('Deleted at'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

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
        $form->text('npwp', __('Npwp'));
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
        $form->datetime('date_start_progres', __('Date start progres'))->default(date('Y-m-d H:i:s'));
        $form->datetime('date_verified_doc', __('Date verified doc'))->default(date('Y-m-d H:i:s'));
        $form->textarea('note_verified_doc', __('Note verified doc'));
        $form->text('verifikator', __('Verifikator'));
        $form->number('admin_teknis', __('Admin teknis'));
        $form->datetime('date_verified_teknis', __('Date verified teknis'))->default(date('Y-m-d H:i:s'));
        $form->textarea('note_verified_teknis', __('Note verified teknis'));
        $form->text('verifikator_teknis', __('Verifikator teknis'));
        $form->number('approval', __('Approval'));
        $form->datetime('date_end_progres', __('Date end progres'))->default(date('Y-m-d H:i:s'));
        $form->text('format_number', __('Format number'));
        $form->text('number_letter', __('Number letter'));
        $form->textarea('signature_digital', __('Signature digital'));
        $form->text('signature_position', __('Signature position'));
        $form->text('signature_id_number', __('Signature id number'));
        $form->text('signature_by', __('Signature by'));
        $form->text('passphrase', __('Passphrase'));
        $form->textarea('temp_file_permit', __('Temp file permit'));
        $form->textarea('file_permit', __('File permit'));
        $form->text('ikm', __('Ikm'));
        $form->textarea('note_ikm', __('Note ikm'));
        $form->number('rate_ikm', __('Rate ikm'));

        return $form;
    }
}
