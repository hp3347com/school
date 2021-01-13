<?php

namespace App\Admin\Controllers;

use App\Models\Partner;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class PartnerController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Partner';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Partner());

        $grid->column('id', __('Id'));
        $grid->column('user_id', __('User id'));
        $grid->column('real_name', __('Real name'));
        $grid->column('idnumber', __('Idnumber'));
        $grid->column('phone', __('Phone'));
        $grid->column('school_name', __('School name'));
        $grid->column('license', __('License'));
        $grid->column('status', __('Status'));
        $grid->column('create_time', __('Create time'));
        $grid->column('reply_time', __('Reply time'));
        $grid->column('become_time', __('Become time'));
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
        $show = new Show(Partner::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('user_id', __('User id'));
        $show->field('real_name', __('Real name'));
        $show->field('idnumber', __('Idnumber'));
        $show->field('phone', __('Phone'));
        $show->field('school_name', __('School name'));
        $show->field('license', __('License'));
        $show->field('status', __('Status'));
        $show->field('create_time', __('Create time'));
        $show->field('reply_time', __('Reply time'));
        $show->field('become_time', __('Become time'));
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
        $form = new Form(new Partner());

        $form->number('user_id', __('User id'));
        $form->text('real_name', __('Real name'));
        $form->text('idnumber', __('Idnumber'));
        $form->mobile('phone', __('Phone'));
        $form->text('school_name', __('School name'));
        $form->text('license', __('License'));
        $form->switch('status', __('Status'));
        $form->number('create_time', __('Create time'));
        $form->number('reply_time', __('Reply time'));
        $form->number('become_time', __('Become time'));

        return $form;
    }
}
