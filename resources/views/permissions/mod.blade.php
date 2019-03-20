
@extends('comm')

@section('content') 
<div class="col-md-6 col-xs-12">

    <form class="form-horizontal form-label-left">

        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">权限类型：</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
                <input type="text" class="form-control"  name="p_type" value="{{$list->p_type}}">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">权限URL：</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
                <input type="text" class="form-control" name="p_url" value="{{$list->p_url}}">
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                <input  type="submit" class="btn btn-success"  name="sub" value="修改">
                <input type="hidden" name="hid" value="{{$list->p_id}}">
            </div>
        </div>

    </form>
</div>

@endsection
