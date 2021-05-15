<?php

$api = app('Dingo\Api\Routing\Router');

$params = [
    'middleware' => 
        'api.throttle',
    'limit' => 60, 
    'expires' => 1,
];

// 与注册登录验证等相关路由
$api->version('v1', $params , function ($api) {
    // 路由组
    $api->group(['prefix' => 'auth'], function ($api) {
        // 注册
        $api->get('toRegister','App\Http\Controllers\Auth\RegisterController@toStore');
        $api->post('register','App\Http\Controllers\Auth\RegisterController@store');

         // 登录
         $api->post('login','App\Http\Controllers\Auth\LoginController@login');


        // 需要登陆的路由
        $api->group(['middleware' => 'api.auth'], function ($api) {
            // 退出登录
            $api->post('logout','App\Http\Controllers\Auth\LoginController@logout');
        
            // 刷新token
            $api->post('refresh','App\Http\Controllers\Auth\LoginController@refresh');
        });
    });
});
