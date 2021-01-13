<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AskFor extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'real_name'     =>'required|between:2,10',
            'phone'         =>  'required|regex:/^1[3-9]\d{9}/',
            'idnumber'      =>  'required|regex:/\d{17}[0-9|x]{1}/',
            'school_name'   =>  'required|between:2,10',
            'license'       =>  'required'
        ];
    }

    public function messages()
    {
        return [
            'real_name.required'=>'姓名必填',
            'real_name.between'=>'姓名 长度 在2~10个字符之间',
            'phone.required'=>'手机号码必填',
            'phone.regex'=>'手机号码格式不正确',
            'idnumber.required'=>'身份证号码必填',
            'idnumber.regex'=>'身份证号码格式有误',
            'school_name.required'=>'驾校名称必填',
            'school_name.between'=>'驾校名称长度在2~20个字符之间',
            'license.required'=>'执照必须上传'
        ];
    }
}
