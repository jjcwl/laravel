
@extends('comm')

@section('content') 
<div class="col-md-6 col-xs-12">

    <form class="form-horizontal form-label-left" method="post" 
    enctype="multipart/form-data">

        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">描述：</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
            <textarea class="resizable_textarea form-control" placeholder="请输入企业简介" name="describe">{{$list->describe}}</textarea>
            </div>
        </div>
       
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">图片：
            </label>
            <div class="col-md-9 col-sm-9 col-xs-12">
            @foreach($photos as $p)
                <img src="{{asset('uploads'.'/'.$p) }}" width="100px" height="70px">
            @endforeach
            <input type="file" multiple name="banners[]">
            </script>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">url链接：</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
            <input type="text" class="form-control" placeholder="请输入url链接" name="url" value="{{$list->url}}">
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
            <input  type="submit" class="btn btn-success"  name="sub" value="修改">
            <input type="hidden" name="hid" value="{{$list->id}}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
            </div>
        </div>

    </form>
</div>

@endsection
