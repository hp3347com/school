<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2020/12/11
 * Time: 17:38
 */
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserToken;
use Illuminate\Http\Request;


class UserController extends Controller
{
    public function login(Request $request)
    {
        $phone = $request->input('phone');
        $password = $request->input('password');
        $user=User::loginAction($phone,$password);
        if(!$user){
            return fails(User::getErrorInfo());
        }
        $token = UserToken::createToken($user,'user');
        $user->token = $token['token'];
        return success($user);
    }

    public function register()
    {

    }
}