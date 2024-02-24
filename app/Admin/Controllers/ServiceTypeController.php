<?php

namespace App\Admin\Controllers;

use App\Models\Document;
use App\Models\Service;
use App\Models\ServiceType;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ServiceTypeController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Kategori Perizinan';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new ServiceType());

        $grid->column('id', __('Id'))->sortable();
        $grid->column('name', 'Kategori Layanan')->label('success');        
        
        
        $grid->column('active')->using([
            0 => 'non active',
            1 => 'is active',
            
        ], 'Unknown')->dot([
            0 => 'danger',
            1 => 'success',
        ], 'warning');
       
        $grid->filter(function ($filter) {

            // Sets the range query for the created_at field            
            $filter->like('name', 'Nama Kategori');
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
        $show = new Show(Service::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Nama Kategori Izin'));       
        $show->field('active', __('Active'));       

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new ServiceType());

        $form->text('name', 'Nama Kategori Izin');
        
        $form->switch('active', 'Layanan Active ?');
        
        

        return $form;
    }
}
