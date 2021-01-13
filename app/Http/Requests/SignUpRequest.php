<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SignUpRequest extends FormRequest
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
            'user_name'     =>  ['required','between:2,10'],
            'phone'         =>  ["required","regex:/^1[3-9]\d{9}$/"],
            'gender'         =>  ['required'],
            'idnumber'      =>  ["required","regex:/(^\d{15}$)|(^\d{17}([0-9]|X)$)$/"],
            'school_id'     =>  ['required','numeric'],
            'sign_type'     =>  ['required']
        ];
    }

    public function messages()
    {
        return [
            'user_name.required'=>'姓名必填',
            'user_name.between'=>'姓名 长度 在2~10个字符之间',
            'phone.required'=>'手机号码必填',
            'phone.regex'=>'手机号码格式不正确',
            'idnumber.required'=>'身份证号码必填',
            'idnumber.regex '=>'身份证号码格式有误',
            'gender.regex'=>'性别必填',
            'school_id.required'=>'驾校必选',
            'school_id.numeric'=>'驾校id必须是数字',
            'sign_type.required'=>'驾照类型必须填'
        ];
    }
}
