@extends('admin.public')
@section('title','添加分类')
@section('top')
@endsection
@section('right')
@endsection
@section('left')
    <script>
        $(document).ready(function () {
            $('#myForm').validate({
                rules:{
                    cate_name:{
                        required:true,
                        maxlength: 25,
                    },
                    cate_title:{
                        required:true,
                        maxlength: 50,
                    },
                },
                messages:{
                    cate_name: {
                        required: "分类名称不能为空",
                        malength: "分类名称长度不能够超过25"
                    },
                    cate_title: {
                        required: "分类标题不能为空",
                        malength: "分类标题长度不能够超过25"
                    },
                }
            });
        })
    </script>
<article class="page-container">
    <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a>
	<form  action="{{url('admin/cAdd')}}" method="post" id="myForm" class="form form-horizontal">
		@csrf
        <div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>分类栏目：</label>
			<div class="formControls col-xs-8 col-sm-9"> <span class="select-box">
				<select name="cate_pid" class="select">
					<option value="0">顶级栏目</option>
                    @foreach($val as $v)
                        @if($v->name)
					        <option value="{{$v->cate_id}}">{{$v->name}}</option>
                        @else
                            <option value="{{$v->cate_id}}">{{$v->cate_name}}</option>
                        @endif
                    @endforeach
				</select>
				</span>
            </div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>
                分类名称：</label>
			<div class="formControls col-xs-8 col-sm-9">
                <input type="text" id="cate_name" class="input-text" value="" placeholder="请输入分类名称" name="cate_name">
            </div>
		</div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">分类标题：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" id="cate_title" class="input-text" value="" placeholder="请输入分类标题" name="cate_title">
            </div>
        </div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">排序值：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="0" placeholder="" name="cate_sort" style="width: 20%" />
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">关键词：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="" placeholder="" id="keywords" name="keywords">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">分类描述：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<textarea name="description" cols="" rows="" class="textarea"></textarea>
			</div>
		</div>
		<div class="row cl">
			<div class="col-xs-12 col-sm-12 col-xs-offset-4 col-sm-offset-2">
                <input type="submit" class="btn btn-primary btn-group-lg radius" value="添加分类">
			</div>
		</div>
	</form>
</article>

@endsection
