<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>修改密码</title>
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
	<div class="col-md-2  abc">
		<a href="#" class="moblie">手机端</a>
	</div>
	<div class="col-md-2  zxc">
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
	<div class="logoimg col-md-3 col-md-offset-1" style="padding: 0;">
		<a href="{{url('/')}}"><img src="{{ asset('index/image/logo.png') }}"></a>
	</div>
	<div class="col-md-3 logintit">
		个人中心
	</div>
</div>
<div class="collborder"></div>
<div class="col-md-10 col-md-offset-1 updanav">
	<div class="col-md-2 updacoll"><a href="{{url('findex/collection')}}">个人中心</a> / 修改密码</div>
	<div class="col-md-10 updaborder"></div>
</div>
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

<script>
	var interval;
	var pos = 0;
    var run = function(images) {
        interval = setInterval(function() {
            images[pos].style.display = 'none';
            pos = ++pos == images.length ? 0 : pos;
            images[pos].style.display = 'inline';
        }, 3000);
    }
	window.onload = function() {
		var tab = document.getElementById('tab');
		var images = tab.getElementsByTagName('img');
		tab.onmouseover = function() {
		    clearInterval(interval);
		}
		tab.onmouseout = function() {
		    run(images);
		}
		run(images);
    }
</script>

<!-- 我的收藏 -->
<div class="container-fluid">

<div class="col-md-10 col-md-offset-1 downloads">
	
	<div class="col-md-12 col-xs-12">
		<form>
		<div class="col-md-4 col-xs-5 updanav">
			<div class="updaemail">请输入要修改的密码</div>
		</div>
		<div class="col-md-5  col-xs-6">
			<div class="update">修改密码</div>
			<input type="text" name="password" class="updatext">
			<input type="submit" name="sub" class="updatesub" value="确定">
		</div>
		</form>
	</div>			
</div>





<!-- 尾部 -->
@include('findex/foot')
</body>
<script src="{{ asset('index/js/myht.js') }}"></script>
</html>