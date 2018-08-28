<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    @section('jt')
        <link rel="stylesheet" href="{{url('admin/uploadify/uploadifive.css')}}">
    <!--[if lt IE 9]>
    <script type="text/javascript" src="{{url('admin/lib/html5shiv.js')}}"></script>
    <script type="text/javascript" src="{{url('admin/lib/respond.min.js')}}"></script>
    <![endif]-->
    <link rel="stylesheet" type="text/css" href="{{url('admin/static/h-ui/css/H-ui.min.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{url('admin/static/h-ui.admin/css/H-ui.admin.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{url('admin/lib/Hui-iconfont/1.0.8/iconfont.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{url('admin/static/h-ui.admin/skin/default/skin.css')}}" id="skin" />
    <link rel="stylesheet" type="text/css" href="{{url('admin/static/h-ui.admin/css/style.css')}}" />
    <!--[if IE 6]>
    <script type="text/javascript" src="{{url('admin/lib/DD_belatedPNG_0.0.8a-min.js')}}" ></script>
    <script>DD_belatedPNG.fix('*');</script>
    <![endif]-->
    <script type="text/javascript" src="{{url('admin/lib/jquery/1.9.1/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{url('js/jquery.validate.min.js')}}"></script>
    <script type="text/javascript" src="{{url('js/messages_zh.js')}}"></script>
    <link rel="stylesheet" href="{{url('css/bs/css/bootstrap.min.css')}}">
        <script src="{{url('css/bs/js/bootstrap.min.js')}}"></script>
    @show
    <title>@yield('title')</title>
</head>
<body>
<script  type="text/javascript" src="{{url('admin/layer/layer.js')}}"></script>
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
@if (session('success'))
    <script>
        layer.msg("{{ session('success')}}",{icon:6})
    </script>
@endif
@section('top')
<header class="navbar-wrapper">
    <div class="navbar navbar-fixed-top">
        <div class="container-fluid cl"> <a class="logo navbar-logo f-l mr-10 hidden-xs" href="/aboutHui.shtml">H-ui.admin</a> <a class="logo navbar-logo-m f-l mr-10 visible-xs" href="/aboutHui.shtml">H-ui</a>
            <span class="logo navbar-slogan f-l mr-10 hidden-xs">v3.1</span>
            <a aria-hidden="false" class="nav-toggle Hui-iconfont visible-xs" href="javascript:;">&#xe667;</a>
            <nav id="Hui-userbar" class="nav navbar-nav navbar-userbar hidden-xs">
                <ul class="cl">
                    <li>超级管理员</li>
                    <li class="dropDown dropDown_hover">
                        <a href="#" class="dropDown_A">admin <i class="Hui-iconfont">&#xe6d5;</i></a>
                        <ul class="dropDown-menu menu radius box-shadow">
                            <li><a href="#">切换账户</a></li>
                            <li><a href="{{url('admin/exit')}}">退出</a></li>
                        </ul>
                    </li>
                    <li id="Hui-skin" class="dropDown right dropDown_hover"> <a href="javascript:;" class="dropDown_A" title="换肤"><i class="Hui-iconfont" style="font-size:18px">&#xe62a;</i></a>
                        <ul class="dropDown-menu menu radius box-shadow">
                            <li><a href="javascript:;" data-val="default" title="默认（黑色）">默认（黑色）</a></li>
                            <li><a href="javascript:;" data-val="blue" title="蓝色">蓝色</a></li>
                            <li><a href="javascript:;" data-val="green" title="绿色">绿色</a></li>
                            <li><a href="javascript:;" data-val="red" title="红色">红色</a></li>
                            <li><a href="javascript:;" data-val="yellow" title="黄色">黄色</a></li>
                            <li><a href="javascript:;" data-val="orange" title="橙色">橙色</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</header>
@show
@section('right')
    <aside class="Hui-aside">
        <div class="menu_dropdown bk_2">
            <dl id="menu-article">
                <dt><i class="Hui-iconfont">&#xe616;</i> 分类管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
                <dd>
                    <ul>
                        <li>
                            <a data-href="{{url('admin/cList')}}" data-title="分类管理" href="javascript:void(0)">分类列表
                            </a></li>
                    </ul>
                </dd>
            </dl>
            <dl id="menu-picture">
                <dt><i class="Hui-iconfont">&#xe613;</i> 文章管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
                <dd>
                    <ul>
                        <li><a data-href="{{url('admin/aList')}}" data-title="文章管理" href="javascript:void(0)">文章列表</a></li>
                    </ul>
                </dd>
            </dl>
            <dl id="menu-picture">
                <dt><i class="Hui-iconfont">&#xe613;</i> 个人介绍<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
                <dd>
                    <ul>
                        <li><a data-href="{{url('admin/aboutList')}}" data-title="介绍管理" href="javascript:void(0)">个人介绍列表</a></li>
                    </ul>
                </dd>
            </dl>
            <dl id="menu-product">
                <dt><i class="Hui-iconfont">&#xe616;</i>友情链接<i class="Hui-iconfont menu_dropdown-arrow ">&#xe6d5;</i></dt>
                <dd>
                    <ul>
                        <li><a data-href="{{url('admin/lList')}}" data-title="友情链接" href="javascript:void(0)">友情链接列表</a></li>
                    </ul>
                </dd>
            </dl>
            <dl id="menu-comments">
                <dt><i class="Hui-iconfont">&#xe661;</i> 导航管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
                <dd>
                    <ul>
                        <li><a data-href="{{url('admin/nList')}}" data-title="导航列表" href="javascript:;">导航列表</a></li>
                    </ul>
                </dd>
            </dl>
            <dl id="menu-member">
                <dt><i class="Hui-iconfont">&#xe60d;</i> 轮播图管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
                <dd>
                    <ul>
                        <li><a data-href="{{url('admin/sList')}}" data-title="轮播图列表" href="javascript:;">轮播图列表</a></li>
                    </ul>
                </dd>
            </dl>
        </div>
    </aside>
    <div class="dislpayArrow hidden-xs">
        <a class="pngfix" href="javascript:void(0);" onClick="displaynavbar(this)">
        </a>
    </div>
@show
@section('left')
这里左边公共区域
@show
<div class="contextMenu" id="Huiadminmenu">
    <ul>
        <li id="closethis">关闭当前 </li>
        <li id="closeall">关闭全部 </li>
    </ul>
</div>
<!--_footer 作为公共模版分离出去-->

<script type="text/javascript" src="{{url('admin/lib/layer/2.4/layer.js')}}"></script>
<script type="text/javascript" src="{{url('admin/static/h-ui/js/H-ui.min.js')}}"></script>
<script type="text/javascript" src="{{url('admin/static/h-ui.admin/js/H-ui.admin.js')}}"></script> <!--/_footer 作为公共模版分离出去-->
@section('footer')
@show
<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="{{url('admin/lib/jquery.contextmenu/jquery.contextmenu.r2.js')}}"></script>

</body>
</html>