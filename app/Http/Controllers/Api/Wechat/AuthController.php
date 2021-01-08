<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2020/12/11
 * Time: 19:27
 */

namespace App\Http\Controllers\Api\Wechat;


use App\Http\Controllers\Controller;
use App\Models\UserToken;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Services\MiniProgramService;


/**
 * 微信小程序
 * Class AuthController
 * @package App\Http\Controllers\Api\Wechat
 */
class AuthController extends Controller
{
    /**
     * 微信授权登录
     */
    public function mp_auth(Request $request)
    {
        $code = $request->input('code','');
        $cache_key = $request->input('cache_key');
        $session_key = Cache::get('api_code_' . $cache_key);
        if(!$code && !$session_key){
            return Util::fail('授权失败,参数有误');
        }
        if($code && !$session_key){
            $userInfoCong = MiniProgramService::getUserInfo($code);
            $session_key = $userInfoCong['session_key'];
            $cache_key = md5(time() . $code);
            Cache::set('api_code_' . $cache_key, $session_key, 86400);
        }

        $iv = $request->input('iv');
        $encryptedData = $request->input('encryptedData');
        try {
            //解密获取用户信息
            $userInfo = MiniProgramService::encryptor($session_key, $iv, $encryptedData);
        } catch (\Exception $e) {
            if ($e->getCode() == '-41003') {
                return fails('获取会话密匙失败');
            }
        }
        if (!isset($userInfo['openId'])) {
            return fails('openid获取失败');
        }
        if (!isset($userInfo['unionId'])) {
            $userInfo['unionId'] = '';
        }

        $userInfo['session_key'] = $session_key;

        $uid = User::routineOauth($userInfo);
        $userInfo = User::where('uid', $uid)->find();

        $token = UserToken::createToken($userInfo, 'routine');
        if ($token) {

            return success([
                'msg'=>'登录成功',
                'token' => $token->token,
                'userInfo' => $userInfo,
                'expires_time' => strtotime($token->expires_time),
                'cache_key' => $cache_key
            ]);
        } else{
            return fails('获取用户访问token失败!');
        }

    }
}