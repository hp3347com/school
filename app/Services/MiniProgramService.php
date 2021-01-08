<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2020/12/11
 * Time: 22:16
 */

namespace App\Services;
use App\Models\Setting;
use EasyWeChat\Foundation\Application;


/**
 * 小程序接口
 * Class MiniProgramService
 * @package App\Services
 *
 * composer require "overtrue/wechat:~3.1" -vvv

 */
class MiniProgramService
{
    private static $instance=null;

    public static function options()
    {
        $config = [];
        $wechat = Setting::getMore(['site_url', 'routine_appId', 'routine_appsecret']);
        return $config;
    }

    /**
     * 获取userInfo
     * @param $code
     * @return mixed
     */
    public static function getUserInfo($code)
    {
        $userInfo = self::miniProgram()->sns->getSessionKey($code);
        return $userInfo;
    }

    /**
     * @param bool $cache
     * @return null
     */
    public static function application($cache=false)
    {
        (self::$instance ==null || $cache==true) && (self::$instance == new Application(self::options()));
        return self::$instance;
    }

    /**
     * @return mixed
     */
    public static function miniProgram()
    {
        return self::application()->mini_program;
    }
}