@extends('index.home')
@section('title','首页')
@section('meta')
    <meta name="keywords" content="个人博客,个人博客,个人博客模板" />
    <meta name="description" content="个人博客" />
    @endsection
@section('content')
    <!-- 文章列表开始 -->
    <div class="blogs">
        <div class="mt20"></div>
        @foreach($wen as $v)
        <li>
            <span class="blogpic">
                <a href="{{url('list/'.$v->art_id)}}">
                    @if($v->art_pic)
                    <img src="{{url(''.$v->art_pic)}}">
                        @else
                        <img src="{{url(''.'index/images/text01.jpg')}}">
                        @endif
                </a>
            </span>
            <h3 class="blogtitle"><a href="{{url('list/'.$v->art_id)}}">{{mb_substr($v->art_title,0,30).'....'}}</a></h3>
            <div class="bloginfo">
                <p>{{$v->art_des}}</p>
            </div>
            <div class="autor">
                <span class="dtime">{{$v->updated_at}}</span>
                <span class="viewnum">浏览（<a href="/">{{$v->art_count}}</a>）</span>
                <span class="readmore"><a href="{{url('list/'.$v->art_id)}}">阅读原文</a></span></div>
        </li>
        @endforeach
        <div class="pagelist">
            <style>
                ul li{
                    float: left;
                }
            </style>
            {!! $wen->links() !!}
        </div>
    </div>
    <!-- 文章列表 -->
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
        <!-- 站长推荐4篇 -->
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
        <!-- 友情链接 -->
        <div class="links">
            <h2 class="hometitle">友情链接</h2>
            <ul>
                @foreach($link as $l)
                <li><a href="{{$l->link_url}}" title="{{$l->link_title}}">{{$l->link_name}}</a></li>
                @endforeach
            </ul>
        </div>
    </div>
    @endsection