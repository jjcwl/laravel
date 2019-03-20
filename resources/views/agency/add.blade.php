
@extends('comm')

@section('content') 
<div class="col-md-6 col-xs-12">

    <form class="form-horizontal form-label-left" method="post" 
    enctype="multipart/form-data">
 
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">url：</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
            <textarea class="resizable_textarea form-control" placeholder="请输入url" name="describe"></textarea>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">图片：
            </label>
            <div class="col-md-9 col-sm-9 col-xs-12">
            <input type="file" multiple="multiple" name="logo[]">
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
