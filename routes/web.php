<?php

use App\Http\Controllers\Auth\RegisterController;
Route::any('/',function(){
    return view('welcome');
});

Route::get('index',function(){
    return 12;
});

Route::resource('users',App\Http\Controllers\Admin\SpotController::class,[
    'except' => ['destroy']
]);

// 跳转到"addSpot.blade.php"
Route::any('toAddSpot',function(){
    return view('addSpot');
});
// 跳转到SpotController控制器，调用upload方法
Route::any('avatar','App\Http\Controllers\Admin\SpotController@upload');