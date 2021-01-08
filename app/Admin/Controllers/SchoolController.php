<?php

namespace App\Admin\Controllers;

use App\Models\School;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class SchoolController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'school';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new School());

        $grid->column('id', __('Id'));
        $grid->column('school_name', __('School name'));
        $grid->column('sub_name', __('Sub name'));
        $grid->column('school_logo', __('School logo'))->image('',100,50);
        $grid->column('tags', __('Tags'))->display(function ($tags){
            if(is_array($tags)){
                $op='';
                foreach ($tags as $k=>$v){
                    $op .="<label class='label label-primary'>{$v}</label>\t";
                }
                return $op;
            }
        });
        $grid->column('tel', __('Tel'));
        $grid->column('score', __('Score'));
        $grid->column('images', __('Images'))->hide();
        $grid->column('status', __('Status'))->switch();
        $grid->column('is_recomment', __('Is recomment'))->switch();
        $grid->column('sort', __('Sort'));
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
        $show = new Show(School::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('school_name', __('School name'));
        $show->field('sub_name', __('Sub name'));
        $show->field('school_logo', __('School logo'));
        $show->field('tags', __('Tags'));
        $show->field('tel', __('Tel'));
        $show->field('score', __('Score'));
        $show->field('images', __('Images'));
        $show->field('status', __('Status'));
        $show->field('is_recomment', __('Is recomment'));
        $show->field('sort', __('Sort'));
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
        $form = new Form(new School());

        $form->text('school_name', __('School name'));
        $form->text('sub_name', __('Sub name'));
        $form->image('school_logo', __('School logo'));
        $form->multipleSelect('tags', __('Tags'))->options(function (){
            $option['专车接送']='专车接送';
            return $option;
        });
        $form->text('tel', __('Tel'));
        $form->decimal('score', __('Score'))->default(0.00);
        $form->multipleImage('images', __('Images'))->removable()->sortable();
        $form->switch('status', __('Status'))->default(1);
        $form->switch('is_recomment', __('Is recomment'));
        $form->number('sort', __('Sort'));

        return $form;
    }
}
