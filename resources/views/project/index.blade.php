@extends('comm')

@section('content') 	 

<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_title">
        <a href="{{url('project/uploads')}}"><button type="button" class="btn btn-primary">导入</button></a>
        <a href="{{url('project/export')}}"><button type="button" class="btn btn-primary">导出</button></a>
        <a href="{{url('project/unpack')}}"><button type="button" class="btn btn-primary">图片压缩包上传</button></a>
        <form style="display: inline;position:absolute;right:0px;">
        <input type="text" class="form-control" placeholder="请输入项目名称" name="sname" value="{{ Session::get('sname') }}" style="width: 200px; display: inline;">
        <input  type="submit" class="btn btn-primary"  name="sub" value="搜索" style="display: inline;">
        </form>
    </div>
    <div class="table-responsive">
        <table class="table table-striped jambo_table bulk_action">
        <thead>
            <tr class="headings">
                <th><input type="checkbox" id="check-all" class="flat"></th>
                <th class="column-title">项目名称 </th>
                <th class="column-title">合作金额 </th>
                <th class="column-title">所属行业 </th>
                <th class="column-title">区域 </th>
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
                <td>{{$v->coop_money }}</td>
                <td>{{$v->iname}}</td>
                <td>{{$v->area}}</td>
                <td>{{$v->contact}}</td>
                <td>{{$v->phone}}</td>
                <td> <a href="{{url('project/mod')}}?id={{$v->id}}"><i class="fa fa-edit"></i> <span class="nav-label">编辑</span> </a>
                <a href="javascript:void(0);" class="del" onclick="del()"><i class="fa fa-bank"></i> <span class="nav-label" alt="{{url('project/del')}}?id={{$v->id}}">删除</span> </a></td>

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