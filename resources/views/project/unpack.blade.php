@extends('comm')

@section('content') 
<div class="col-md-6 col-xs-12">

    <form class="form-horizontal form-label-left" method="post" 
    enctype="multipart/form-data">
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">zip压缩包上传：</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
            <input type="file" name="file">
            </script>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
            <input  type="submit" class="btn btn-success"  name="sub" value="上传并解压">
            <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
            </div>
        </div>

    </form>
</div>

@endsection