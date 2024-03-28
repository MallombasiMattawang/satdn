<?php

namespace App\Admin\Controllers;

use App\Models\ConfigSatdn;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ConfigSatdnController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'configSatdn';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new ConfigSatdn());

        $grid->column('id', __('Id'));
        $grid->column('format_surat', __('Format surat'));
        $grid->column('awal_nomor', __('Awal nomor'));
        $grid->column('akhir_nomor', __('Akhir nomor'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

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
        $show = new Show(ConfigSatdn::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('format_surat', __('Format surat'));
        $show->field('awal_nomor', __('Awal nomor'));
        $show->field('akhir_nomor', __('Akhir nomor'));
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
        $form = new Form(new ConfigSatdn());

        $form->text('format_surat', __('Format surat'));
        $form->number('awal_nomor', __('Awal nomor'));
        $form->number('akhir_nomor', __('Akhir nomor'));

        return $form;
    }
}
