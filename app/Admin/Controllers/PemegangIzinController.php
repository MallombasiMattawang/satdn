<?php

namespace App\Admin\Controllers;

use App\Models\PemegangIzin;
use App\Models\User;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class PemegangIzinController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Daftar Pemegang Izin Pengedar TSL';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new PemegangIzin());

        $grid->column('id', __('Id'));
        $grid->column('user.email', __('Email'));
        $grid->column('nama_perusahaan', __('Nama perusahaan'));
        $grid->column('alamat_lengkap', __('Alamat lengkap'));
        $grid->column('jenis_tsl', __('Jenis TSL'));
        $grid->column('no_sk_oss', __('No SK /Sertifikat Standar OSS'));
        $grid->column('tgl_sk_oss', __('Tgl SK'));
        $grid->column('nama_pemohon', __('Nama pemohon'));
        $grid->column('tgl_habis_sk', __('Tgl Berakhir Ijin'));
        $grid->column('keterangan', __('Keterangan'));
        $grid->column('active', __('Active'));
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
        $show = new Show(PemegangIzin::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('user_id', __('User id'));
        $show->field('nama_perusahaan', __('Nama perusahaan'));
        $show->field('alamat_lengkap', __('Alamat lengkap'));
        $show->field('telepon', __('Telepon'));
        $show->field('fax', __('Fax'));
        $show->field('jenis_tsl', __('Jenis tsl'));
        $show->field('no_sk_oss', __('No SK /Sertifikat Standar OSS'));
        $show->field('tgl_sk_oss', __('Tgl SK'));
        $show->field('nama_pemohon', __('Nama pemohon'));
        $show->field('tgl_habis_sk', __('Tgl habis SK'));
        $show->field('dokumen_izin', __('Dokumen izin'));
        $show->field('active', __('Active'));
        $show->field('keterangan', __('Keterangan'));
        $show->field('satuan', __('Satuan'));
        $show->field('kuota_sumber', __('Kuota sumber'));
        $show->field('kuota', __('Kuota'));
        $show->field('kuota_digunakan', __('Kuota digunakan'));
        $show->field('kuota_sisa', __('Kuota sisa'));
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
        $form = new Form(new PemegangIzin());

        $form->select('user_id', 'Akun User')->options(User::all()->pluck('name', 'id'));
        $form->text('nama_perusahaan', __('Nama perusahaan'));
        $form->text('alamat_lengkap', __('Alamat lengkap'));
        $form->text('telepon', __('Telepon'));
        $form->text('fax', __('Fax'));
        $form->text('jenis_tsl', __('Jenis tsl'));
        $form->text('no_sk_oss', __('No SK /Sertifikat Standar OSS'));
        $form->date('tgl_sk_oss', __('Tgl SK'))->default(date('Y-m-d'));
        $form->text('nama_pemohon', __('Nama pemohon'));
        $form->date('tgl_habis_sk', __('Tgl habis SK'))->default(date('Y-m-d'));
        $form->file('dokumen_izin', __('Dokumen izin'))->rules('mimes:pdf')->help('Gabung dokumen izin menjadi satu file PDF dengan ukuran file dibawah 5 MB');
        $form->textarea('keterangan', __('Keterangan'));
        $form->text('kuota_sumber', __('Sumber Perolehan Kuota'));
        $form->number('kuota', __('Kuota'));
        $form->text('satuan', __('Satuan'))->help('Satuan Ekor/m3/pcs');
        $form->radio('active', 'Active')->options(['Y' => 'YES', 'N' => 'NO'])->default('Y');

        return $form;
    }
}
