<?php

namespace App\Admin\Controllers;

use App\Models\Document;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class DocumentController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Document';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Document());

        $grid->column('id', __('Id'))->sortable();
        $grid->column('name', __('Name'));
        $grid->column('type_file', __('Type file'))->label('danger');

        $grid->column('max_file')->using(['200' => '200 kb', '500' => '500 kb', '1000' => '1 mb', '2000' => '2 mb'])->label('warning');
        $grid->column('required', 'Required')->using(['0' => 'NO', '1' => 'YES'])->label('info');
        $grid->column('sample_file', __('Sample file'))->downloadable();
        //$grid->column('deleted_at', __('Deleted at'));
        //$grid->column('created_at', __('Created at'));
        //$grid->column('updated_at', __('Updated at'));

        $grid->filter(function ($filter) {

            // Sets the range query for the created_at field
            $filter->between('created_at', 'Created Time')->datetime();
            $filter->like('name', 'FileName');
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
        $show = new Show(Document::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('type_file', __('Type file'));
        $show->field('max_file', __('Max file'));
        $show->field('required', __('Required'));
        $show->field('sample_file', __('Sample file'));
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
        $form = new Form(new Document());

        $form->text('name', __('Name'));
        $typeFile = [
            'pdf'  => 'pdf',
            'jpg' => 'jpg',
            'png'  => 'png',
        ];

        $form->select('type_file', 'Type File')->options($typeFile);
        //$form->text('type_file', __('Type file'));
        $maxFile = [
            '200'  => '200 kb',
            '500'  => '500 kb',
            '1000' => '1 mb',
            '2000'  => '2 mb',
        ];

        $form->select('max_file', 'Max File')->options($maxFile);
        $form->radio('required', 'Required')->options(['1' => 'Yes', '0'=> 'No'])->default('1');
        //$form->text('max_file', __('Max file'));
        //$form->textarea('sample_file', __('Sample file'));
        // and set the upload file type
        $form->file('sample_file')->rules('mimes:doc,docx,xlsx');

        return $form;
    }
}
