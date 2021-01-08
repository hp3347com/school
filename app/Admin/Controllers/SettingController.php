<?php
namespace App\Admin\Controllers;


use App\Admin\Forms\Basic;
use App\Admin\Forms\Tags;
use App\Admin\Forms\Test;
use App\Admin\Forms\Flow;
use App\Admin\Forms\MiniProgram;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Widgets\Form;

use Encore\Admin\Widgets\Tab;

use Encore\Admin\Layout\Content;


class SettingController extends AdminController
{
    public function setting(Content $content)
    {
        $forms = [
            'basic'    => Basic::class,
            'test'      => Test::class,
            'flow'      => Flow::class,
            'Tags'     =>Tags::class,
            'miniProgram'=>MiniProgram::class,
          //  'develop'  => Develop::class,
        ];

        return $content->title('网站设置')
            ->description('')
            ->body(Tab::forms($forms));

    }

    protected function forms_bulid()
    {
        $form = new Form();

        $form->action('save');

        $form->text('title', __('Title'));
        $form->text('field', __('Field'));
        $form->select('type', __('Type'))->options([
            'input'=>'单行文本框',
            'textarea'=>'多行文本',
            'file'=>'文件上传',
            'radio'=>'单选',
            'checkbox'=>'多选',
            'editor'=>'富文本',
            'select'=>'单选下拉框',
            'multiSelect'=>'多选下拉框'
        ]);
        $form->select('input_type', __('Input type'))->options([
            'text'=>'文本',
            'color'=>"颜色",
            'number'=>'数字',
            'datetime'=>'时间'
        ]);
        $form->select('tab_id', __('Tab id'))->options([
            'basic'=>'基础设置',
            'flow'=>'学车流程',
            'test'=>'考试流程',
            'miniprogram'=>'小程序设置',
            'notice'=>'公告设置'
        ]);
        $form->text('param', __('Param'));
        $form->radio('upload_type', __('Upload type'))->options([
            1=>'单图上传',
            2=>'多图上传',
            3=>'文件上传'
        ]);
        $form->text('value', __('Value'));
        $form->text('desc', __('Desc'))->placeholder('在输入类型为下拉框，单选，复选框时填写');;
        $form->number('sort', __('Sort'));
        $form->switch('status', __('Status'));

        return  $form->render();
    }




}