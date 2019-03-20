
@extends('comm')

@section('content') 
<div class="col-md-12 col-xs-12">

    <form class="form-horizontal form-label-left" method="post" 
    enctype="multipart/form-data">

        <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12">企业名称：</label>
            <div class="col-md-5 col-sm-9 col-xs-12">
            <input type="text" class="form-control"  placeholder="请输入企业名称" name="name" value="{{$list->name}}">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12">企业简介：</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
            <!-- 加载编辑器的容器 -->
            <script id="ue-container" name="introduction"  type="text/plain">
                <?php
                     echo html_entity_decode($list->introduction);
                ?>
            </script>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12">领域：</label>
            <div class="col-md-5 col-sm-9 col-xs-12">
            <input type="text" class="form-control"  placeholder="请输入细分领域" name="field" value="{{$list->field}}">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12">所属行业：</label>
            <div class="col-md-5 col-sm-9 col-xs-12">
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
            <label class="control-label col-md-2 col-sm-3 col-xs-12">企业logo：
            </label>
            <div class="col-md-5 col-sm-9 col-xs-12">
            @foreach($photos as $p)
                <img src="{{asset('uploads'.'/'.$p) }}" width="100px" height="70px">
            @endforeach
            <input type="file" multiple name="logo[]">
            </script>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12">联系人：</label>
            <div class="col-md-5 col-sm-9 col-xs-12">
            <input type="text" class="form-control"  placeholder="请输入合作金额" name="contact" value="{{$list->contact}}">
            </script>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12">联系方式：</label>
            <div class="col-md-5 col-sm-9 col-xs-12">
            <input type="text" class="form-control"  placeholder="请输入合作金额" name="phone" value="{{$list->phone}}">
            </script>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12">区域：</label>
            <div class="col-md-5 col-sm-9 col-xs-12">
            <input type="text" class="form-control"  placeholder="请输入区域" name="area" value="{{$list->area}}">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12">合作方式：</label>
            <div class="col-md-5 col-sm-9 col-xs-12">
            <select class="form-control" name="cooperation">
                    <option value="">--请选择--</option>
                    @foreach($cooperation as $v)
                        <option value="{{$v->cid}}" @if($v->cid==$list->cooperation) selected @endif>{{$v->cname}}</option>
                    @endforeach
                </select>
            </div>
        </div> 
        <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12">合作金额：</label>
            <div class="col-md-5 col-sm-9 col-xs-12">
            <input type="text" class="form-control"  placeholder="请输入区域" name="money" value="{{$list->money}}">
            </div>
        </div>  
        <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12">企业项目：</label>
            <div class="col-md-5 col-sm-9 col-xs-12">
            <textarea class="resizable_textarea form-control" name="en_project">{{$list->en_project}}</textarea>
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
