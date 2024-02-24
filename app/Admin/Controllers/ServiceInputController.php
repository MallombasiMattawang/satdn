<?php

namespace App\Admin\Controllers;

use App\Models\ServiceInput;
use App\Models\Service;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ServiceInputController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'ServiceInput';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new ServiceInput());
        $grid->model()->take(50);
        $grid->model()->orderBy('input', 'ASC');

        $grid->filter(function($filter){

            // Remove the default id filter
            $filter->disableIdFilter();
        
            // Add a column filter
            $filter->like('input', 'Inputan');
            $filter->expand();
           
        
        });
        
        

        $grid->column('id', __('Id'));
        $grid->column('kode', __('Kode'));
        $grid->column('input', __('Input'))->filter('like');
        $grid->column('option', __('Option'))->filter('like');
        $grid->column('type', __('Type'))->filter('like');



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
        $show = new Show(ServiceInput::findOrFail($id));

        $show->field('id', __('Id'));

        $show->field('input', __('Input'));


        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new ServiceInput());


        // $form->select('service_id', 'Layanan Izin')->options(Service::all()->pluck('name', 'id'));
        $form->text('input', __('Input'));
        $form->hidden('type', __('Type'))->default('text');
        $form->text('kode', __('Kode'))
                ->creationRules(['required', "unique:service_inputs"])
                ->updateRules(['required', "unique:service_inputs,kode,{{id}}"]);
        $form->select('option', 'Option')->options(['PEMOHON' => 'DIISI PEMOHON', 'ADMIN TEKNIS' => 'DIISI ADMIN TEKNIS']);
        //$form->datetime('cerated_at', __('Cerated at'))->default(date('Y-m-d H:i:s'));

        return $form;
    }
}
