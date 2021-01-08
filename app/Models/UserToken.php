<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2021/1/4
 * Time: 10:43
 */


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserToken extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','token','add_time','login_ip','expire_time'];

    public static function onBeforeInsert(UserToken $token)
    {
        if (!isset($token['login_ip']))
            $token['login_ip'] = app()->request->ip();
    }

    public static function createToken(User $user,$type)
    {
        $tokenInfo = $user->getToken($type);
        return self::create([
            'user_id' => $user->id,
            'token' => $tokenInfo['token'],
            'expire_time' => $tokenInfo['params']['exp'],
            'add_time'=>time(),
            'login_ip'=>request()->ip()
        ]);
    }

    /**
     * 删除一天前的过期token
     * @return bool
     * @throws \Exception
     */
    public static function delToken()
    {
        return self::where('expires_time', '<',time()-86400)->delete();
    }

    public static function parseToken($token)
    {
        if (!$token || !$tokenData = UserToken::where('token', $token)->first()){
          return fail('请登录');
        }
        try {
            list($user,$type) = User::parseToken($token);
        } catch (\Throwable $e) {
            $tokenData->delete();
            return fail($e->getMessage());
        }

        if (!$user || $user->id != $tokenData->user_id) {
            $tokenData->delete();
          return fail('登录状态有误,请重新登录');
        }
        $tokenData->type = $type;
        return compact('user','tokenData');
    }
}
