@extends('comm')

@section('content') 
<div class="col-md-6 col-xs-12">

    <form class="form-horizontal form-label-left" method="post" enctype="multipart/form-data">

        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">标题：</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
            <input type="text" class="form-control"  placeholder="请输入标题" name="title">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">类型：
            </label>
            <div class="col-md-9 col-sm-9 col-xs-12">
            <select class="form-control" name="pid">
                @foreach($data as $v)
                    <option value="{{$v->pid}}">{{$v->name}}</option>
                @endforeach
            </select>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">上传文件：</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
            <input type="file"  name="file">
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
            <input  type="submit" class="btn btn-success" name="sub" value="添加">
             <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
            </div>
        </div>

    </form>
</div>

@endsection
         