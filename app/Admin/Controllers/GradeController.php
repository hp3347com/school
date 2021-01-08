<?php

namespace App\Admin\Controllers;

use App\Models\Grades;
use App\Models\School;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class GradeController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '班次管理';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Grades());

        $grid->column('id', __('Id'));
        $grid->column('school.school_name', __('School id'));
        $grid->column('grade_name', __('Grade name'));
        $grid->column('subject', __('Subject'));
        $grid->column('price', __('Price'));
        $grid->column('class_hour', __('Class hour'));
        $grid->column('types', __('Types'));
        $grid->column('detail', __('Detail'))->hide();
        $grid->column('status', __('Status'))->switch();
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
        $show = new Show(Grades::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('school_id', __('School id'));
        $show->field('grade_name', __('Grade name'));
        $show->field('subject', __('Subject'));
        $show->field('price', __('Price'));
        $show->field('class_hour', __('Class hour'));
        $show->field('types', __('Types'));
        $show->field('detail', __('Detail'));
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
        $form = new Form(new Grades());

        $form->select('school_id', __('School id'))->options(function (){
            return School::getOption();
        });
        $form->text('grade_name', __('Grade name'));
        $form->text('subject', __('Subject'));
        $form->decimal('price', __('Price'))->default(0.00);
        $form->text('class_hour', __('Class hour'));
        $form->text('types', __('Types'));
        $form->editor('detail', __('Detail'));
        $form->switch('status', __('Status'));
        return $form;
    }
}
