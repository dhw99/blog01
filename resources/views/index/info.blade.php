@extends('index.home')
@section('title',"{$cate->cate_name}")
@section('meta')
    <meta name="keywords" content="{{$cate->keywords}}" />
    <meta name="description" content="{{$cate->description}}" />
    @endsection
@section('content')
    <h1 class="t_nav">
        <span>{{$cate->cate_title}}</span>
        <a href="{{url('')}}" class="n1">网站首页</a>
        <a href="{{url('nav/'.$cate->cate_id)}}" class="n2">{{$cate->cate_name}}</a>
    </h1>
    <div class="blogs">
        <div class="mt20"></div>
        @foreach($wen as $vv)
            <li>
            <span class="blogpic">
                <a href="{{url('list/'.$vv->art_id)}}">
                    @if($vv->art_pic)
                        <img src="{{url(''.$vv->art_pic)}}">
                    @else
                        <img src="{{url(''.'index/images/text01.jpg')}}">
                    @endif
                </a>
            </span>
                <h3 class="blogtitle"><a href="{{url('list/'.$vv->art_id)}}">{{mb_substr($vv->art_title,0,30).'....'}}</a></h3>
                <div class="bloginfo">
                    <p>{{$vv->art_des}}</p>
                </div>
                <div class="autor">
                    <span class="dtime">{{$vv->updated_at}}</span>
                    <span class="viewnum">浏览（<a href="/">{{$vv->art_count}}</a>）</span>
                    <span class="readmore"><a href="{{url('list/'.$vv->art_id)}}">阅读原文</a></span></div>
            </li>
        @endforeach
        <div class="pagelist">
            {!! $wen->links() !!}
        </div>
    </div>
    <!-- 文章列表结束 -->
    @endsection

@section('right')
    <div class="sidebar">
        <!-- 搜索 -->
        <div class="search">
            <form action="{{url('search')}}" method="post" >
                @csrf
                <input name="search" id="keyboard" class="input_text" value="请输入关键字" style="color: rgb(153, 153, 153);" onfocus="if(value=='请输入关键字'){this.style.color='#000';value=''}" onblur="if(value==''){this.style.color='#999';value='请输入关键字'}" type="text">
                <input class="input_submit" value="搜索" type="submit">
            </form>
        </div>
        <div class="lmnav">
            <h2 class="hometitle">栏目导航</h2>
            <ul class="navbor">
                @foreach($data as $d)
                    @if($d->cate_name == '关于我')
                        <li>
                        <a href="{{url('about/'.$d->cate_id)}}">
                            {{$d->cate_name}}
                        </a>
                        </li>
                        @else
                <li>
                    <a href="{{url('nav/'.$d->cate_id)}}">
                                {{$d->cate_name}}
                    </a>
                </li>
                    @endif
                @endforeach
            </ul>
        </div>
        <!-- 点击排行5篇 -->
        <div class="paihang">
            <h2 class="hometitle">点击排行</h2>
            <ul>
                @foreach($pai as $p)
                    <li>
                        <b>
                            <a href="{{url('list/'.$p->art_id)}}" target="_blank">{{$p->art_title}}</a>
                        </b>
                        <p>
                            <i>
                                @if($p->art_pic)
                                    <img src="{{url(''.$p->art_pic)}}">
                                @else
                                    <img src="{{url(''.'index/images/text01.jpg')}}">
                                @endif
                            </i>{{$p->art_des}}
                        </p>
                    </li>
                @endforeach
            </ul>
        </div>
        <!-- 站长推荐 -->
        <div class="paihang">
            <h2 class="hometitle">站长推荐</h2>
            <ul>
                @foreach($tui as $tui)
                    <li>
                        <b>
                            <a href="{{url('list/'.$tui->art_id)}}" target="_blank">{{$tui->art_title}}</a>
                        </b>
                        <p>
                            <i>
                                @if($tui->art_pic)
                                    <img src="{{url(''.$tui->art_pic)}}">
                                @else
                                    <img src="{{url(''.'index/images/text01.jpg')}}">
                                @endif
                            </i>{{$tui->art_des}}</p>
                    </li>
                @endforeach
            </ul>
        </div>

    </div>
    @endsection