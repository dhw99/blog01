@extends('index.home')
@section('title',"{$list->art_title}")
@section('meta')
    <meta name="keywords" content="{{$list->art_key}}" />
    <meta name="description" content="{{$list->art_des}}" />
    @endsection
@section('content')
    <h1 class="t_nav">
        <span>
            @if($cate->name)
            您现在的位置是：首页 >{{$cate->name}} > {{$cate->cate_name}}
                @else
                您现在的位置是：首页 > {{$cate->cate_name}}
                @endif
        </span>
        <a href="{{url('')}}" class="n1">网站首页</a>
        <a href="{{url('nav/'.$cate->cate_id)}}" class="n2">{{$cate->cate_name}}</a></h1>
    <div class="infos">
        <div class="newsview">
            <h3 class="news_title">{{$list->art_title}}</h3>
            <div class="news_author">
                <span class="au01">
                    <a href="mailto:dancesmiling@qq.com">
                        {{empty($list->art_author)?'无名氏':$list->art_author}}</a>
                </span>
                <span class="au02">{{$list->created_at}}</span><span class="au03">共<b>{{$list->art_count}}</b>人围观</span>
            </div>
            <div class="news_infos">
                <br>
                <img alt="" src="{{empty($list->art_pic1)?url(''.'index/images/text01.jpg'):url(''.$list->art_pic1)}}"><br>
                {!! $list->art_content !!}
            </div>
        </div>
        <div class="share"> </div>
        <div class="nextinfo">
            <p>上一篇：
                @if($pre)
                <a href="{{url('list/'.$pre->art_id)}}">{{$pre->art_title}}</a></p>
            @else
                没有啦，这就是第一篇
            @endif
            <p>下一篇：
                @if($next)
                <a href="{{url('list/'.$next->art_id)}}">{{$next->art_title}}</a>
                    @else
                    没有啦
                    @endif
            </p>
        </div>
        <div class="otherlink">
            <h2>相关文章</h2>
            <ul>
                @foreach($xg as $g)
                <li><a href="{{url('list/'.$g->art_id)}}" title="{{$g->art_title}}">{{$g->art_title}}</a></li>
               @endforeach
            </ul>
        </div>
    </div>
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