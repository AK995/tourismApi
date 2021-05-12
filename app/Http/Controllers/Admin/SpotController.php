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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
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
     * 上传图片
     */
    public function uploadImg(Request $request){
        $request->validate([
            'avatar' => 'required',
        ],[
            'avatar.required' => '图片不能为空'
        ]);

        $file = $request->avatar; //获取文件
        // dd($file);
        $folderName = "uploads/imgs/avatars/".date("Ym/d",time()); //生成保存图片的路径

        $uploadPath = public_path(); //文件存储物理路径

        // 获取文件的后缀名
        $extension = strtolower($file->getClientOriginalExtension()) ? : 'png';

        // 拼接文件名 值如：1_1493521050.png
        $file_prefix = 1;
        $filename = $file_prefix . '_' . time() . '.' . $extension;

        $file->move($uploadPath,$filename); //将图片移动到我们的目标存储路径中
        
        $spot->avatar = $folderName.'/'.$filename;
        $spot->save();
        return $this->response->noContent();
    }

        public function img(Request $request){
            $uploadPath = '';
            switch($_FILES['photo']['error']){
                case 0:
                    $ftypes = ['image/gif','image/pjpeg','image/jpeg','/image/x-png'];
                    $type = $_FILES['photo']['type'];
                    if(in_array($type,$ftypes)){
                        $fname = $_FILES['photo']['name'];
                    }
            }
        }
}
