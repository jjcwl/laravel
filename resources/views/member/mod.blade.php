
@extends('comm')

@section('content') 
<div class="col-md-6 col-xs-12">

    <form class="form-horizontal form-label-left" method="post" 
    enctype="multipart/form-data">

        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">用户名 ：</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
            <input type="text" class="form-control" placeholder="请输入用户名" name="name" value="{{$list->name}}">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">用户名称：</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
            <input type="text" class="form-control"  placeholder="请输入用户名称" name="username" value="{{$list->username}}">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">密码：</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
            <input type="password" class="form-control"  placeholder="请输入密码" name="password" value="{{$list->password}}">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">手机号：</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
            <input type="text" class="form-control"  placeholder="请输入手机号" name="phone" value="{{$list->phone}}">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">所属行业：</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
                <select class="form-control" name="industry">
                    <option value="">--请选择--</option>
                    @foreach($data as $v)
                        <option value="{{$v->iid}}" @if($v->iid==$list->industry) selected @endif>{{$v->iname}}</option>
                    @endforeach
                </select>
            </script>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">细分领域：</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
            <input type="text" class="form-control"  placeholder="请输入细分领域" name="field" value="{{$list->field}}">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">身份证正面：
            </label>
            <div class="col-md-9 col-sm-9 col-xs-12">
            @foreach($photo as $p)
                <img src="{{asset('uploads'.'/'.$p) }}" width="100px" height="70px">
            @endforeach
            <input type="file" multiple name="id_photo[]">
            </script>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">身份证反面：
            </label>
            <div class="col-md-9 col-sm-9 col-xs-12">
            @foreach($photos as $p)
                <img src="{{asset('uploads'.'/'.$p) }}" width="100px" height="70px">
            @endforeach
            <input type="file" multiple name="id_photos[]">
            </script>
            </div>
        </div>
      
        <div class="form-group">
            <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
            <input  type="submit" class="btn btn-success" name="sub" value="修改">
            <input type="hidden" name="hid" value="{{$list->id}}"> 
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            </div>
        </div>

    </form>
</div>

@endsection
