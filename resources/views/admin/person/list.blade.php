@extends('admin.public')
@section('title','个人介绍列表')
@section('top')
@endsection
@section('right')
@endsection
@section('left')
<nav class="breadcrumb">
	<i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 个人介绍
    <span class="c-gray en">&gt;</span>
    个人介绍列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a>
</nav>

	<div class="cl pd-5 bg-1 bk-gray mt-20">
		<span class="l">
			<a class="btn btn-primary radius" href="{{url('admin/aboutAdd')}}">
				<i class="Hui-iconfont">&#xe600;</i> 添加个人介绍
			</a>
		</span>
	</div>

	<div class="mt-20">
		<table class="table table-border table-bordered table-bg table-hover table-sort table-responsive">
			<thead>
				<tr class="text-c">
					<th width="80">ID</th>
					<th>标题</th>
					<th>姓名</th>
					<th width="150">职业</th>
					<th>电子邮箱</th>
					<th>微信号</th>
					<th width="120">操作</th>
				</tr>
			</thead>
			<tbody>
            @foreach($ret as $v)
				<tr class="text-c">
                    <td>{{$v->about_id}}</td>
					<td style="text-align: left">
						{{$v->about_title}}
                    </td>
					<td class="text-l">
                        <u style="cursor:pointer" class="text-primary" title="查看">
                           {{$v->about_author}}
                        </u>
                    </td>
                    <td class="keytext">{{$v->about_job}}</td>
                    <td class="keytext">{{$v->about_email}}</td>
					<td class="keytext">{{$v->about_weixin}}</td>
					<td class="f-14 td-manage">
                        <a  class="ml-5"  href="{{url('admin/aboutEdit',['about_id'=>$v->about_id])}}" title="编辑">
                            <i class="Hui-iconfont">&#xe6df;编辑
                            </i>
                        </a>
                        <a href="{{url('admin/aboutDel',['about_id'=>$v->about_id])}}" title="删除">
                            <i class="Hui-iconfont">&#xe6e2;删除
                            </i>
                        </a>
                    </td>
				</tr>
                @endforeach
			</tbody>
		</table>
    </div>


		<script>
            function aSort(obj,about_id){
                var about_sort = $(obj).val();
                $.post("{{url('admin/aSort')}}",{'_token':'{{csrf_token()}}','about_id':about_id,'about_sort':about_sort},function(data){
                    if (data.status == 0){
                        layer.alert(data.mes, {icon: 6});
                    } else{
                        layer.alert(data.mes, {icon: 5});
                    }

                });
            }
		</script>
<script>
    $(document).ready(function(){
        $('.keytext').each(function(){
            var maxwidth=23;
            if($(this).text().length>maxwidth){
                $(this).text($(this).text().substring(0,maxwidth));
                $(this).html($(this).html()+'.....');
            }
        });
    });
</script>
	</div>
</div>
<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="lib/My97DatePicker/4.8/WdatePicker.js"></script>
<script type="text/javascript" src="lib/datatables/1.10.0/jquery.dataTables.min.js"></script>


@endsection

