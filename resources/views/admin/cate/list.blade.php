@extends('admin.public')
@section('title','后台首页')
@section('top')
@endsection
@section('right')
@endsection
@section('left')
<nav class="breadcrumb">
	<i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 分类管理
    <span class="c-gray en">&gt;</span>
    分类列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a>
</nav>
<form action="{{url('admin/cpDel')}}" method="post">
    @csrf
	<div class="cl pd-5 bg-1 bk-gray mt-20">
		<span class="l">
			<button href="javascript:;" type="submit"  class="btn btn-danger radius">
				<i class="Hui-iconfont">&#xe6e2;</i> 批量删除
			</button>
			<a class="btn btn-primary radius" href="{{url('admin/cAdd')}}">
				<i class="Hui-iconfont">&#xe600;</i> 添加分类
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
					<th>分类名称</th>
					<th>分类标题</th>
					<th width="120">创建时间</th>
					<th width="120">更新时间</th>
					<th width="120">操作</th>
				</tr>
			</thead>
			<tbody>
            @foreach($val as $v)
				<tr class="text-c">
					<td>
                        <input type="checkbox" value="{{$v->cate_id}}" name="cate_id[]">
                    </td>
                    <td>{{$v->cate_id}}</td>
                    <td>
						<input style="width: 40%;text-align: center" type="text" value="{{$v->cate_sort}}" name="cate_sort" onchange="changSort(this,{{$v->cate_id}})">
					</td>
					<td style="text-align: left">
                        @if($v->name)
                        {{$v->name}}
                            @else
                            {{$v->cate_name}}
                            @endif
                    </td>
					<td class="text-l">
                        <u style="cursor:pointer" class="text-primary" title="查看">
                            {{$v->cate_title}}
                        </u>
                    </td>
					<td>{{$v->created_at}}</td>
					<td>{{$v->updated_at}}</td>
					<td class="f-14 td-manage">
                        <a  class="ml-5"  href="{{url('admin/cEdit',['cate_id'=>$v->cate_id])}}" title="编辑">
                            <i class="Hui-iconfont">&#xe6df;编辑
                            </i>
                        </a>
                        <a href="{{url('admin/cDel',['cate_id'=>$v->cate_id])}}" title="删除">
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
            function changSort(obj,cate_id){
                var cate_sort = $(obj).val();
                $.post("{{url('admin/changeSort')}}",{'_token':'{{csrf_token()}}','cate_id':cate_id,'cate_sort':cate_sort},function(data){
                    if (data.status == 0){
                        layer.alert(data.mes, {icon: 6});
                    } else{
                        layer.alert(data.mes, {icon: 5});
                    }

                });
            }
		</script>
	</div>
</div>
<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="lib/My97DatePicker/4.8/WdatePicker.js"></script>
<script type="text/javascript" src="lib/datatables/1.10.0/jquery.dataTables.min.js"></script>


@endsection

