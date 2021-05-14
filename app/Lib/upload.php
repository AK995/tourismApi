<?php

namespace App\Lib;

use Illuminate\Support\Facades\Storage;

class upload {

    //单文件上传
    public function uploadOne($uploadName)
    {
        //调用request请求
        $request = app("request");
        //获取文件
        $file = $request->file($uploadName);
        //设置文件后缀
        $allowExtenstions = ['jpg', 'png', 'jpeg', 'gif', 'mp3', 'mp4'];
        //判断文件上传格式是否正确
        if ($file->getClientOriginalName() && !in_array($file->getClientOriginalExtension(), $allowExtenstions)) {
            return ["code" => 102, "message" => '文件上传格式错误!', "data" => []];
        }
        $pathRoot = params('uploadImg')['uploadPath'] . date('Y-m-d');
        if (!is_dir(public_path() . $pathRoot) && !@mkdir(public_path() . $pathRoot, 0777, true)) {
            return ["code" => 500, "message" => "目录创建失败", "data" => []];
        }
        //获取文件扩展名
        $ext = $file->getClientOriginalExtension();
        //获取临时文件的绝对路径
        $realPath = $file->getRealPath();
        //生成文件名,md5()加密
        $fileName = $pathRoot . '/' . md5(date("ymd", time()) . '-' . uniqid()) . '.' . $ext;

        $bool = Storage::disk('upload')->put($fileName, file_get_contents($realPath));

        //判断是否上传成功
        if (!$bool) {
            return ["code" => 500, "message" => "文件上传失败", "data" => []];
        }
        if ($ext == 'jpg' || $ext == 'png' || $ext == 'jpeg' || $ext == 'gif') {
            $fileArray = ["code" => 200, "data" => $fileName, "type" => 'image'];
        } elseif ($ext == 'mp4') {
            $fileArray = ["code" => 200, "data" => $fileName, "type" => 'mp4'];
        } elseif ($ext == "mp3") {
            $fileArray = ["code" => 200, "data" => $fileName, "type" => 'mp3'];
        } else {
            $fileArray = ["code" => 200, "data" => $fileName, "type" => 'other'];
        }
        return $fileArray;
    }

    //多文件上传
    public function uploadMuch($uploadName)
    {
        //调用request请求
        $request = app("request");
        //获取文件
        $file = $request->file($uploadName);
        //设置文件后缀
        $allowExtenstions = ['jpg', 'png', 'jpeg', 'gif', 'mp3', 'mp4'];
        //定义新数组
        $fileArray = [];
        //遍历数据
        foreach ($file as $k => $v) {
            //判断文件上传格式是否正确
            if ($v->getClientOriginalName() && !in_array($v->getClientOriginalExtension(), $allowExtenstions)) {
                return ["code" => 102, "message" => '文件上传格式错误!', "data" => []];
            }
            //获取文件扩展名
            $ext = $v->getClientOriginalExtension();
            //获取临时文件的绝对路径
            $realPath = $v->getRealPath();
            //生成文件名,md5()加密
            $fileName = date("Y-m-d") . '/' . md5(date("ymd", time()) . '-' . uniqid()) . '.' . $ext;
            //移动文件
            $bool = Storage::disk('uploads')->put($fileName, file_get_contents($realPath));
            //判断是否上传成功
            if (!$bool) {
                return ["code" => 500, "message" => "文件上传失败", "data" => []];
            }
            if ($ext == 'jpg' || $ext == 'png' || $ext == 'jpeg' || $ext == 'gif') {
                $fileArray[] = ["code" => 200, "data" => $fileName, "type" => 'image'];
            } elseif ($ext == 'mp4') {
                $fileArray[] = ["code" => 200, "data" => $fileName, "type" => 'mp4'];
            } elseif ($ext == "mp3") {
                $fileArray[] = ["code" => 200, "data" => $fileName, "type" => 'mp3'];
            } else {
                $fileArray[] = ["code" => 200, "data" => $fileName, "type" => 'other'];
            }
        }
        return $fileArray;
    }

    //上传Excel
    public function uploadExcel($uploadName)
    {
        //调用request请求
        $request = app("request");
        //获取文件
        $file = $request->file($uploadName);
        //设置文件后缀
        $allowExtenstions = ['xls'];
        //判断文件上传格式是否正确
        if ($file->getClientOriginalName() && !in_array($file->getClientOriginalExtension(), $allowExtenstions)) {
            return ["code" => 102, "message" => '文件上传格式错误!', "data" => []];
        }
        //获取文件扩展名
        $ext = $file->getClientOriginalExtension();
        //获取临时文件的绝对路径
        $realPath = $file->getRealPath();
        //生成文件名,md5()加密
        $fileName = date("Y-m-d") . '/' . md5(date("ymd", time()) . '-' . uniqid()) . '.' . $ext;
        //移动文件
        $bool = Storage::disk('uploads')->put($fileName, file_get_contents($realPath));
        //判断是否上传成功
        if (!$bool) {
            return ["code" => 500, "message" => "文件上传失败", "data" => []];
        }
        $fileArray = ["code" => 200, "data" => $fileName, "type" => 'xls'];
        return $fileArray;
    }

}
