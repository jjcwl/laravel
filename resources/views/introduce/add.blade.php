
@extends('comm')

@section('content') 
<div class="col-md-12 col-xs-12">

    <form class="form-horizontal form-label-left" method="post" 
    enctype="multipart/form-data">
 
        <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12">内容介绍：</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
            <!-- 加载编辑器的容器 -->
            <script id="ue-container" name="content"  type="text/plain">

            </script>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12">描述：</label>
            <div class="col-md-5 col-sm-9 col-xs-12">
            <textarea class="resizable_textarea form-control" placeholder="请输入描述" name="describe"></textarea>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12">图片：
            </label>
            <div class="col-md-5 col-sm-9 col-xs-12">
            <input type="file" multiple="multiple" name="photo[]">
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
