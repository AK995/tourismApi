<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;

class RegisterController extends BaseController
{

    public function toStore(RegisterRequest $request){
        
        return view('register');
    }

    /**
     * 用户注册
     */
    public function store(RegisterRequest $request){
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->is_locked = 0;
        $res = $user->save();
        
        if($res){
            return response()->json(['code' => 200,'msg' => '成功',$user]);
        }
        return $this->response->created();
    }
}
