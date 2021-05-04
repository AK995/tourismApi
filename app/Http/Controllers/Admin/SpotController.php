<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Models\Spot;

class SpotController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $spots = Spot::all();
        return $spots;
    }

    /**
     * 添加景点信息
     */
    public function store(Request $request)
    {
        $request->validate([
            'locale_name' => 'required|max:16'],
            ['locale_name.required' => '地区不能为空']
        );

        $pid = $request->input('pid',0);
        $insertData = [
            'locale_name' => $request->input('locale_name'),
            'content' => $request->input('content'),
            'pid' => $pid,
            'level' => $pid == 0 ? 1 : (Spot::find($pid)->level + 1)
        ];

        // 计算level

        Spot::create($insertData); 
        return $this->response->created();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        // 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

}
