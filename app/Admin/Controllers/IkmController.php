<?php

namespace App\Admin\Controllers;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Models\Service;
use Encore\Admin\Layout\Row;
use App\Models\CommunitySatisfactionIndex;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\Dashboard;
use App\Admin\Actions\Post\BatchReplicate;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Widgets\Table;

class IkmController extends AdminController
{
    protected $title = 'Indeks Kepuasan Masyarakat';

    public function grid()
    {

        $grid = new Grid(new CommunitySatisfactionIndex());       
        
        $grid->disableRowSelector();
        $grid->disableColumnSelector();
        $grid->disableCreateButton();

        $grid->column('name', 'Nama');
        $grid->column('service', 'Layanan');
        $grid->column('rate', __('Nilai'))->using([
            '1' => 'satu', 
            '2' => '<i class="fa fa-star"></i><i class="fa fa-star"></i>',
            '3' => '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>',
            '4' => '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>',
            '5' => '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>'
        ]);
        $grid->column('testimony', __('Testimoni'));
        $grid->column('created_at', 'Tanggal');
        $grid->actions(function ($actions) {
            $actions->disableDelete();
            $actions->disableEdit();
        });
        $grid->export(function ($export) {

            $export->filename('IKM.csv');

            $export->originalValue(['name', 'service', 'rate', 'testimony', 'created_at']);
        });

        return $grid;
    }

    
}
