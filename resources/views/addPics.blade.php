<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form method="post" action="{{url('pics')}}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div>
            <label for="file">景点名：</label><br>
            <input type="text" name="spot_name" id="">
        </div>
        <div>
            <label>多图上传</label>
            <div>
                <input type="file" name="imgSrc[]" multiple="multiple">
            </div>
        </div>

        <div>
            <button>立即提交</button>
        </div>

    </form>
</body>

</html>