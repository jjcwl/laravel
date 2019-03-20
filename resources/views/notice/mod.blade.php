@extends('comm')

@section('content') 
<div class="col-md-6 col-xs-12">

    <form class="form-horizontal form-label-left">

        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">通知标题：</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
            <input type="text" class="form-control" placeholder="请输入通知标题" name="title" value="{{$list->title}}">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">通知内容：</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
            <input type="text" class="form-control"  placeholder="请输入通知内容" name="content" value="{{$list->content}}">
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
            <input  type="submit" class="btn btn-success" name="sub" value="修改">
            <input type="hidden" name="hid" value="{{$list->id}}">
            </div>
        </div>

    </form>
</div>

@endsection
         