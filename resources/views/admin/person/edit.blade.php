@extends('admin.public')
@section('title','编辑个人介绍')
@section('top')
@endsection
@section('right')
@endsection
@section('left')
    <script>
        $(document).ready(function () {
            $('#myForm').validate({
                rules:{
                    container:{
                        required:true,
                        maxlength: 1000,
                    },
                    about_title:{
                        required:true,
                        maxlength: 25,
                    },
                },
                messages:{
                    container: {
                        required: "个人介绍内容不能为空",
                        malength: "个人介绍内容不能够超过1000"
                    },
                    about_title: {
                        required: "个人介绍标题不能为空",
                        malength: "个人介绍标题长度不能够超过25"
                    },
                }
            });
        })
    </script>
<abouticle class="page-container">
    <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a>
	<form  action="{{url('admin/aboutEdit',['about_id'=>$val->about_id])}}" method="post" id="myForm" class="form form-horizontal">
		@csrf
        <div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">
                <span class="c-red">*</span>介绍标题：</label>
			<div class="formControls col-xs-8 col-sm-9" style="width: 15%;text-align: center">
                    <input type="text" id="about_title" class="input-text" value="关于我" name="about_title">
            </div>
		</div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">作者：</label>
            <div class="formControls col-xs-8 col-sm-9" style="width: 30%">
                <input type="text" id="about_author" class="input-text" value="{{$val->about_author}}" placeholder="请输入作者名字" name="about_author">
            </div>
        </div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">职业：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="{{$val->about_job}}" placeholder="" name="about_job" style="width: 50%" />
			</div>
		</div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">微信号：</label>
            <div class="formControls col-xs-8 col-sm-9" style="width: 30%">
                <input type="text" id="about_weixin" class="input-text" value="{{$val->about_weixin}}" placeholder="请输入微信号" name="about_weixin">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">电子邮箱：</label>
            <div class="formControls col-xs-8 col-sm-9" style="width: 30%">
                <input type="text" id="about_email" class="input-text" value="{{$val->about_email}}" placeholder="请输入电子邮箱" name="about_email">
            </div>
        </div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">关键词：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="{{$val->about_key}}" placeholder="" id="keywords" name="about_key">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">个人介绍描述：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<textarea name="about_des" cols="" rows="" class="textarea">{{$val->about_des}}</textarea>
			</div>
		</div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">个人头像：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <div id="queue"></div>
                <script src="{{url('admin/uploadify/jquery.uploadifive.js')}}" type="text/javascript"></script>
                <input id="file_upload1" type="file"  />
                <input type="text" size="50" name="about_pic" value="{{$val->about_pic}}">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">头像展示：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <img src="{{url('/'.$val->about_pic)}}" id="about_img" class="img-circle" alt="">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">编辑个人介绍：</label>
            <div class="formControls col-xs-8 col-sm-9 skin-minimal">
                <!-- 加载编辑器的容器 -->
                <script id="container" name="about_content" type="text/plain">{!! $val->about_content !!}</script>
                <script type="text/javascript" src="{{url('admin/ueditor/ueditor.config.js')}}"></script>
                <!-- 编辑器源码文件 -->
                <script type="text/javascript" src="{{url('admin/ueditor/ueditor.all.js')}}"></script>
                <script>
                    var ue = UE.getEditor('container',{
                        toolbars: [
                            [
                            'fullscreen', 'source', '|', 'undo', 'redo', '|',
                            'bold', 'italic', 'underline', 'fontborder', '|', 'forecolor', 'backcolor', 'insertorderedlist', 'insertunorderedlist', 'selectall', 'cleardoc', '|',
                            'rowspacingtop', 'rowspacingbottom', 'lineheight', '|',
                            'customstyle', 'paragraph', 'fontfamily', 'fontsize', '|',
                            'directionalityltr', 'directionalityrtl', 'indent', '|',
                            'justifyleft', 'justifycenter', 'justifyright', 'justifyjustify', '|', 'insertcode',  '|', 'searchreplace'
                            ]
                            ],
                    });

                </script>
            </div>
        </div>
		<div class="row cl">
			<div class="col-xs-12 col-sm-12 col-xs-offset-4 col-sm-offset-2">
                <input type="submit" class="btn btn-primary btn-group-lg radius" value="编辑个人介绍">
			</div>
		</div>
	</form>
</abouticle>
    <script>
        <?php $timestamp = time();?>
        $(function() {
            $('#file_upload1').uploadifive({
                auto:true,
                'buttonText':'上传个人头像',
                'imageType':'image/*',
                'checkScript':'{{url("admin/uploadify/check-exists.php")}}',
                'formData'         : {
                    'timestamp' : '<?php echo $timestamp;?>',
                    '_token'     : '{{csrf_token()}}'
                },
                'uploadScript':'{{url('admin/upload2')}}',
                'onUploadComplete' : function(file, data) {
                    $('input[name=about_pic]').val(data);
                    if(data){
                        $('#about_img').attr('src','/'+data);
                        layer.alert('上传个人头像成功!');
                    }
                }
            });
        });
    </script>

@endsection
