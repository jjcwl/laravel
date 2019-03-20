
@extends('comm')

@section('content') 
<div class="col-md-12 col-xs-12">

    <form class="form-horizontal form-label-left" method="post" 
    enctype="multipart/form-data">

        <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12">项目名称 ：</label>
            <div class="col-md-5 col-sm-9 col-xs-12">
            <input type="text" class="form-control" placeholder="请输入项目名称" name="name" value="{{$list->name}}">
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
            <input type="text" class="form-control"  placeholder="请输入合作金额" name="coop_money" value="{{$list->coop_money}}">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12">所属行业：</label>
            <div class="col-md-5 col-sm-9 col-xs-12">
                <select class="form-control" name="industry">
                    <option value="">--请选择--</option>
                    @foreach($industry as $v)
                        <option value="{{$v->iid}}" @if($v->iid==$list->industry) selected @endif>{{$v->iname}}</option>
                    @endforeach
                </select>
            </script>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12">项目图片：
            </label>
            <div class="col-md-5 col-sm-9 col-xs-12">
            @foreach($photos as $p)
                <img src="{{asset('uploads'.'/'.$p) }}" width="100px" height="70px">
            @endforeach
            <input type="file" multiple name="photo[]">
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
            <label class="control-label col-md-2 col-sm-3 col-xs-12">细分领域：</label>
            <div class="col-md-5 col-sm-9 col-xs-12">
            <input type="text" class="form-control"  placeholder="请输入细分领域" name="niche" value="{{$list->niche}}">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12">成熟度：</label>
            <div class="col-md-5 col-sm-9 col-xs-12">
                <select class="form-control" name="mature">
                    <option value="">--请选择--</option>
                    @foreach($mature as $v)
                        <option value="{{$v->mid}}" @if($v->mid==$list->mature) selected @endif>
                        {{$v->mname}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12">区域：</label>
            <div class="col-md-5 col-sm-9 col-xs-12">
            <input type="text" class="form-control"  placeholder="请输入区域" name="area" value="{{$list->area}}">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12">截止日期：</label>
            <div class="col-md-5 col-sm-9 col-xs-12">
            <input type="date" class="form-control"  placeholder="请输入截止日期" name="asdate" value="{{$list->asdate}}">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12">技术摘要：
            </label>
            <div class="col-md-5 col-sm-9 col-xs-12">
              <textarea class="resizable_textarea form-control" placeholder="请输入技术摘要" name="abstract">{{$list->abstract}}</textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12">技术简介：
            </label>
            <div class="col-md-9 col-sm-9 col-xs-12">
            <!-- 加载编辑器的容器 -->
            <script id="ue-container" name="tec_introduction"  type="text/plain">
                <?php
                     echo html_entity_decode($list->tec_introduction);
                ?>
            </script>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12">知识产权：</label>
            <div class="col-md-5 col-sm-9 col-xs-12">
           <textarea class="resizable_textarea form-control" placeholder="请输入知识产权" name="patent">{{$list->patent}}</textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12">获奖情况：</label>
            <div class="col-md-5 col-sm-9 col-xs-12">
            <input type="text" class="form-control"  placeholder="请输入获奖情况" name="winning" value="{{$list->winning}}">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12">技术优势：</label>
            <div class="col-md-5 col-sm-9 col-xs-12">
            <textarea class="resizable_textarea form-control" placeholder="请输入技术优势" name="advantage">{{$list->advantage}}</textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12">应用范围：</label>
            <div class="col-md-5 col-sm-9 col-xs-12">
            <input type="text" class="form-control"  placeholder="请输入应用范围" name="scope" value="{{$list->scope}}">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12">技术来源：</label>
            <div class="col-md-5 col-sm-9 col-xs-12">
            <select class="form-control" name="source">
                    <option value="">--请选择--</option>
                    @foreach($source as $v)
                        <option value="{{$v->sid}}" @if($v->sid==$list->source) selected @endif>
                        {{$v->sname}}</option>
                    @endforeach
            </select>
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
