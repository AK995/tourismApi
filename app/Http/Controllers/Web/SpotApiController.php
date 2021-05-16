<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Models\Spot;
use Illuminate\Support\Facades\DB;

class SpotApiController extends BaseController
{
    /**
     * 搜索景点信息
     */
    public function search(Request $request)
    {
        $isExist = 1;
        $locale_name = $request->locale_name;
        $spot_name = $request->spot_name;

        $localeName = '%'.$locale_name.'%';
        $spotName = '%'.$spot_name.'%';
        $sql = "select * from spots where locale_name like ? AND spot_name like ?";
        $res = DB::select($sql,[$localeName,$spotName]);

        if($res == []){
            $isExist = '抱歉，没有找到该景点';
            return response()->json(['code'=>200, 'msg'=>'请求成功', $isExist]); 
        }
        return response()->json(['code'=>200,'msg'=>'请求成功',$res]);
    }
}
