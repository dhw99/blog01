@extends('admin.public')
@section('title','首页信息界面')
@section('top')
@endsection
@section('left')
	<div class="page-container">
		<p class="f-20 text-success">欢迎来到博客后台</p>
		<table class="table table-border table-bordered table-bg mt-20">
			<thead>
			<tr>
				<th colspan="2" scope="col">服务器信息</th>
			</tr>
			</thead>
			<tbody>
			<tr>
				<td>服务器IP地址</td>
				<td>{{$_SERVER['SERVER_ADDR']}}</td>
			</tr>
			<tr>
				<td>服务器域名</td>
				<td>{{$_SERVER['HTTP_HOST']}}</td>
			</tr>
			<tr>
				<td>服务器端口 </td>
				<td>{{$_SERVER['SERVER_PORT']}}</td>
			</tr>
			<tr>
				<td>服务器操作系统 </td>
				<td>{{PHP_OS}}</td>
			</tr>
			<tr>
				<td>当前运行环境</td>
				<td>{{$_SERVER['SERVER_SOFTWARE']}}</td>
			</tr>
			<tr>
				<td>系统所在文件夹 </td>
				<td>{{$_SERVER['DOCUMENT_ROOT']}}</td>
			</tr>
			<tr>
				<td>服务器当前时间 </td>
				<td>{{date('Y-m-d H:i:s',time())}}</td>
			</tr>
			<tr>
				<td>当前系统用户名 </td>
				<td>{{session('info')['aname']}}</td>
			</tr>
			</tbody>
		</table>
	</div>
@endsection
@section('right')
@endsection
