<?php

namespace App\Admin\Controllers;

use App\Models\Comment;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class CommentController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Comment';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Comment());

        $grid->column('id', __('Id'));
        $grid->column('school_id', __('School id'));
        $grid->column('teacher_id', __('Teacher id'));
        $grid->column('grade_id', __('Grade id'));
        $grid->column('comment', __('Comment'));
        $grid->column('images', __('Images'));
        $grid->column('score', __('Score'));
        $grid->column('user_id', __('User id'));
        $grid->column('reply', __('Reply'));
        $grid->column('comment_time', __('Comment time'));
        $grid->column('reply_time', __('Reply time'));
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
        $show = new Show(Comment::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('school_id', __('School id'));
        $show->field('teacher_id', __('Teacher id'));
        $show->field('grade_id', __('Grade id'));
        $show->field('comment', __('Comment'));
        $show->field('images', __('Images'));
        $show->field('score', __('Score'));
        $show->field('user_id', __('User id'));
        $show->field('reply', __('Reply'));
        $show->field('comment_time', __('Comment time'));
        $show->field('reply_time', __('Reply time'));
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
        $form = new Form(new Comment());

        $form->switch('school_id', __('School id'));
        $form->number('teacher_id', __('Teacher id'));
        $form->number('grade_id', __('Grade id'));
        $form->text('comment', __('Comment'));
        $form->text('images', __('Images'));
        $form->switch('score', __('Score'));
        $form->number('user_id', __('User id'));
        $form->text('reply', __('Reply'));
        $form->number('comment_time', __('Comment time'));
        $form->number('reply_time', __('Reply time'));

        return $form;
    }
}
