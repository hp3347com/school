<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2021/1/6
 * Time: 10:06
 */

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Requests\SignUpRequest;
use App\Models\Banner;
use App\Models\Nav;
use App\Models\School;
use App\Models\Setting;
use App\Models\SignUp;
use App\Models\User;
use Illuminate\Http\Request;

class IndexController extends Controller
{

    protected $config;

    public function __construct()
    {
        $this->config= Setting::getMore(['site_name','logo','site_url']);
    }

    /**
     * 首页
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $site = $this->config;
        $banner = Banner::getBanner(1);
        $nav = Nav::getNav();
        $school_recommand = School::getRecommand();
        $data=[
            'site'=>$site,
            'banner'=>$banner,
            'nav'=>$nav,
            'school'=>$school_recommand
        ];
        return success($data);
    }

    /**
     * 考试流程
     * @return \Illuminate\Http\JsonResponse
     */
    public function exam()
    {
        $exam = Setting::getMore(['exam']);
        return success($exam);
    }

    /**
     * 学车流程
     * @return \Illuminate\Http\JsonResponse
     */
    public function flow()
    {
        return success(Setting::getMore(['flows']));
    }

    /**
     * 报名选择驾校列表
     * @return \Illuminate\Http\JsonResponse
     */
    public function getSchoolList()
    {
        return success(School::getList());
    }


    public function test()
    {

    }
}
