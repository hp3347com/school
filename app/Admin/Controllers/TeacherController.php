<?php

namespace App\Admin\Controllers;

use App\Models\Teacher;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Models\School;


class TeacherController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Teacher';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Teacher());

        $grid->column('id', __('Id'))->sortable();
        $grid->column('teach_name', __('Teach name'));
        $grid->column('phone', __('Phone'));
        $grid->column('gender', __('Gender'));
        $grid->column('avatar', __('Avatar'))->image('',50,50);
        $grid->column('info', __('Info'));
        $grid->column('score', __('Score'));
        $grid->column('tags', __('Tags'))->display(function ($tags){
            if(is_array($tags)){
                $htm='';
                foreach ($tags as $k=>$v){
                    $htm .="<label class='label label-primary'>{$v}</label>\t";
                }
                return $htm;
            }
        });
        $grid->column('sort', __('Sort'));
        $grid->column('school.school_name',__('School'));
        $grid->column('password', __('Password'));
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
        $show = new Show(Teacher::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('teach_name', __('Teach name'));
        $show->field('phone', __('Phone'));
        $show->field('gender', __('Gender'));
        $show->field('avatar', __('Avatar'));
        $show->field('info', __('Info'));
        $show->field('score', __('Score'));
        $show->field('tags', __('Tags'));
        $show->field('sort', __('Sort'));
        $show->field('password', __('Password'));
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
        $form = new Form(new Teacher());

        $form->text('teach_name', __('Teach name'));
        $form->mobile('phone', __('Phone'));
        $form->text('gender', __('Gender'))->default('男');
        $form->image('avatar', __('Avatar'));
        $form->text('info', __('Info'));
        $form->decimal('score', __('Score'))->default(0.00);
        $form->select('school_id',__('School'))->options(function(){
            $option=[];
            $school =School::getAll();
            foreach ($school as $k=>$v){
                $option[$v['id']]=$v['school_name'];
            }
            return $option;
        });
        $form->multipleSelect('tags', __('Tags'))->options(function (){
            $option=[];
            $option['一对一教学']="一对一教学";
            $option['一']="一对一";
            return $option;
        });
        $form->switch('sort', __('Sort'));
        $form->password('password', __('Password'));

        return $form;
    }
}
