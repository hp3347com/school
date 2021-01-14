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
use EasyWeChat\MiniProgram\MiniProgram;
use JetBrains\PhpStorm\Pure;


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
        $config['mini_program'] = [
            'app_id' => isset($wechat['routine_appId']) ? trim($wechat['routine_appId']) : '',
            'secret' => isset($wechat['routine_appsecret']) ? trim($wechat['routine_appsecret']) : ''
        ];
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
//        (self::$instance ==null || $cache==true) && (self::$instance == new Application(self::options()));
//        return self::$instance;
        return new MiniProgram();
    }

    /**
     * @return mixed
     */
    public static function miniProgram()
    {
        return self::application()->mini_program;
    }

    /**
     * 加密数据解密
     * @param $sessionKey
     * @param $iv
     * @param $encryptData
     * @return $userInfo
     */
    public static function encryptor($sessionKey, $iv, $encryptData)
    {
        return self::miniprogram()->encryptor->decryptData($sessionKey, $iv, $encryptData);
    }
}
