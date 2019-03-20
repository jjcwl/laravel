@extends('comm')

@section('content') 	 

<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="table-responsive">
        <table class="table table-striped jambo_table bulk_action">
        <thead>
            <tr class="headings">
                <th><input type="checkbox" id="check-all" class="flat"></th>
                <th class="column-title">名称 </th>
                <th class="column-title">操作 </th>
                <th class="bulk-actions" colspan="3">
                <a class="antoo" style="color:#fff; font-weight:500;">批量操作 ( <span class="action-cnt"> </span>)<i class="fa fa-chevron-down"></i></a>
                </th>
            </tr>
        </thead>

        <tbody>

           @foreach($list as $v)
            <tr class="even pointer">

                <td class="a-center "><input type="checkbox" class="flat" name="table_records"></td>
                <td>{{$v->name}}</td>
                <td> <a href="{{url('hot/mod')}}?id={{$v->pid}}"><i class="fa fa-edit"></i> <span class="nav-label">编辑</span> </a>
                <a href="{{url('hot/del')}}?id={{$v->pid}}"><i class="fa fa-bank"></i> <span class="nav-label">删除</span> </a></td>

            </tr> 
            @endforeach

      

        </tbody>
        </table>
    </div>
</div>
@endsection