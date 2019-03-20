
@extends('comm')

@section('content') 
<div class="col-md-6 col-xs-12">

    <form class="form-horizontal form-label-left" method="post" 
    enctype="multipart/form-data">

        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">用户名 ：</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
            <input type="text" class="form-control" placeholder="请输入用户名" name="name">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">企业名称：</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
            <input type="text" class="form-control"  placeholder="请输入企业名称" name="enter_name">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">密码：</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
            <input type="password" class="form-control"  placeholder="请输入密码" name="password">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">手机号：</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
            <input type="text" class="form-control"  placeholder="请输入手机号" name="phone">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">所属行业：</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
                <select class="form-control" name="industry">
                    <option value="">--请选择--</option>
                    @foreach($list as $v)
                        <option value="{{$v->iid}}">{{$v->iname}}</option>
                    @endforeach
                </select>
            </script>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">细分领域：</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
            <input type="text" class="form-control"  placeholder="请输入细分领域" name="field">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">营业执照：</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
            <input type="file" multiple name="business[]">
            </script>
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
