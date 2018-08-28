@extends('admin.public')
@section('title','轮播图列表')
@section('top')
@endsection
@section('right')
@endsection
@section('left')
<nav class="breadcrumb">
	<i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 轮播图管理
    <span class="c-gray en">&gt;</span>
    轮播图列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a>
</nav>
<form action="{{url('admin/spDel')}}" method="post">
    @csrf
	<div class="cl pd-5 bg-1 bk-gray mt-20">
		<span class="l">
			<button href="javascript:;" type="submit"  class="btn btn-danger radius">
				<i class="Hui-iconfont">&#xe6e2;</i> 批量删除
			</button>
			<a class="btn btn-primary radius" href="{{url('admin/sAdd')}}">
				<i class="Hui-iconfont">&#xe600;</i> 添加轮播图
			</a>
		</span>
		<span class="r">共有数据：<strong>{{$shu}}</strong> 条</span>
	</div>

	<div class="mt-20">
		<table class="table table-border table-bordered table-bg table-hover table-sort table-responsive">
			<thead>
				<tr class="text-c">
					<th width="25">
                        <input type="checkbox" name="" value="">
                    </th>
					<th width="80">ID</th>
					<th width="80">排序</th>
					<th width="80">轮播图名称</th>
					<th width="150">轮播图地址</th>
					<th width="150">轮播图片</th>
					<th width="120">操作</th>
				</tr>
			</thead>
			<tbody>
            @foreach($ret as $v)
				<tr class="text-c">
					<td>
                        <input type="checkbox" value="{{$v->slide_id}}" name="slide_id[]">
                    </td>
                    <td>{{$v->slide_id}}</td>
                    <td>
						<input style="width: 40%;text-align: center" type="text" value="{{$v->slide_sort}}" name="slide_sort" onchange="sSort(this,{{$v->slide_id}})">
					</td>
					<td style="text-align: left">
						{{$v->slide_name}}
                    </td>
					<td class="keytext">{{$v->slide_url}}</td>
					<td>
                        <img src="/{{$v->slide_pic}}" width="150px" height="100px" alt="">
                    </td>
					<td class="f-14 td-manage">
                        <a  class="ml-5"  href="{{url('admin/sEdit',['slide_id'=>$v->slide_id])}}" title="编辑">
                            <i class="Hui-iconfont">&#xe6df;编辑
                            </i>
                        </a>
                        <a href="{{url('admin/sDel',['slide_id'=>$v->slide_id])}}" title="删除">
                            <i class="Hui-iconfont">&#xe6e2;删除
                            </i>
                        </a>
                    </td>
				</tr>
                @endforeach
			<tr>
				<td colspan="10" style="text-align: center">
					<div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_0_paginate">
						{{$ret->links()}}
					</div>
				</td>
			</tr>
			</tbody>
		</table>
    </div>
</form>
<script>
            function sSort(obj,slide_id){
                var slide_sort = $(obj).val();
                $.post("{{url('admin/sSort')}}",{'_token':'{{csrf_token()}}','slide_id':slide_id,'slide_sort':slide_sort},function(data){
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

