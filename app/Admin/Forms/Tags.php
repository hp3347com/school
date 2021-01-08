<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2020/12/24
 * Time: 11:12
 */

namespace App\Admin\Forms;

use Illuminate\Http\Request;
use Encore\Admin\Widgets\Form;

class Tags extends Form
{
    /**
     * The form title.
     *
     * @var string
     */
    public $title = '标签管理';

    /**
     * Handle the form request.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request)
    {
        //dump($request->all());

        admin_success('Processed successfully.');

        return back();
    }

    /**
     * Build a form here.
     */
    public function form()
    {
        $this->textarea('tags',__('Tags'))->rules('required');
    }

    /**
     * The data of the form.
     *
     * @return array $data
     */
    public function data()
    {
        return [
          'tags'=>'专车接送,一对一教学,一人一车'
        ];
    }
}