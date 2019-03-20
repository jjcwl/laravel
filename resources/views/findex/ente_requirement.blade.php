<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>企业需求添加</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<link rel="stylesheet" href="{{ asset('index/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('index/css/myht.css') }}">
	<link rel="stylesheet" href="{{ asset('index/css/style.css') }}">

	<link type="text/css" href="http://888.gtimg.com/css/v1.0/qqcaipiao/cp_party_effect.css" rel="stylesheet"/>
	<script src="{{ asset('index/js/jquery.min.js') }}"></script>
	<script src="{{ asset('index/js/bootstrap.min.js') }}"></script>
	
</head>
<body>
<style type="text/css">
       input{outline:none;}
</style>
<script type="text/javascript">
$(document).ready(function(){
	$('.marquee').kxbdMarquee({
			direction:'right',
			eventA:'mouseenter',
	});
});
</script> 
<!-- 头部 -->
<div class="top container-fluid">
	<div class="col-md-6 col-md-offset-1 ">
		<span class="title">欢迎来到绵阳航天军民融合服务平台</span>
		<span class="service">客服电话：010-68376645</span>
	</div>
	<div class="col-md-1  abc">
		<a href="#" class="moblie">手机端</a>
	</div>
	<div class="col-md-3  zxc">
		@if(Session::get('id'))
		<div style="padding-right: 15px;">欢迎你,{{Session::get('name')}}</div>
		<a href="{{url('findex/collection')}}" class="login">个人中心</a>
		@else
		<a href="{{url('findex/login')}}" class="login">登录</a>
		<a href="{{url('findex/registration')}}" class="registered">注册</a>
		@endif
	</div>
</div>
<!-- logo -->
<div class="logo container-fluid">
	<div class="logoimg col-md-3 col-md-offset-1">
		<a href="{{url('/')}}"><img src="{{ asset('index/image/logo.png') }}"></a>
	</div>
	<div class="col-md-3 logintit">
		个人中心
	</div>
</div>
<div class="collborder"></div>
<!-- 手机端 -->
@include('findex/mobile')
<script type="text/javascript">
	$('.mNavIcon').click(function(){
		$('.mBg').show();
		$('.mNav').show();
	})
	$('.mMeIcon').click(function(){
		$('.mBg').show();
		$('.mMe').show();
	})
	$('.mNavClose').click(function(){
		$('.mBg').hide();
		$('.mNav').hide();
	})
	$('.mMeClose').click(function(){
		$('.mMe').hide();
		$('.mBg').hide();
	})
	$('.mBg').click(function(){
		$(this).hide();
		$('.mNav').hide();
		$('.mMe').hide();
	})
</script>




<div class="col-md-12 col-xs-12" style="padding-top: 20px;" >

    <form class="form-horizontal form-label-left" method="post" 
    enctype="multipart/form-data">
        
        
        <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12 col-md-offset-3">合作方式：</label>
            <div class="col-md-3 col-sm-9 col-xs-12">
             <select class="form-control" name="cooperation">
                    <option value="">--请选择--</option>
                    @foreach($cooperation as $v)
                        <option value="{{$v->cid}}">{{$v->cname}}</option>
                    @endforeach
                </select>
             </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12 col-md-offset-3">所属行业：</label>
            <div class="col-md-3 col-sm-9 col-xs-12">
                <select class="form-control" name="industry">
                    <option value="">--请选择--</option>
                    @foreach($list as $v)
                        <option value="{{$v->iid}}">{{$v->iname}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12 col-md-offset-3">拟投资金额：</label>
            <div class="col-md-3 col-sm-9 col-xs-12">
            <input type="text" class="form-control"  placeholder="请输入拟投资金额" name="money">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12 col-md-offset-3">联系人：</label>
            <div class="col-md-3 col-sm-9 col-xs-12">
            <input type="text" class="form-control"  placeholder="请输入联系人" name="contact">
            </script>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12 col-md-offset-3">联系方式：</label>
            <div class="col-md-3 col-sm-9 col-xs-12">
            <input type="text" class="form-control"  placeholder="请输入联系方式" name="phone">
            </script>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12 col-md-offset-3">细分领域：</label>
            <div class="col-md-3 col-sm-9 col-xs-12">
            <input type="text" class="form-control"  placeholder="请输入细分领域" name="fields">
            </div>
        </div>  
        <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12 col-md-offset-3">名称：</label>
            <div class="col-md-3 col-sm-9 col-xs-12">
            <input type="text" class="form-control"  placeholder="请输入细分领域" name="name">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12 col-md-offset-3">区域：</label>
            <div class="col-md-3 col-sm-9 col-xs-12">
            <input type="text" class="form-control"  placeholder="请输入区域" name="area">
            </div>
        </div>  
        <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12 col-md-offset-3">截止日期：</label>
            <div class="col-md-3 col-sm-9 col-xs-12">
            <input type="date" class="form-control"  placeholder="请输入细分领域" name="asdate">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12 col-md-offset-3">预期目标：</label>
            <div class="col-md-3 col-sm-9 col-xs-12">
            <textarea class="resizable_textarea form-control" placeholder="请输入预期目标" name="target"></textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12 col-md-offset-3">需求描述：</label>
            <div class="col-md-5 col-sm-9 col-xs-12">
            <!-- 加载编辑器的容器 -->
            <script id="ue-container" name="describes"  type="text/plain">

            </script>
            </div>
        </div>       
        <div class="form-group">
            <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-6 ">
            <input  type="submit" class="btn btn-success"  name="sub" value="添加">
            <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
            </div>
        </div>

    </form>
</div>





<!-- 尾部 -->
@include('findex/foot')
</body>
<script src="{{ asset('index/js/myht.js') }}"></script>
<!-- Custom Theme Scripts -->
    <script src="{{ asset('admin/build/js/custom.min.js') }}"></script>
    <!-- ueditor-mz 配置文件 -->
    <script type="text/javascript" src="{{asset('admin/ueditor-mz/ueditor.config.js')}}"></script>
    <!-- 编辑器源码文件 -->
    <script type="text/javascript" src="{{asset('admin/ueditor-mz/ueditor.all.js')}}"></script>
    <!-- 实例化编辑器 -->
    <script type="text/javascript">
    var ue = UE.getEditor('ue-container');
    ue.ready(function(){
        ue.execCommand('serverparam', '_token', '{{ csrf_token() }}');
    });
    </script>
</html>