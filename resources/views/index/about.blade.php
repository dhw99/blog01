@extends('index.home')
@section('title',"{$value->about_title}")
@section('meta')
  <meta name="keywords" content="个人博客,个人博客,个人博客模板" />
  <meta name="description" content="个人博客" />
@endsection

@section('content')
  <h1 class="t_nav"><span>{{$value->about_des}}</span>
    <a href="{{url('')}}" class="n1">网站首页</a>
    @foreach($about as $a)
    <a href="{{url($a->nav_url)}}" class="n2">关于我</a>
    @endforeach
  </h1>
  <div class="ab_box">
    <div class="leftbox">
      <div class="newsview">
        <div class="news_infos">
          {!! $value->about_content !!}
        </div>
      </div>
    </div>
    @endsection
    @section('right')
    <div class="rightbox">
      <div class="aboutme">
        <h2 class="hometitle">{{$value->about_title}}</h2>
        <div class="avatar"> <img src="/{{$value->about_pic}}"> </div>
        <div class="ab_con">
          <p>网名：{{$value->about_author}}</p>
          <p>职业：{{$value->about_job}} </p>
          <p>个人微信：{{$value->about_weixin}}</p>
          <p>邮箱：{{$value->about_email}}</p>
        </div>
      </div>
    </div>
  </div>
@endsection
