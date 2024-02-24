<?php

namespace App\Admin\Controllers;

use App\Models\AdminUser;
use App\Models\Document;
use App\Models\Service;
use App\Models\ServiceType;
use App\Models\ServiceInput;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ServiceController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Layanan Perizinan';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Service());
        $grid->paginate(50);
        $grid->column('name', 'Nama Layanan')->label('success')->sortable();        
        $grid->column('adminUser.username', __('Admin Teknis'))->sortable();
      
        //$grid->column('serviceType.name', 'Kategori')->sortable();
        $grid->column('format_number', 'Format Nomor')->sortable();
        $grid->column('template_surat')->downloadable();
        $grid->column('period_of_time', 'Jangka Waktu (Hari)')->sortable();
        
        $grid->documents()->display(function ($tags) {
            $tags = array_map(function ($tag) {
                return "<span class=''><i class='fa fa-check'></i> {$tag['name']}</span>";
            }, $tags);
            return join('<br>', $tags);
        })->hide();
        $grid->inputs()->display(function ($input) {
            $input = array_map(function ($input) {
                return "<span class=''><i class='fa fa-check'></i> {$input['input']}</span>";
            }, $input);
            return join('<br>', $input);
        })->hide();
        
        $grid->column('active')->using([
            0 => 'non active',
            1 => 'is active',
            
        ], 'Unknown')->dot([
            0 => 'danger',
            1 => 'success',
        ], 'warning');
       // $grid->column('deleted_at', __('Deleted at'));
        //$grid->column('created_at', __('Created at'));
        //$grid->column('updated_at', __('Updated at'));
        $grid->filter(function ($filter) {

            // Sets the range query for the created_at field
            $filter->between('created_at', 'Created Time')->datetime();
            $filter->like('name', 'Name Services');
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
        $show->field('name', __('Name'));
        $show->field('description', __('Description'));
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
        $form = new Form(new Service());
        $form->select('service_type_id', 'Kategori Izin')->options(ServiceType::all()->pluck('name', 'id'));

        $form->text('name', 'Nama Layanan');
        $form->select('admin_teknis', 'Rekomendasi Teknis')->options(AdminUser::all()->pluck('username', 'id'));
        $form->text('format_number', 'Format Nomor Surat');
        $form->file('template_surat')->rules('mimes:docx,doc')->move('template_surat'); 
        $form->textarea('description','Deskripsi Layanan');
        $form->number('period_of_time', 'Jangka Waktu (hari)');
        $form->switch('tim_teknis', 'Rekomendasi Tim Teknis ?');
        $form->switch('retribution', 'Ada Retribusi ?');
        $form->switch('active', 'Layanan Active ?');
        //$form->multipleSelect('documents','document')->options(Document::all()->pluck('name','id'));
        $form->listbox('documents', 'Dokumen Persyaratan')->options(Document::all()->pluck('name', 'id'))->height(400);
        $form->listbox('inputs', 'Form Layanan')->options(ServiceInput::all()->pluck('input', 'id'))->height(400);
       
        

        return $form;
    }
}
