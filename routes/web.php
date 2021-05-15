<?php
use App\Http\Controllers\Auth\RegisterController;
Route::any('/',function(){
    return view('welcome');
});

Route::get('index',function(){
    return 12;
});

// 跳转到"addSpot.blade.php"
Route::any('toAddSpot',function(){
    return view('addSpot');
});
// 跳转到SpotController控制器，调用upload方法
Route::any('avatar','App\Http\Controllers\Admin\SpotController@uploadAvatar');


// 跳转到"addPics.blade.php"
Route::any('toAddPics',function(){
    return view('addPics');
});
// 跳转到SpotController控制器，调用upload方法
Route::any('pics','App\Http\Controllers\Admin\SpotController@uploadPics');

Route::post('search','App\Http\Controllers\Web\SpotApiController@search');