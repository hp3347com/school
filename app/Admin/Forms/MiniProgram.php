<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2020/12/26
 * Time: 22:23
 */

namespace App\Admin\Forms;

use Encore\Admin\Widgets\Form;
use Illuminate\Http\Request;

class MiniProgram extends Form
{
    public function handle(Request $request)
    {
        admin_success('Processed successfully.');

        return back();
    }

    public function form()
    {
        $this->text('');
    }

    public function data()
    {
        return [

        ];
    }

}