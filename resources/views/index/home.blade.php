<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>@yield('title')--laravel博客</title>
    @yield('meta')
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{url('index/css/base.css')}}" rel="stylesheet">
    <link href="{{url('index/css/index.css')}}" rel="stylesheet">
    <link href="{{url('index/css/m.css')}}" rel="stylesheet">

    <!--[if lt IE 9]>
    <script src="{{url('index/js/modernizr.js')}}"></script>
    <![endif]-->
    <script>
        window.onload = function ()
        {
            var oH2 = document.getElementsByTagName("h2")[0];
            var oUl = document.getElementsByTagName("ul")[0];
            oH2.onclick = function ()
            {
                var style = oUl.style;
                style.display = style.display == "block" ? "none" : "block";
                oH2.className = style.display == "block" ? "open" : ""
            }
        }
    </script>
</head>
<body>
<header>
    <div class="tophead">
        <div class="logo"><a href="/">laravel博客项目</a></div>
        <nav class="topnav" id="topnav">
            <ul style="float: right">
                @foreach($val as $v)
                <li><a href="{{url(''.$v->nav_url)}}">{{$v->nav_name}}</a></li>
                @endforeach
            </ul>
        </nav>
    </div>
</header>
<article>
    @section('content')
        @show
    @section('right')
        @show

</article>
<div class="blank"></div>
<script src="{{url('index/js/nav.js')}}"></script>
</body>
</html>
