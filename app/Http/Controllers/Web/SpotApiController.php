<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Models\Spot;

class SpotApiController extends BaseController
{
    /**
     * 搜索景点信息
     */
    public function search(Request $request)
    {
        $isExist = 1;
        $searchContent = $request->input('locale_name','spot_name');
        $res = Spot::where('locale_name','like', '%'.$searchContent.'%')
                    ->orWhere('spot_name','like','%'.$searchContent.'%')
                    ->get()
                    ->toArray();
 
        if($res == []){
            $isExist = '抱歉，没有找到该景点';
            return response()->json(['code'=>200, '请求成功', $isExist]); 
        }
        return response()->json(['code'=>200, '请求成功', $res]);
    }
}
