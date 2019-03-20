
@extends('comm')

@section('content') 
<div class="col-md-6 col-xs-12">

    <form class="form-horizontal form-label-left">

        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">标题 ：</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
            <input type="text" class="form-control" placeholder="请输入标题" name="title">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">作者：</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
            <input type="text" class="form-control"  placeholder="请输入作者" name="author">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">描述：</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
            <input type="text" class="form-control"  placeholder="请输入描述" name="describe">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">内容：</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
            <!-- 加载编辑器的容器 -->
            <script id="ue-container" name="content"  type="text/plain">

            </script>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
            <input  type="submit" class="btn btn-success"  name="sub" value="添加">
            </div>
        </div>

    </form>
</div>

@endsection
