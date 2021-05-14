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
<div class="panel panel-default">
                <div class="panel-heading">文件上传</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{url('avatar')}}" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="file" class="col-md-4 control-label">景点名：</label><br>
                            <input type="text" name="spot_name" id="">
                            <div class="col-md-6">
                                <input id="file" type="file" class="form-control" name="source">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-sign-in"></i> 上传
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
</body>
</html>

