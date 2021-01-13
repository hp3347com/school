<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\YuYue;
use App\Models\Teacher;
use Illuminate\Http\Request;

class YuYueController extends Controller
{
    /**
     * 可预约教练
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function yuyue_teachers(Request $request)
    {
        $school_id = $request->input('school_id');
        $teachers = Teacher::getYuYueTeachersInSchool($school_id);
        return success($teachers);
    }

    public function yuyue(YuYue $request)
    {
       $data = $request->only(['subject','teacher_id','start_time','end_time','sign_id']);
       $user_id = $request->user_id ??1;
        if(empty($user_id)){
            return fails('参数错误');
        }


    }
}
