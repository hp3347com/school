<?php

namespace App\Admin\Controllers;

use App\Models\Banner;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class BannerController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Banner';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Banner());

        $grid->column('id', __('Id'));
        $grid->column('title', __('Title'));
        $grid->column('image', __('Image'))->lightbox(['width' => 150, 'height' => 50]);
        $grid->column('link', __('Link'));
        $grid->column('sort', __('Sort'));
        $grid->column('position', __('Position'))->display(function ($positon){
            $data = Banner::positionValue();
            $ht='';
            foreach ($positon as $k=>$v){
                $ht .="<label class='label label-primary'>{$data[$v]}</label>\t";
            }
            return $ht;
        });
        $grid->column('status', __('Status'));
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
        $show = new Show(Banner::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('title', __('Title'));
        $show->field('image', __('Image'));
        $show->field('link', __('Link'));
        $show->field('sort', __('Sort'));
        $show->field('position', __('Position'));
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
        $form = new Form(new Banner());

        $form->text('title', __('Title'));
        $form->image('image', __('Image'));
        $form->text('link', __('Link'));
        $form->text('sort', __('Sort'));
        $form->multipleSelect('position', __('Position'))->options(Banner::positionValue());
        $form->switch('status', __('Status'))->default(1);

        return $form;
    }
}
