<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AskFor;
use App\Models\Partner;

class PartnerController extends Controller
{
    public function askFor(AskFor $request)
    {
        $data  = $request->only(['real_name','idnumber','phone','school_name','license']);
        $user_id  =  request()->user_id;
        $has=Partner::where('user_id',$user_id)
            ->where('idnumber',$data['idnumber'])->where('school_name',$data['school_name'])
            ->first();
        if($has){
            return fails('您已经申请合伙人，请勿重复申请');
        }
        $data['user_id'] = $user_id;
        $data['create_time']=time();
        $data['status']=0;
        $res = Partner::create($data);
        if($res){
            return success(['msg'=>'申请已提交']);
        }
        return fails('提交失败');
    }
}
