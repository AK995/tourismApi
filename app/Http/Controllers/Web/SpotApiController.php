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
        $searchContent = $request->input('locale_name','spot_name','open_time');

        $spotsList = Spot::where('locale_name','like', "%{$searchContent}%")->orWhere('spot_name','like', "%{$searchContent}%")
                ->get()
                ->toArray();
        if($spotsList == []){
            $isExist = "抱歉，没有找到该景点";
            return response()->json([0, '成功', $isExist]); 
        }
        return response()->json([0, '成功', $spotsList]);
    }
}
