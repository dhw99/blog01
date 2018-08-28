@extends('admin.public')
@section('title','添加分类')
@section('top')
@endsection
@section('right')
@endsection
@section('left')
<article class="page-container">
	<form class="form form-horizontal" id="form-article-add">
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>分类栏目：</label>
			<div class="formControls col-xs-8 col-sm-9"> <span class="select-box">
				<select name="articlecolumn" class="select">
					<option value="0">全部栏目</option>
					<option value="1">新闻资讯</option>
					<option value="11">├行业动态</option>
					<option value="12">├行业资讯</option>
					<option value="13">├行业新闻</option>
				</select>
				</span>
            </div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>
                分类名称：</label>
			<div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" value="" placeholder="" id="keywords" name="keywords">
            </div>
		</div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">分类标题：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" value="" placeholder="" id="keywords" name="keywords">
            </div>
        </div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">排序值：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="0" placeholder="" id="articlesort" name="articlesort" style="width: 20%" />
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
				<textarea name="abstract" cols="" rows="" class="textarea"></textarea>
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">添加图片：</label>
			<div class="formControls col-xs-8 col-sm-9">
                <input type="text" size="50" name="photo">
                <div id="queue"></div>
				<script src="{{url('admin/uploadify/jquery.uploadifive.js')}}" type="text/javascript"></script>
				<input id="file_upload" type="file" name="file_upload" />
			</div>
		</div>
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
                        console.log(data);
                    }
                });
            });
		</script>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">图片展示：</label>
			<div class="formControls col-xs-8 col-sm-9"><br>
				<img src="" id="photo_img" width="300" height="200" alt=""/>
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">添加文章：</label>
			<div class="formControls col-xs-8 col-sm-9 skin-minimal">
				<!-- 加载编辑器的容器 -->
				<script id="container" name="content" type="text/plain" style="height: 400px">

    			</script>
				<!-- 配置文件 -->
				<script type="text/javascript" src="{{url('admin/ueditor/ueditor.config.js')}}"></script>
				<!-- 编辑器源码文件 -->
				<script type="text/javascript" src="{{url('admin/ueditor/ueditor.all.js')}}"></script>
				<script>
					var ue = UE.getEditor('container');
				</script>
			</div>
		</div>
		<div class="row cl">
			<div class="col-xs-12 col-sm-12 col-xs-offset-4 col-sm-offset-2">
				<button onClick="article_save_submit();" class="btn btn-primary radius" type="submit"><i class="Hui-iconfont">&#xe632;</i>
				添加分类
				</button>
			</div>
		</div>
	</form>
</article>

@endsection
