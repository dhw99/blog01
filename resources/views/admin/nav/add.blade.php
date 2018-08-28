@extends('admin.public')
@section('title','添加导航')
@section('top')
@endsection
@section('right')
@endsection
@section('left')
    <script>
        $(document).ready(function () {
            $('#myForm').validate({
                rules:{
                    nav_name:{
                        required:true,
                        maxlength: 50,
                    },
                    nav_url:{
                        required:true,
                    },
                },
                messages:{
                    nav_name: {
                        required: "导航名称不能为空",
                        malength: "导航名称长度不能够超过50"
                    },
                    nav_url: {
                        required: "导航地址不能为空",
                    },
                }
            });
        })
    </script>
<article class="page-container">
    <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a>
	<form  action="{{url('admin/nAdd')}}" method="post" id="myForm" class="form form-horizontal">
		@csrf
		<div class="row cl" >
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>
                导航名称：</label>
			<div class="formControls col-xs-8 col-sm-9" style="width: 30%">
                <input type="text" id="nav_name" class="input-text" value="" placeholder="请输入导航名称" name="nav_name">
            </div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">排序值：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="0" placeholder="" name="nav_sort" style="width: 20%" />
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">导航地址：</label>
			<div class="formControls col-xs-8 col-sm-9" style="width: 50%">
				<input type="text" class="input-text" value="" placeholder="" id="nav_url" name="nav_url">
			</div>
		</div>
		<div class="row cl">
			<div class="col-xs-12 col-sm-12 col-xs-offset-4 col-sm-offset-2">
                <input type="submit" class="btn btn-primary btn-group-lg radius" value="添加导航">
			</div>
		</div>
	</form>
</article>

@endsection
