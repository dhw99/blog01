@extends('admin.public')
@section('title','添加文章')
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
                    art_title:{
                        required:true,
                        maxlength: 50,
                    },
                },
                messages:{
                    container: {
                        required: "文章内容不能为空",
                        malength: "文章内容不能够超过1000"
                    },
                    art_title: {
                        required: "文章标题不能为空",
                        malength: "文章标题长度不能够超过25"
                    },
                }
            });
        })
    </script>
<article class="page-container">
    <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a>
	<form  action="{{url('admin/aAdd')}}" method="post" id="myForm" class="form form-horizontal">
		@csrf
        <div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>文章栏目：</label>
			<div class="formControls col-xs-8 col-sm-9" style="width: 15%;text-align: center">
                <span class="select-box">
				<select name="cate_id" class="select">
                    @foreach($val as $k=>$v)
					<option value="{{$v->cate_id}}">{{$v->cate_name}}</option>
                    @endforeach
				</select>
				</span>
            </div>
		</div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">文章标题：</label>
            <div class="formControls col-xs-8 col-sm-9" style="width: 40%">
                <input type="text" id="art_title" class="input-text" value="" placeholder="请输入文章标题" name="art_title">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">作者：</label>
            <div class="formControls col-xs-8 col-sm-9" style="width: 30%">
                <input type="text" id="art_author" class="input-text" value="" placeholder="请输入作者名字" name="art_author">
            </div>
        </div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">排序值：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="0" placeholder="" name="art_sort" style="width: 20%" />
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">关键词：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="" placeholder="" id="keywords" name="art_key">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">文章描述：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<textarea name="art_des" cols="" rows="" class="textarea"></textarea>
			</div>
		</div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">文章图片：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <div id="queue"></div>
                <script src="{{url('admin/uploadify/jquery.uploadifive.js')}}" type="text/javascript"></script>
                <input id="file_upload1" type="file" name="file_upload1" />
                <input type="text" size="50" name="art_pic1" value="">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">缩略图：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <div id="queue"></div>
                <script src="{{url('admin/uploadify/jquery.uploadifive.js')}}" type="text/javascript"></script>
                <input id="file_upload" type="file" name="file_upload" />
                <input type="text" size="50" name="art_pic" value="">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">缩略图展示：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <img src="" id="art_img" alt="">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">添加文章：</label>
            <div class="formControls col-xs-8 col-sm-9 skin-minimal">
                <!-- 加载编辑器的容器 -->
                <script id="container" name="art_content" type="text/plain"></script>
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
                <input type="submit" class="btn btn-primary btn-group-lg radius" value="添加文章">
			</div>
		</div>
	</form>
</article>
    <script>
        <?php $timestamp = time();?>
        $(function() {
            $('#file_upload1').uploadifive({
                auto:true,
                'buttonText':'上传文章图片',
                'imageType':'image/*',
                'checkScript':'{{url("admin/uploadify/check-exists.php")}}',
                'formData'         : {
                    'timestamp' : '<?php echo $timestamp;?>',
                    '_token'     : '{{csrf_token()}}'
                },
                'uploadScript':'{{url('admin/upload1')}}',
                'onUploadComplete' : function(file, data) {
                    $('input[name=art_pic1]').val(data);
                    if(data){
                        layer.alert('上传文章图片成功!');
                    }
                }
            });
        });
    </script>
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
                'uploadScript':'{{url('admin/upload')}}',
                'onUploadComplete' : function(file, data) {
                    $('input[name=art_pic]').val(data);
                    if(data){
                        $('#art_img').attr('src','/'+data);
                    }

                }
            });
        });
    </script>
@endsection
