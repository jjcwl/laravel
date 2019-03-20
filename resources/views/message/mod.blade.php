
@extends('comm')

@section('content') 
<div class="col-md-12 col-xs-12">

    <form class="form-horizontal form-label-left" method="post" 
    enctype="multipart/form-data">
        
        <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12">联系人：</label>
            <div class="col-md-5 col-sm-9 col-xs-12">
            <input type="text" class="form-control"  name="contact" value="{{$list->contact}}">
            </script>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12">联系方式：</label>
            <div class="col-md-5 col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="phone"
             value="{{$list->phone}}">
            </script>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12">详细要求：</label>
            <div class="col-md-5 col-sm-9 col-xs-12">
            <textarea class="resizable_textarea form-control"  name="requirements">{{$list->requirements}}</textarea>
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
