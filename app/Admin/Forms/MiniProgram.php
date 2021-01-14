<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2020/12/26
 * Time: 22:23
 */

namespace App\Admin\Forms;

use App\Models\Setting;
use Encore\Admin\Widgets\Form;
use Illuminate\Http\Request;

class MiniProgram extends FormBuild
{
    public $title = '小程序配置';

    protected $data;
    protected $form;
    public function __construct()
    {
        parent::__construct();
        $this->data = Setting::where('tab','miniprogram')->get()->toArray();
        $this->form = $this->form_build($this->data);
    }

    public function handle(Request $request)
    {
        $params = $request->all();
        foreach ($params as $k=>$v){
            Setting::where('field',$k)->update(['value'=>$v]);
        }

        admin_success('Processed successfully.');

        return back();
    }

//    public function form()
//    {
//        $this->text('');
//    }

    public function data()
    {
        if($this->data){
            $options=[];
            foreach ($this->data as $item){
                $options[$item['field']]  =$item['value'];
            }
        }
        return $options;
    }

}
