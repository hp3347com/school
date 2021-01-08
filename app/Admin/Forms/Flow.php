<?php

namespace App\Admin\Forms;

use App\Models\Setting;

use Illuminate\Http\Request;

class Flow extends FormBuild
{
    /**
     * The form title.
     *
     * @var string
     */
    public $title = '学车流程';

    protected $data;
    protected $form;
    public function __construct()
    {
        parent::__construct();
        $this->data = Setting::where('tab','flow')->get()->toArray();
        $this->form = $this->form_build($this->data);
    }

    /**
     * Handle the form request.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request)
    {
        $params = $request->all();
        foreach ($params as $k=>$v){
            Setting::where('field',$k)->update(['value'=>$v]);
        }
        admin_success('success');

        return back();
    }

    /**
     * Build a form here.
     */
//    public function form()
//    {
//        return $this->form;
//    }

    /**
     * The data of the form.
     *
     * @return array $data
     */
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
