
@extends('comm')

@section('content') 
<div class="col-md-6 col-xs-12">

    <form class="form-horizontal form-label-left" method="post" 
    enctype="multipart/form-data">
        <div class="form-group">
            <label class="control-label col-md-7 col-sm-3 col-xs-12">
            <a href="{{asset('uploads'.'/'.$excel) }}">请先下载excel模版编辑后进行上传：</a></label>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">excel上传：</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
            <input type="file" multiple name="file">
            </script>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
            <input  type="submit" class="btn btn-success"  name="sub" value="导入">
            <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
            </div>
        </div>

    </form>
</div>

@endsection
