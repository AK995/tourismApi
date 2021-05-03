<?php

use App\Http\Controllers\Auth\RegisterController;

$api = app('Dingo\Api\Routing\Router');

$params = [
    // 用到的中间件
    'middleware' => [
        'api.throttle',
        'bindings', //支持路由模型注入
        'serializer:array' //减少transformer的包裹层
    ],

    // 请求频率限制：1分钟只能请求60次
    'limit' => 60,
    'expires' => 1
];

$api->version('v1', $params, function ($api) {
    // 路由组
    $api->group(['prefix' => 'web'],function($api) {

        $api->post('spot/search','App\Http\Controllers\Web\SpotApiController@search');  

        $api->group(['prefix' => 'auth'], function ($api) {
            // 注册
            $api->post('register','App\Http\Controllers\Auth\RegisterController@store');

            // 需要登陆的路由
            $api->group(['middleware' => 'api.auth'], function ($api) {
                
            });
        });
    });
});
  