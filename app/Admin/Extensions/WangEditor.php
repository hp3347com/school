<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2020/12/25
 * Time: 18:59
 */

namespace App\Admin\Extensions;

use Encore\Admin\Form\Field;

class WangEditor extends Field
{
    protected $view='admin.wang-editor';

    protected static $css = [
        '/vendor/wangEditor-3.0.10/release/wangEditor.css'
    ];
    protected static $js=[
        '/vendor/laravel-admin-ext/wang-editor/wangEditor-3.0.10/release/wangEditor.js'
    ];

    public function render()
    {
        $name=$this->formatName($this->column);
        $this->script=<<<EOT
var E = window.wangEditor
var editor= new E('#{$this->id}');
editor.customConfig.zIndex=0
editor.customConfig.uploadImgHeaders = {
    'X-CSRF-TOKEN': $('input[name="_token"]').val()
}

editor.customConfig.uploadImgServer = '/admin/uploadImage'
editor.customConfig.uploadFileName = 'images[]'
editor.customConfig.uploadImgMaxSize = 3 * 1024 * 1024

editor.customConfig.onchange = function(html){
    $('input[name=\'$name\']').val(html);
}
editor.customConfig.uploadImgHooks = {
    customInsert: function (insertImg, result, editor) {
        if (typeof(result.length) != "undefined") {
            for (var i = 0; i <= result.length - 1; i++) {
                var j = i;
                var url = result[i].newFileName;
                insertImg(url);
            }
            toastr.success(result[j]['info']);
        }
        switch (result['code']) {
            case 6:
                toastr.error("最多可以上传4张图片");
                break;
            case 5:
                toastr.error("请选择一个文件");
                break;
            case 4:
                toastr.error("上传失败");
                break;
            case 3:
                toastr.error(result['info']);
                break;
            case 2:
                toastr.error("文件类型不合法");
                break;
            case 1:
                toastr.error(result['info']);
                break;
        }
    }
}
editor.create()
EOT;
        return parent::render();
    }
}