<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2021/1/4
 * Time: 11:35
 */
namespace App\Http\Middleware;

use App\Exceptions\ApiException;
use App\Http\Lib\Helper;
use App\Models\UserToken;
use Closure;
use Illuminate\Http\Request;

class AuthToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $authInfo = null;
        $token = trim(ltrim($request->header('Authori-zation'), 'Bearer'));
        try {
            $authInfo = UserToken::parseToken($token);
        } catch (ApiException $e) {
            return fails([
                'code'=>$e->getCode(),
                'msg'=>$e->getMessage()
            ]);
        }
        if(isset($authInfo['code']) && $authInfo['code']!==200){
            return Helper::jsonData($authInfo);
        }
        if (!is_null($authInfo)) {
            $request->user = $authInfo['user'];
            $request->tokenData = $authInfo['tokenData'];
        }
        $request->isLogin = !is_null($authInfo);
        $request->user_id = is_null($authInfo) ? 0 : $authInfo['user']->id;
        return $next($request);
    }


}
