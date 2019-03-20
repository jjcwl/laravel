
@extends('comm')

@section('content') 
<div class="col-md-6 col-xs-12">

    <form class="form-horizontal form-label-left">

        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">用户名：</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
                <input type="text" class="form-control" placeholder="请输入用户名" name="u_name" value="{{$list->u_name}}">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">密码：</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
                <input type="password" class="form-control" placeholder="请输入密码" name="u_pwd" value="{{$list->u_pwd}}">
            </div>
        </div>
        @if($data)
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">用户角色：</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
                <select class="form-control" name="r_name">
                    @foreach($role as $v)    
                    <option value="{{$v->r_id}}" @if($data->rid==$v->r_id) selected @endif>{{$v->r_name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        @endif
        <div class="form-group">
            <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                <input  type="submit" class="btn btn-success"  name="sub" value="修改">
                <input type="hidden" name="hid" value="{{$list->u_id}}">
            </div>
        </div>

    </form>
</div>

@endsection
