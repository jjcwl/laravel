@extends('comm')

@section('content') 	 

<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="table-responsive">
        <table class="table table-striped jambo_table bulk_action">
        <thead>
            <tr class="headings">
                <th><input type="checkbox" id="check-all" class="flat"></th>
                <th class="column-title">企业名称 </th>
                <th class="column-title">领域 </th>
                <th class="column-title">企业logo </th>
                <th class="column-title">所属行业 </th>
                <th class="column-title">联系人 </th>
                <th class="column-title">联系方式 </th>
                <th class="column-title">操作 </th>
                <th class="bulk-actions" colspan="8">
                <a class="antoo" style="color:#fff; font-weight:500;">批量操作 ( <span class="action-cnt"> </span>)<i class="fa fa-chevron-down"></i></a>
                </th>
            </tr>
        </thead>

        <tbody>

           @foreach($list as $v)
            <tr class="even pointer">
                <td class="a-center "><input type="checkbox" class="flat" name="table_records"></td>
                <td>{{$v->name}}</td>    
                <td>{{$v->field}}</td>
                <td><img src="{{asset('uploads'.'/'.$v->logo) }}" width="100px" height="70px"></td>
                <td>{{$v->iname}}</td>
                <td>{{$v->contact}}</td>
                <td>{{$v->phone}}</td>
                <td> <a href="{{url('enterprise/mod')}}?id={{$v->id}}"><i class="fa fa-edit"></i> <span class="nav-label">编辑</span> </a>
                <a href="javascript:void(0);" class="del" onclick="del()"><i class="fa fa-bank"></i> <span class="nav-label" alt="{{url('enterprise/del')}}?id={{$v->id}}">删除</span> </a></td>

            </tr> 
            @endforeach
            <tr>
                <td colspan="8" align="center">{!! $list->render() !!}</td>
            </tr>
      

        </tbody>
        </table>
    </div>
</div>
@endsection