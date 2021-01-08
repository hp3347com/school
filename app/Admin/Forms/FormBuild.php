<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2021/1/5
 * Time: 19:07
 */

namespace App\Admin\Forms;


use Encore\Admin\Widgets\Form;

class FormBuild extends Form
{
    public function form_build($data)
    {
        if($data){
            $options=[];
            foreach ($data as $k=>$v){
                if($v['type']=='input'){
                    switch ($v['input_type']){
                        case 'text':
                            $this->text($v['field'],__($v['title']))->help($v['desc']);
                            break;

                        case 'color':
                            $this->color($v['field'],__($v['title']))->help($v['desc']);
                            break;

                        case 'number':
                            $this->number($v['field'],__($v['title']))->help($v['desc']);
                            break;

                        case 'datetime':
                            $this->datetime($v['field'],__($v['title']))->help($v['desc']);
                            break;
                    }
                }elseif($v['type']=='textarea'){
                    $this->textarea($v['field'],__($v['title']));
                }elseif($v['type']=='file'){
                    switch ($v['upload_type']){
                        case 1:
                        case 2:
                            $this->image($v['field'],__($v['title']));
                            break;
                        case 3:
                            $this->file($v['field'],__($v['title']))->help($v['desc']);
                    }
                }elseif($v['type']=='radio'){
                    if($v['param']){
                     $param = explode("\n",$v['param']);
                     $opt = [];
                     foreach ($param as $item) {
                         $item =  explode('=>',$item);
                         $opt[$item[0]] = $opt[1];
                     }
                        $this->radio($v['field'],__($v['title']))->options($opt)->help($v['desc']);
                    }
                }elseif($v['type']=='checkbox'){
                    if($v['param']){
                        $param = explode("\n",$v['param']);
                        $opt = [];
                        foreach ($param as $item) {
                            $item =  explode('=>',$item);
                            $opt[$item[0]] = $opt[1];
                        }
                        $this->checkbox($v['field'],__($v['title']))->options($opt)->help($v['desc']);
                    }
                }elseif($v['type']=='select'){
                    if($v['param']){
                        $param = explode("\n",$v['param']);
                        $opt = [];
                        foreach ($param as $item) {
                            $item =  explode('=>',$item);
                            $opt[$item[0]] = $opt[1];
                        }
                        $this->select($v['field'],__($v['title']))->options($opt)->help($v['desc']);
                    }
                }elseif($v['type']=='multiSelect'){
                    if($v['param']){
                        $param = explode("\n",$v['param']);
                        $opt = [];
                        foreach ($param as $item) {
                            $item =  explode('=>',$item);
                            $opt[$item[0]] = $opt[1];
                        }
                        $this->multipleSelect($v['field'],__($v['title']))->options($opt)->help($v['desc']);
                    }
                }elseif($v['type']=='editor'){
                    $this->editor($v['field'],__($v['title']))->help($v['desc']);
                }
            }
        }
    }
}