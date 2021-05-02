<?php

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', ['middleware' => 'api.throttle', 'limit' => 60, 'expires' => 1], function ($api) {
    // 路由组
    $api->group(['prefix' => 'auth'], function ($api) {
        // 注册
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
