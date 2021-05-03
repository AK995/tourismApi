<?php

use App\Http\Controllers\Auth\RegisterController;

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', ['middleware' => 'api.throttle', 'limit' => 60, 'expires' => 1], function ($api) {
    // 路由组
    $api->group(['prefix' => 'auth'], function ($api) {
        // 注册
        $api->post('register','App\Http\Controllers\Auth\RegisterController@store');

        // 需要登陆的路由
        $api->group(['middleware' => 'api.auth'], function ($api) {
           
        });
    });
});
