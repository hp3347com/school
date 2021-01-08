<?php

namespace App\Admin\Controllers;

use App\Models\Setting;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

use Encore\Admin\Widgets\Collapse;
use Encore\Admin\Widgets\InfoBox;
use Encore\Admin\Widgets\Tab;
use Encore\Admin\Widgets\Table;

class SystemConfigController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Setting';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Setting());

        $grid->column('id', __('Id'));
        $grid->column('title', __('Title'));
        $grid->column('field', __('Field'));
        $grid->column('type', __('Type'));
        $grid->column('input_type', __('Input type'));
        $grid->column('tab_id', __('Tab id'));
        $grid->column('param', __('Param'));
        $grid->column('upload_type', __('Upload type'));
        $grid->column('value', __('Value'));
        $grid->column('desc', __('Desc'));
        $grid->column('sort', __('Sort'));
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
        $show = new Show(Setting::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('title', __('Title'));
        $show->field('field', __('Field'));
        $show->field('type', __('Type'));
        $show->field('input_type', __('Input type'));
        $show->field('tab_id', __('Tab id'));
        $show->field('param', __('Param'));
        $show->field('upload_type', __('Upload type'));
        $show->field('value', __('Value'));
        $show->field('desc', __('Desc'));
        $show->field('sort', __('Sort'));
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
        $form = new Form(new Setting());

        $form->text('title', __('Title'));
        $form->text('field', __('Field'));
        $form->select('type', __('Type'))->options([
            'input'=>'单行文本框',
            'textarea'=>'多行文本',
            'file'=>'文件上传',
            'radio'=>'单选',
            'checkbox'=>'多选',
            'editor'=>'富文本',
        ]);
        $form->select('input_type', __('Input type'))->options([
            'text'=>'文本',
            'color'=>"颜色",
            'number'=>'数字',
            'datetime'=>'时间'
        ]);
        $form->select('tab', __('Tab'))->options([
            'basic'=>'基础设置',
            'flow'=>'学车流程',
            'test'=>'考试流程',
            'miniprogram'=>'小程序设置',
            'notice'=>'公告设置'
        ]);
        $form->textarea('param', __('Param'))->placeholder('在输入类型为下拉框，单选，复选框时填写');
        $form->radio('upload_type', __('Upload type'))->options([
            1=>'单图上传',
            2=>'多图上传',
            3=>'文件上传'
        ]);
        $form->text('value', __('Value'));
        $form->text('desc', __('Desc'));
        $form->number('sort', __('Sort'));
        $form->switch('status', __('Status'));


        return $form;
    }


    public function test()
    {
        $tab = new Tab();

        $tab->add('Pie', 'kllll');
        $tab->add('Table', new Table());
        $tab->add('Text', 'blablablabla....');

        echo $tab->render();
    }
}
