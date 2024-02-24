<?php

namespace App\Admin\Controllers;

use App\Models\Post;
use App\Models\Tag;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Support\Facades\DB;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Grid\Column;

class PostController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Post';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Post());

        $grid->column('id', __('Id'));
        $grid->column('author_id', __('Author id'));
        $grid->column('content', __('Content'))->filter('like');
        $grid->column('rate', __('Rate'));
        //$grid->column('released', __('Released'));
        $grid->column('released')->using([
            0 => 'non released',
            1 => 'is released',
            
        ], 'Unknown')->dot([
            0 => 'danger',
            1 => 'info',
        ], 'warning');
        //$grid->column('tags', __('Tags'));
        //$grid->tags()->pluck('name')->map('ucwords')->implode(' | ');
        $grid->tags()->display(function ($tags) {

            $tags = array_map(function ($tag) {
                return "<span class='label label-success'>{$tag['name']}</span>";
            }, $tags);

            return join('&nbsp;', $tags);
        });
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
        $show = new Show(Post::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('author_id', __('Author id'));
        $show->field('content', __('Content'));
        $show->field('rate', __('Rate'));
        $show->field('released', __('Released'));
       // $show->field('tags', __('Tags'));
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
        $form = new Form(new Post());

        $form->number('author_id', __('Author id'));
        $form->textarea('content', __('Content'));
        $form->number('rate', __('Rate'));
        //$form->text('released', __('Released'));
        $form->switch('released', 'Released?');
        //$form->textarea('tags', __('Tags'));
        //$form->multipleSelect('tags')->options(DB::table('tags')->pluck('name', 'id'));
        $form->multipleSelect('tags','Tag')->options(Tag::all()->pluck('name','id'));

        return $form;
    }
}
