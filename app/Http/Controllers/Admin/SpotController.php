<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Models\Spot;
use App\Http\Requests\Admin\SpotRequest;
use App\Transformers\SpotTransformer;
use Illuminate\Support\Facades\Storage;

class SpotController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $spots = Spot::paginate(9);
        return $this->response->paginator($spots,new SpotTransformer());
    }

    /**
     * 添加景点信息
     */
    public function store(SpotRequest $request)
    {
        // $request->validate([
        //     'locale_name' => 'required|max:16'],
        //     ['locale_name.required' => '地区不能为空'],
        //     ['spot_name' => 'required|unique:spot'],
        //     ['file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'],
        // );
        // $img = "";

        // $insertData = [
        //     'locale_name' => $request->input('locale_name'),
        //     'spot_name' => $request->input('spot_name'),
        //     'spot_img' => $img,
        //     'level' => $pid == 0 ? 1 : (Spot::find($pid)->level + 1),
        //     'intro' => $request->input('intro'),
        //     'ticket_info' => $request->input('ticket_info'),
        //     'favor_policy' => $request->input('favor_policy'),
        //     'open_time' => $request->input('open_time'),
        //     'tips' => $request->input('tips'),
        //     'trans' => $request->input('trans'),
        // ];

        // // 计算level

        // Spot::create($insertData); 
        // return $this->response->created();

        Spot::create($request->all());
        return $this->response->created();
    }

    /**
     * 显示景点信息
     */
    public function show(Spot $spot)
    {
        return $this->response->item($spot,new SpotTransformer());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SpotRequest $request, Spot $spot)
    {
        
    }

    /**
     * 景点图片上传功能
     */
    public function uploadAvatar(Request $request){
        //上传文件 功能实现方法
        if ($request->isMethod('POST')){
            $file = $request->file('source');
            $spot_name = $request->spot_name;
            //判断文件是否上传成功
            if ($file->isValid()){
                //原文件名
                $originalName = $file->getClientOriginalName();

                //扩展名
                $ext = $file->getClientOriginalExtension();

                //MimeType
                $type = $file->getClientMimeType();

                //临时绝对路径
                $realPath = $file->getRealPath();
                // dd($realPath);  //E:\xampp\tmp\php6202.tmp

                // $filename = uniqid().'.'.$ext;
                $filename = $spot_name.'.'.$ext;
                // dd($filename); //609e214c563ff.PNG

                $bool = Storage::disk('uploads')->put($filename,file_get_contents($realPath));
                $spot = new Spot();
                
                $spot->avatar = Spot::where('spot_name','LIKE','%'.$spot_name.'%')->update(['avatar'=>$filename],);

                //判断是否上传成功
                if($bool){
                    echo 'you are success';
                }else{
                    echo 'fail';
                }
            }
        }
        return view('addSpot');
    }

    public function uploadPics(Request $request){
        $pics = $request->file('imgSrc');
        $spot = new Spot();
        $spot_name = $request->spot_name;
        foreach($pics as $index => $pic){
            $arr[$index] = $pic->store('imgSrc');
            $spot->pics = Spot::where('spot_name','LIKE','%'.$spot_name.'%')->update(['pics'=>$arr[$index]],);
        }
        dd($spot->pics);
        if($spot->pics){

        }
    return view('addPics');
    }

}
