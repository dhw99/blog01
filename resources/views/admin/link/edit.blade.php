@extends('admin.public')
@section('title','修改友情链接')
@section('top')
@endsection
@section('right')
@endsection
@section('left')
    <script>
        $(document).ready(function () {
            $('#myForm').validate({
                rules:{
                    link_name:{
                        required:true,
                        maxlength: 30,
                    },
                    link_url:{
                        required:true,
                    },
                },
                messages:{
                    cate_name: {
                        required: "友情链接名称不能为空",
                        malength: "友情链接名称长度不能够超过30"
                    },
                    link_url: {
                        required: "友情链接地址不能为空",
                    },
                }
            });
        })
    </script>
<article class="page-container">
    <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a>
	<form  action="{{url('admin/lEdit',['link_id'=>$fen->link_id])}}" method="post" id="myForm" class="form form-horizontal">
		@csrf
		<div class="row cl" >
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>
                友情链接名称：</label>
			<div class="formControls col-xs-8 col-sm-9" style="width: 30%">
                <input type="text" id="link_name" class="input-text" value="{{$fen->link_name}}" placeholder="请输入友情链接名称" name="link_name">
            </div>
		</div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">友情链接标题：</label>
            <div class="formControls col-xs-8 col-sm-9" style="width: 30%">
                <input type="text" id="link_title" class="input-text" value="{{$fen->link_title}}" placeholder="请输入友情链接标题" name="link_title">
            </div>
        </div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">排序值：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="{{$fen->link_sort}}" placeholder="" name="link_sort" style="width: 20%" />
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">友情链接地址：</label>
			<div class="formControls col-xs-8 col-sm-9" style="width: 50%">
				<input type="text" class="input-text" value="{{$fen->link_url}}" placeholder="" id="link_url" name="link_url">
			</div>
		</div>
		<div class="row cl">
			<div class="col-xs-12 col-sm-12 col-xs-offset-4 col-sm-offset-2">
                <input type="submit" class="btn btn-primary btn-group-lg radius" value="修改友情链接">
			</div>
		</div>
	</form>
</article>

@endsection
