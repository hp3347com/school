<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
$api = app('Dingo\Api\Routing\Router');

$api->version( 'v1',[
    'namespace'=>'App\Http\Controllers\Api',
    'middleware'=>['api']
],function($api){
    //需要登录的
    $api->group([
        'middleware'=>['App\Http\Middleware\AuthToken']
    ],function ($api){
        $api->get("test",function(){
            return "哈哈哈哈";
        });
    });

    //无需授权的
    $api->post("login_phone","UserController@login");

    //微信授权登录
    $api->post('login',"Wechat\AuthController@mp_auth");

    //首页
    $api->get("index","IndexController@index");

    $api->get('exam',"IndexController@exam");//考试流程
    $api->get('flow',"IndexController@flow");//学车流程
    $api->get("getSchool","IndexController@getSchoolList");//报名选择驾校

    $api->post("sign_up","IndexController@sign_up");//报名 需要登录


});



Route::fallback(function(){
    return response()->json([
        'code'=>404,
        'message' => 'hi,你在干嘛？'], 404);
});

