<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="body">
        <form action="" method="post" enctype="multipart/form-data">
        <!-- {{csrf_field()}} -->
            <input type="hidden" name="art_thumb" value="">
            <button type="button" id="testImg" onclick="{{url('api/admin/users/avatar')}}">上传图片</button>
            <input type="file" name="avatar" id="photo_upload">
        </form>
    </div>
</body>
</html>