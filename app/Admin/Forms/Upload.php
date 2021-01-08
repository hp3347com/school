<?php
namespace App\Admin\Forms;

use Illuminate\Http\Request;
use Encore\Admin\Widgets\Form;

class Upload extends Form
{
    /**
     * The form title.
     *
     * @var string
     */
    public $title = '上传设置';

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
        $this->image('site_logo',__('Site logo'))->rules('required');
    }

    /**
     * The data of the form.
     *
     * @return array $data
     */
    public function data()
    {
        return [
            'site_logo'       => 'John Doe',
        ];
    }
}