<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SignUpRequest;
use App\Models\SignUp as SignUpModel;
use App\Events\SignUp;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;


class SignUpController extends Controller
{
    /**
     * 驾校报名
     * @param SignUpRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function sign_up(SignUpRequest $request)
    {
        $user_id = request()->user_id ?? 1;
        $data = $request->all();
        $hassign=SignUpModel::where('idnumber',$data['idnumber'])->where('sign_type',$data['sign_type'])->first();
        if($hassign){
            return fails('已报名项该目，请勿重复');
        }
        $data['user_id']=$user_id;
        $data['sign_time'] = time();
        $sign=SignUpModel::create($data);
        if($sign->id){
            User::where('id',$user_id)->update(['status_type'=>1,'sign_up_time'=>time(),'idnumber'=>$data['idnumber']]);
            event(new SignUp($user_id,'sign_up',1));
            return success(['msg'=>'报名成功']);
        }
        return fails('报名失败');
    }

    /**
     * 报名结果
     * @return \Illuminate\Http\JsonResponse
     */
    public function getSignUp()
    {
        $user_id = request()->user_id??1;
        $result=SignUpModel::getSignUps($user_id);
        return success($result);
    }


}
