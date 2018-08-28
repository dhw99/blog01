@extends('index.home')
@section('title','搜索结果')
@section('meta')
    <meta name="keywords" content="个人博客,个人博客,个人博客搜索" />
    <meta name="description" content="个人博客搜索" />
    @endsection
@section('content')
    <!-- 文章列表开始 -->
    <div class="blogs">
        <div class="mt20"></div>
        <li>
            <h2 class="hometitle">
                @if(!(gettype($wen)=='string'))
            <span style="float: right">
                系统搜索到约有
                <strong>
                    {{count($wen)}}
                </strong>项符合搜索结果
            </span>
                @endif
                搜索结果
            </h2>
        </li>
        @if(!(gettype($wen)=='string'))
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
            @else
            <li>
                <p style="text-align: center">{{$wen}}</p>
                <br><br><br><br><br><br><br><br><br><br><br><br>
                <br><br><br><br><br><br><br><br><br><br><br><br>
                <br><br><br><br><br><br><br><br><br><br><br><br>
                <br><br><br><br><br><br><br><br><br><br><br><br>
                <br><br><br><br><br><br><br><br><br><br><br><br>
            </li>
            @endif

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
                @foreach($dian as $d)
                    <li>
                        <b>
                            <a href="{{url('list/'.$d->art_id)}}" target="_blank">{{$d->art_title}}</a>
                        </b>
                        <p>
                            <i>
                                @if($d->art_pic)
                                    <img src="{{url(''.$d->art_pic)}}">
                                @else
                                    <img src="{{url(''.'index/images/text01.jpg')}}">
                                @endif
                            </i>{{$d->art_des}}
                        </p>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    </div>
    @endsection