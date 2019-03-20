
@extends('comm')

@section('content') 
<div class="col-md-12 col-xs-12">

    <form class="form-horizontal form-label-left" method="post" 
    enctype="multipart/form-data">
        <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12">企业名称：</label>
            <div class="col-md-5 col-sm-9 col-xs-12">
            <input type="text" class="form-control"  placeholder="请输入企业名称" name="name">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12">企业简介：</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
            <!-- 加载编辑器的容器 -->
            <script id="ue-container" name="introduction"  type="text/plain">

            </script>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12">领域：</label>
            <div class="col-md-5 col-sm-9 col-xs-12">
            <input type="text" class="form-control"  placeholder="请输入细分领域" name="field">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12">Logo：
            </label>
            <div class="col-md-5 col-sm-9 col-xs-12">
            <input type="file" multiple="multiple" name="logo[]">
            </div>
        </div>    
        <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12">所属行业：</label>
            <div class="col-md-5 col-sm-9 col-xs-12">
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
            <label class="control-label col-md-2 col-sm-3 col-xs-12">联系人：</label>
            <div class="col-md-5 col-sm-9 col-xs-12">
            <input type="text" class="form-control"  placeholder="请输入联系人" name="contact">
            </script>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12">联系方式：</label>
            <div class="col-md-5 col-sm-9 col-xs-12">
            <input type="text" class="form-control"  placeholder="请输入联系方式" name="phone">
            </script>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12">区域：</label>
            <div class="col-md-5 col-sm-9 col-xs-12">
            <input type="text" class="form-control"  placeholder="请输入区域" name="area">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12">合作方式：</label>
            <div class="col-md-5 col-sm-9 col-xs-12">
            <select class="form-control" name="cooperation">
                    <option value="">--请选择--</option>
                    @foreach($cooperation as $v)
                        <option value="{{$v->cid}}">{{$v->cname}}</option>
                    @endforeach
                </select>
            </div>
        </div> 
        <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12">合作金额：</label>
            <div class="col-md-5 col-sm-9 col-xs-12">
            <input type="text" class="form-control"  placeholder="请输入合作金额" name="money">
            </div>
        </div>  
        <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12">企业项目：</label>
            <div class="col-md-5 col-sm-9 col-xs-12">
            <textarea class="resizable_textarea form-control" placeholder="请输入企业项目" name="en_project"></textarea>
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
