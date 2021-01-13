<?php

namespace App\Admin\Controllers;

use App\Models\Exam;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ExamController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Exam';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Exam());

        $grid->column('id', __('Id'));
        $grid->column('sign_id', __('Sign id'));
        $grid->column('user_id', __('User id'));
        $grid->column('subject', __('Subject'));
        $grid->column('exam_time', __('Exam time'));
        $grid->column('resut', __('Resut'));
        $grid->column('mark', __('Mark'));
        $grid->column('admin_id', __('Admin id'));
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
        $show = new Show(Exam::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('sign_id', __('Sign id'));
        $show->field('user_id', __('User id'));
        $show->field('subject', __('Subject'));
        $show->field('exam_time', __('Exam time'));
        $show->field('resut', __('Resut'));
        $show->field('mark', __('Mark'));
        $show->field('admin_id', __('Admin id'));
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
        $form = new Form(new Exam());

        $form->number('sign_id', __('Sign id'));
        $form->number('user_id', __('User id'));
        $form->text('subject', __('Subject'));
        $form->number('exam_time', __('Exam time'));
        $form->switch('resut', __('Resut'));
        $form->text('mark', __('Mark'));
        $form->switch('admin_id', __('Admin id'));

        return $form;
    }
}
