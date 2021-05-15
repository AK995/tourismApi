<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div >
    <div >文件上传</div>
        <div >
            <form class="form-horizontal" role="form" method="POST" action="{{url('avatar')}}" enctype="multipart/form-data">
                {{ csrf_field() }}

                <div >
                    <label for="file" >景点名：</label><br>
                    <input type="text" name="spot_name" id="">
                    <div >
                        <input id="file" type="file" class="form-control" name="source">
                    </div>
                </div>

                
                <div >
                    <div >
                        <button type="submit" ><i ></i>上传</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>

