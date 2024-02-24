<?php

namespace App\Admin\Controllers;

use App\Models\ProgresApproval;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ProgresApprovalController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'ProgresApproval';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new ProgresApproval());

        $grid->column('id', __('Id'));
        $grid->column('progresDocument.no_invoice', __('No.Reg'));
        $grid->column('progresDocument.service_id', __('Layanan'));
        $grid->column('approval_ka_seksi', __('Approval ka seksi'));
        $grid->column('name_ka_seksi', __('Name ka seksi'));
        $grid->column('note_ka_seksi', __('Note ka seksi'));
        $grid->column('approval_ka_bidang', __('Approval ka bidang'));
        $grid->column('name_ka_bidang', __('Name ka bidang'));
        $grid->column('note_ka_bidang', __('Note ka bidang'));
        $grid->column('apporval_sekretaris', __('Apporval sekretaris'));
        $grid->column('name_sekretaris', __('Name sekretaris'));
        $grid->column('note_sekretaris', __('Note sekretaris'));
        $grid->column('approval_ka_dinas', __('Approval ka dinas'));
        $grid->column('name_ka_dinas', __('Name ka dinas'));
        $grid->column('note_ka_dinas', __('Note ka dinas'));

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
        $show = new Show(ProgresApproval::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('progres_document_id', __('Progres document id'));
        $show->field('approval_ka_seksi', __('Approval ka seksi'));
        $show->field('name_ka_seksi', __('Name ka seksi'));
        $show->field('note_ka_seksi', __('Note ka seksi'));
        $show->field('approval_ka_bidang', __('Approval ka bidang'));
        $show->field('name_ka_bidang', __('Name ka bidang'));
        $show->field('note_ka_bidang', __('Note ka bidang'));
        $show->field('apporval_sekretaris', __('Apporval sekretaris'));
        $show->field('name_sekretaris', __('Name sekretaris'));
        $show->field('note_sekretaris', __('Note sekretaris'));
        $show->field('approval_ka_dinas', __('Approval ka dinas'));
        $show->field('name_ka_dinas', __('Name ka dinas'));
        $show->field('note_ka_dinas', __('Note ka dinas'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('deleted_at', __('Deleted at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new ProgresApproval());

        $form->number('progres_document_id', __('Progres document id'));
        $form->datetime('approval_ka_seksi', __('Approval ka seksi'))->default(date('Y-m-d H:i:s'));
        $form->text('name_ka_seksi', __('Name ka seksi'));
        $form->textarea('note_ka_seksi', __('Note ka seksi'));
        $form->datetime('approval_ka_bidang', __('Approval ka bidang'))->default(date('Y-m-d H:i:s'));
        $form->text('name_ka_bidang', __('Name ka bidang'));
        $form->textarea('note_ka_bidang', __('Note ka bidang'));
        $form->datetime('apporval_sekretaris', __('Apporval sekretaris'))->default(date('Y-m-d H:i:s'));
        $form->text('name_sekretaris', __('Name sekretaris'));
        $form->text('note_sekretaris', __('Note sekretaris'));
        $form->datetime('approval_ka_dinas', __('Approval ka dinas'))->default(date('Y-m-d H:i:s'));
        $form->text('name_ka_dinas', __('Name ka dinas'));
        $form->textarea('note_ka_dinas', __('Note ka dinas'));

        return $form;
    }
}
