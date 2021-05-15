<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\JWT;
use Illuminate\Support\Facades\Auth;

class LoginController extends BaseController
{

    /**
     * 使用框架auth用户认证后，进行账号注销退出无法实现。
     * 只有清除浏览器缓存，才能实现账号退出。--解决方法
     */
    public function __construct()
    {
        $this->middleware('guest',['except'=>'logout']);
    }

    /**
     * 登录
     *
     */
    public function login(LoginRequest $request)
    {
        $credentials = request(['email', 'password']);

        if (!$token = auth('api')->attempt($credentials)) {
            return $this->response->errorUnauthorized();
        }
        
        // 检查用户状态,获取登录用户的信息
        $user = auth('api')->user(); 

        // 该判断未实现，请忽略
        if ($user->is_locked == 1) {
            return $this->response->errorForbidden('该用户已登录！');
        }

        $tokenInfo = $this->respondWithToken($token);  
        
        //$access 获取关联数组array['access_token'=>'','token_type'=>'','expires_in'=>3600]
        $access = $tokenInfo->getOriginalContent();

        // $new 获取关联数组中指定的键值： 键 'access_token'，值 token 
        $new = Arr::get($access,'access_token');
       
        // 将获取的token写入数据库
        User::where('email','=',$request->email)->update(['remember_token'=>$new]);
        // dd($tokenInfo);  

        return $this->respondWithToken($token);
    }

    /**
     * 退出登录
     */
    public function logout(Request $request)
    {
        // 获取认证用户的id
        $id = Auth::id();

        // 退出登录
        $res = auth('api')->logout();
   
        if($res == null){
            // 将该认证用户的 $remember_token 置为 null，成功则返回1，否则返回0
            $token =User::where('id','=',$id)->update(['remember_token'=>null]);

            return response()->json(['code' => 200,'msg' => '成功',$token]);
        }
        return $this->response->noContent();
    }

    /**
     * 刷新token
     */
    public function refresh(Request $request)
    {
        // 刷新token尚未实现写入数据库
        return $this->respondWithToken(auth('api')->refresh());
    }

    /**
     * 格式化返回
     */
    protected function respondWithToken($token)
    {
        return $this->response()->array([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 600
        ]);
    }

}
