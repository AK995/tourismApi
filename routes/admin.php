<?php

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

// 登录后用到的路由
$api->version('v1', $params , function ($api) {
    $api->group(['prefix' => 'admin'],function($api) {

        $api->post('users/avatar','App\Http\Controllers\Admin\SpotController@img');

        // 需要登陆的路由
        $api->group(['middleware' => 'api.auth'],function($api) {
            /**
             * 用户管理
             */
            // 禁用/启用用户
            $api->patch('users/{user}/lock','App\Http\Controllers\Admin\UserController@lock');
    
            // 用户管理资源路由
            $api->resource('users',App\Http\Controllers\Admin\UserController::class,[
                'only' => ['index','show']
            ]);
 
            /**
             * 景点信息管理
             */
            // 景点信息管理资源路由
            $api->resource('users',App\Http\Controllers\Admin\SpotController::class,[
                'except' => ['destroy']
            ]);

           
            
        });
    });
});
