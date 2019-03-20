@extends('comm')

@section('content') 
<div class="col-md-12 col-xs-12">

    <form class="form-horizontal form-label-left" method="post" enctype="multipart/form-data">

        <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12">标题：</label>
            <div class="col-md-5 col-sm-9 col-xs-12">
            <input type="text" class="form-control" placeholder="请输入标题" name="title">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12">阅读量：</label>
            <div class="col-md-5 col-sm-9 col-xs-12">
            <input type="text" class="form-control"  placeholder="请输入阅读量" name="look">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12">来源：</label>
            <div class="col-md-5 col-sm-9 col-xs-12">
            <input type="text" class="form-control"  placeholder="请输入来源" name="source">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12">关键词：</label>
            <div class="col-md-5 col-sm-9 col-xs-12">
            <input type="text" class="form-control"  placeholder="请输入关键词" name="keywords">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12">类型：
            </label>
            <div class="col-md-5 col-sm-9 col-xs-12">
            <select class="form-control" name="pid">
                @foreach($data as $v)
                    <option value="{{$v->pid}}">{{$v->name}}</option>
                @endforeach
            </select>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12">引言：
            </label>
            <div class="col-md-5 col-sm-9 col-xs-12">
              <textarea class="resizable_textarea form-control" placeholder="请输入引言" name="introduction"></textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12">内容：
            </label>
            <div class="col-md-9 col-sm-9 col-xs-12">
                <!-- 加载编辑器的容器 -->
                <script id="ue-container" name="content"  type="text/plain">

                </script>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12">新闻图片：
            </label>
            <div class="col-md-5 col-sm-9 col-xs-12">
              <input type="file"  multiple name="photo[]">
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
            <input  type="submit" class="btn btn-success"  name="sub" value="添加">
            <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
            </div>
        </div>

    </form>
</div>

@endsection
         