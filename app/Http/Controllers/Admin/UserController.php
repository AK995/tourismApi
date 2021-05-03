<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Models\User;
use App\Transformers\UserTransformer;

class UserController extends BaseController
{
    /**
     * 用户列表
     */
    public function index(Request $request)
    {
        // 搜索
        $name = $request->input('name');
        $email = $request->input('email');

        $users = User::when($name,function($input) use ($name) {
            // 闭包函数不能直接使用外部变量，故加use传入$name
            $input->where('name','like',"%$name%");
        })
        ->when($email,function($input) use ($email) {
            $input->where('email',$email);
        })
        ->paginate(3);

        // 响应集合
        return $this->response->paginator($users,new UserTransformer());
    }

    /**
     * 用户详情
     */
    public function show(User $user)
    {
        return $this->response->item($user,new UserTransformer);
    }

     /**
     * 禁用/启用用户
     */
    public function lock(User $user)
    {
        $user-> is_locked = $user-> is_locked == 0 ? 1 : 0;
        $user->save();
        return $this->response->noContent();
    }
}
