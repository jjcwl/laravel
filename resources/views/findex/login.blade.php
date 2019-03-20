<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>会员登录</title>
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
		<span class="service">客服电话：0816-2263966</span>
	</div>
	<div class="col-md-2  abc">
		<a href="#" class="moblie">手机端</a>
	</div>
	<div class="col-md-2  zxc">
		<a href="{{url('findex/login')}}" class="login">登录</a>
		<a href="{{url('findex/registration')}}" class="registered">注册</a>
	</div>
</div>
<!-- logo -->
<div class="logo container-fluid">
	<div class="logoimg col-md-3 col-md-offset-1 " style="padding: 0;">
		<a href="{{url('/')}}"><img src="{{ asset('index/image/logo.png') }}"></a>
	</div>
	<div class="col-md-3 logintit">
		会员登录
	</div>
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

<!-- banner start -->
<div class=" container-fluid ban">
	<div class="container-fluid loginban">
		<img src="{{ asset('index/image/20181102083456676.jpg') }}" alt="" style="height: 100%">
	</div>
	<div class="col-md-5 col-xs-8 loginborder">
	<div class="mTitle">绵阳军民融合用户登录</div>
		<div class="col-md-3 col-xs-3">
			<div class="logintexts">用户名</div>
			<div class="loginpwds">密码</div>
		</div>
		<div class="col-md-8 col-xs-9">
			<form>
			<input type="text" name="name" class="logintext" placeholder=" 请输入用户名">		
			<input type="password" name="password" class="loginpwd" placeholder=" 请输入密码">
			<div class="loginsubs"><input type="submit" name="sub" value="登录" class="loginsub"></div>

			</form>
		</div>
		
	</div>
</div>

	


<!-- 尾部 -->
@include('findex/foot')
</body>
<script src="{{ asset('index/js/myht.js') }}"></script>
</html>