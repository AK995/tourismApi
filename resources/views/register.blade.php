<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post" enctype="multipart/form-data">
        <!-- {{csrf_field()}} -->
            用户名：<input type="text" name="{{$user->name}}" value="">
            邮箱：<input type="email" name="{{$user->email}}" >
            密码：<input type="password" name="{{ $user->password}}" id="">
            确认密码：<input type="password" name="{{ $user->password}}" id="">
            <button type="submit" onclick="{{url('api/web/auth/register')}}">提交</button>    
        </form>
</body>
</html>