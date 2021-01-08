<?php

use Illuminate\Routing\Router;


Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');
    $router->get('setting',"SettingController@setting");


    $router->resource('banners', BannerController::class);//banner
    $router->resource('navs', NavController::class);//导航
    $router->resource('schools', SchoolController::class);//驾校
    $router->resource('teachers', TeacherController::class);//教练
    $router->resource('grades', GradeController::class);//班次

    $router->post('uploadImage','UploadController@uploadImage');//图片上传

    $router->resource('comments', CommentController::class);//评论管理

    $router->resource('users', UserController::class); //学员

    $router->resource('sys-configs', SystemConfigController::class);//开发配置

    $router->resource('sign-ups', SignUpController::class);//报名



    $router->get('test','SystemConfigController@test'); //测试








});
