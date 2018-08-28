<!doctype html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <title>后台注册</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
    <link type="text/css" rel="stylesheet" href="{{url('admin/css/login.css')}}">
    <script type="text/javascript" src="{{url('admin/js/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{url('admin/layer/layer.js')}}"></script>
</head>
<body class="login_bj" >
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <script>
                    layer.msg('{{ $error }}',{icon:5})
                </script>
            @endforeach
        </ul>
    </div>
@endif
@if (session('error'))
    <script>
        layer.msg("{{ session('error')}}",{icon:5})
    </script>
@endif
<div class="zhuce_body">
    <div class="zhuce_kong">
        <div class="zc">
            <div class="bj_bai">
                <h3>欢迎注册</h3>
                <form action="{{url('admin/reg')}}" method="post">
                    @csrf
                    <input name="aname" type="text" class="kuang_txt phone" placeholder="用户名">
                    <input name="email" type="text" class="kuang_txt email" placeholder="邮箱">
                    <input name="pass" type="password" class="kuang_txt possword" placeholder="密码">
                    <input name="pass1" type="password" class="kuang_txt possword" placeholder="请再次输入密码">
                    <input name="code" type="text" class="kuang_txt yanzm" placeholder="验证码">
                    <div>
                        <div class="hui_kuang">
                            <img src="{{Captcha::src('flat')}}" onclick="this.src='{{Captcha::src('flat')}}'+Math.random()">
                        </div>
                    </div>
                    <br><br>
                    <div>
                        <input type="submit" class="btn_zhuce" value="注册">
                    </div>

                </form>
            </div>
            <div class="bj_right">
                <p>使用以下账号直接登录</p>
                <a href="#" class="zhuce_qq">QQ注册</a>
                <a href="#" class="zhuce_wb">微博注册</a>
                <a href="#" class="zhuce_wx">微信注册</a>
                <p>已有账号？<a href="{{url('admin/login')}}">立即登录</a></p>
            </div>
        </div>
    </div>
</div>
</body>
</html>