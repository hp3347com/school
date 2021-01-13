<?php

namespace App\Admin\Controllers;

use App\Models\YuYue;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class YuYueController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'YuYue';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new YuYue());

        $grid->column('id', __('Id'));
        $grid->column('user_id', __('User id'));
        $grid->column('teacher_id', __('Teacher id'));
        $grid->column('school_id', __('School id'));
        $grid->column('subject', __('Subject'));
        $grid->column('start_time', __('Start time'));
        $grid->column('end_time', __('End time'));
        $grid->column('status', __('Status'));
        $grid->column('add_time', __('Add time'));
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
        $show = new Show(YuYue::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('user_id', __('User id'));
        $show->field('teacher_id', __('Teacher id'));
        $show->field('school_id', __('School id'));
        $show->field('subject', __('Subject'));
        $show->field('start_time', __('Start time'));
        $show->field('end_time', __('End time'));
        $show->field('status', __('Status'));
        $show->field('add_time', __('Add time'));
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
        $form = new Form(new YuYue());

        $form->number('user_id', __('User id'));
        $form->number('teacher_id', __('Teacher id'));
        $form->number('school_id', __('School id'));
        $form->text('subject', __('Subject'));
        $form->number('start_time', __('Start time'));
        $form->number('end_time', __('End time'));
        $form->switch('status', __('Status'));
        $form->number('add_time', __('Add time'));

        return $form;
    }
}
