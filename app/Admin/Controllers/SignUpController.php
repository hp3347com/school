<?php

namespace App\Admin\Controllers;

use App\Models\SignUp;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class SignUpController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'SignUp';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new SignUp());

        $grid->column('id', __('Id'));
        $grid->column('user_id', __('User id'));
        $grid->column('user_name', __('User name'));
        $grid->column('gener', __('Gener'));
        $grid->column('idnumber', __('Idnumber'));
        $grid->column('school_id', __('School id'));
        $grid->column('sign_type', __('Sign type'));
        $grid->column('status', __('Status'));
        $grid->column('sign_time', __('Sign time'));
        $grid->column('created_at', __('Created at'))->hide();
        $grid->column('updated_at', __('Updated at'))->hide();

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
        $show = new Show(SignUp::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('user_id', __('User id'));
        $show->field('user_name', __('User name'));
        $show->field('gener', __('Gener'));
        $show->field('idnumber', __('Idnumber'));
        $show->field('school_id', __('School id'));
        $show->field('sign_type', __('Sign type'));
        $show->field('status', __('Status'));
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
        $form = new Form(new SignUp());

        $form->number('user_id', __('User id'));
        $form->text('user_name', __('User name'));
        $form->text('gener', __('Gener'));
        $form->text('idnumber', __('Idnumber'));
        $form->switch('school_id', __('School id'));
        $form->text('sign_type', __('Sign type'));
        $form->switch('status', __('Status'));
        return $form;
    }
}
