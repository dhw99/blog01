@extends('admin.public')
@section('title','添加轮播图')
@section('top')
@endsection
@section('right')
@endsection
@section('left')
    <script>
        $(document).ready(function () {
            $('#myForm').validate({
                rules:{
                    slide_name:{
                        required:true,
                        maxlength: 50,
                    },
                    slide_url:{
                        required:true,
                    },
                },
                messages:{
                    slide_name: {
                        required: "轮播图名称不能为空",
                        malength: "轮播图名称长度不能够超过50"
                    },
                    slide_url: {
                        required: "轮播图地址不能为空",
                    },
                }
            });
        })
    </script>
<article class="page-container">
    <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a>
	<form  action="{{url('admin/sAdd')}}" method="post" id="myForm" class="form form-horizontal">
		@csrf
		<div class="row cl" >
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>
                轮播图名称：</label>
			<div class="formControls col-xs-8 col-sm-9" style="width: 30%">
                <input type="text" id="slide_name" class="input-text" value="" placeholder="请输入轮播图名称" name="slide_name">
            </div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">排序值：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="0" placeholder="" name="slide_sort" style="width: 20%" />
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">轮播图地址：</label>
			<div class="formControls col-xs-8 col-sm-9" style="width: 50%">
				<input type="text" class="input-text" value="" placeholder="" id="slide_url" name="slide_url">
			</div>
		</div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">轮播图图片：</label>
            <div class="formControls col-xs-8 col-sm-9" style="width: 50%">
                <div id="queue"></div>
                <script src="{{url('admin/uploadify/jquery.uploadifive.js')}}" type="text/javascript"></script>
                <input id="file_upload" type="file" name="file_upload" />
                <input type="text" size="50" name="slide_pic" value="">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">轮播图展示：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <img src="" id="slide_img" alt="">
            </div>
        </div>
		<div class="row cl">
			<div class="col-xs-12 col-sm-12 col-xs-offset-4 col-sm-offset-2">
                <input type="submit" class="btn btn-primary btn-group-lg radius" value="添加轮播图">
			</div>
		</div>
	</form>
</article>
    <script>
        <?php $timestamp = time();?>
        $(function() {
            $('#file_upload').uploadifive({
                auto:true,
                'buttonText':'上传图片',
                'imageType':'image/*',
                'checkScript':'{{url("admin/uploadify/check-exists.php")}}',
                'formData'         : {
                    'timestamp' : '<?php echo $timestamp;?>',
                    '_token'     : '{{csrf_token()}}'
                },
                'queueID': 'queue',
                'uploadScript':'{{url('admin/upload1')}}',
                'onUploadComplete' : function(file, data) {
                    $('input[name=slide_pic]').val(data);
                    if(data){
                        $('#slide_img').attr('src','/'+data);
                        layer.alert('上传图片成功！',{icon: 6});
                    }

                }
            });
        });
    </script>
@endsection
