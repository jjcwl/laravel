
@extends('comm')

@section('content') 
<div class="col-md-12 col-xs-12">

    <form class="form-horizontal form-label-left" method="post" 
    enctype="multipart/form-data">

        <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12">项目名称 ：</label>
            <div class="col-md-5 col-sm-9 col-xs-12">
            <input type="text" class="form-control" placeholder="请输入项目名称" name="name">
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
            <input type="text" class="form-control"  placeholder="请输入合作金额" name="coop_money">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12">所属行业：</label>
            <div class="col-md-5 col-sm-9 col-xs-12">
                <select class="form-control" name="industry">
                    <option value="">--请选择--</option>
                    @foreach($industry as $v)
                        <option value="{{$v->iid}}">{{$v->iname}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12">项目图片：</label>
            <div class="col-md-5 col-sm-9 col-xs-12">
            <input type="file" multiple name="photo[]">
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
            <label class="control-label col-md-2 col-sm-3 col-xs-12">细分领域：</label>
            <div class="col-md-5 col-sm-9 col-xs-12">
            <input type="text" class="form-control"  placeholder="请输入细分领域" name="niche">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12">成熟度：</label>
            <div class="col-md-5 col-sm-9 col-xs-12">
            <select class="form-control" name="mature">
                <option value="">--请选择--</option>
                @foreach($mature as $v)
                    <option value="{{$v->mid}}">{{$v->mname}}</option>
                @endforeach
            </select>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12">区域：</label>
            <div class="col-md-5 col-sm-9 col-xs-12">
            <input type="text" class="form-control"  placeholder="请输入区域" name="area">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12">截止日期：</label>
            <div class="col-md-5 col-sm-9 col-xs-12">
            <input type="date" class="form-control"  placeholder="请输入截止日期" name="asdate">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12">技术摘要：
            </label>
            <div class="col-md-5 col-sm-9 col-xs-12">
              <textarea class="resizable_textarea form-control" placeholder="请输入技术摘要" name="abstract"></textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12">技术简介：
            </label>
            <div class="col-md-9 col-sm-9 col-xs-12">
            <!-- 加载编辑器的容器 -->
            <script id="ue-container" name="tec_introduction"  type="text/plain">

            </script>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12">知识产权：
            </label>
            <div class="col-md-5 col-sm-9 col-xs-12">
              <textarea class="resizable_textarea form-control" placeholder="请输入知识产权" name="patent"></textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12">技术水平：
            </label>
            <div class="col-md-5 col-sm-9 col-xs-12">
              <textarea class="resizable_textarea form-control" placeholder="请输入技术水平" name="level"></textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12">获奖情况：</label>
            <div class="col-md-5 col-sm-9 col-xs-12">
            <input type="text" class="form-control"  placeholder="请输入获奖情况" name="winning">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12">技术优势：</label>
            <div class="col-md-5 col-sm-9 col-xs-12">
            <textarea class="resizable_textarea form-control" placeholder="请输入技术优势" name="advantage"></textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12">应用范围：</label>
            <div class="col-md-5 col-sm-9 col-xs-12">
            <input type="text" class="form-control"  placeholder="请输入应用范围" name="scope">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12">技术来源：</label>
            <div class="col-md-5 col-sm-9 col-xs-12">
            <select class="form-control" name="source">
                <option value="">--请选择--</option>
                @foreach($source as $v)
                    <option value="{{$v->sid}}">{{$v->sname}}</option>
                @endforeach
            </select>
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
<script type="text/javascript">
window.onload = function(){
    var edui1_iframeholder = document.getElementById('edui1_iframeholder');
    console.log(edui1_iframeholder)
    edui1_iframeholder.style.height = '350px'
}
</script>

@endsection
