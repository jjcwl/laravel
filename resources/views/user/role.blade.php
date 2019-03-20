
@extends('comm')

@section('content') 
<div class="col-md-6 col-xs-12">

    <form class="form-horizontal form-label-left">

        @if($data)
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">用户角色：</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
                <select class="form-control" name="r_name">
                    @foreach($list as $v)
                        <option value="{{$v->r_id}}" @if ($data->rid==$v->r_id) selected @endif>{{$v->r_name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        @else
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">用户角色：</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
                <select class="form-control" name="r_name">
                    <option>--请选择--</option>
                    @foreach($list as $v)
                        <option value="{{$v->r_id}}">{{$v->r_name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                <input  type="submit" class="btn btn-success"  name="sub" value="提交">
                <input type="hidden" name="hid" value="{{$id}}">
            </div>
        </div>
        @endif
        

    </form>
</div>

@endsection