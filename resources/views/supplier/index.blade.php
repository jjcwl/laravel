@extends('comm')

@section('content')
<div class="container">
	<div class="row clearfix">
		<div class="col-md-12 column">
			 
			<table class="table table-bordered table-hover">
				<thead>
					<tr>
						<th colspan="5">
							<a  href="{{url('supplier/add')}}">添加</a>
							<a  href="{{url('supplier/export')}}">导出</a>
							<a  href="{{url('supplier/uploads')}}">导入</a>
						</th>
					</tr>
					<tr>
						<th>
							编号
						</th>
						<th>
							发运站点
						</th>
						<th>
							主要煤种
						</th>
						<th>
							年发运量
						</th>
						<th>
							操作
						</th>
					</tr>
				</thead>
				<tbody>
					@foreach($supplier as $v)
					<tr class="warning">
						<td>
							{{$v->s_id}}
						</td>
						<td>
							{{$v->s_site}}
						</td>
						<td>
							{{$v->s_seed}}
						</td>
						<td>
							{{$v->s_volume}}
						</td>
						<td>
							<a href="{{url('supplier/del')}}?id={{$v->s_id}}">删除</a>|
							<a href="{{url('supplier/mod')}}?id={{$v->s_id}}">修改</a>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
@endsection