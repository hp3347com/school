<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class YuYue extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'subject'       =>  ['required'],
            'teacher_id'    =>  ['required','numeric'],
            'start_time'    =>  ['required'],
            'end_time'      =>  ['required'],
            'sign_id'       =>  ['required']
        ];
    }

    public function messages()
    {
        return [
            'subject.required'=>'科目必选',
            'teacher_id.required'=>'教练必选',
            'teacher_id.numeric'=>'教练id应为数字',
            'phone.regex'=>'手机号码格式不正确',
            'start_time.required'=>'请选择开始时间',
            'end_time.required '=>'请选择结束时间',
            'sign_id'           =>'报名id必传'
        ];
    }
}
