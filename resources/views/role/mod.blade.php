
@extends('comm')

@section('content') 
<div class="col-md-12 col-xs-12">

    <form class="form-horizontal form-label-left">

        <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12">角色名称：</label>
            <div class="col-md-5 col-sm-9 col-xs-12">
                <input type="text" class="form-control" placeholder="请输入用户名" name="r_name" value="{{$list->r_name}}">
            </div>
        </div>
        @if($data)
        <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12">添加角色权限：</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
                <div class="checkbox">
                    <div style="display: flex;flex-wrap:wrap;padding-left:0;">
                        @foreach($permissions as $v)
                        <div style="margin-right:20px;margin-bottom:20px;width:30%;">
                            @foreach($pid as $value)
                            <input type="checkbox" class="flat" name="p_type[]" value="{{$v->p_id}}" @if($value==$v->p_id) checked @endif  @endforeach> 
                                <div style="display: inline-block;margin-left:15px;">
                                    {{$v->p_type}}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        @endif
        <div class="form-group">
            <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                <input  type="submit" class="btn btn-success"  name="sub" value="修改">
                <input type="hidden" name="hid" value="{{$list->r_id}}">
            </div>
        </div>

    </form>
</div>

@endsection