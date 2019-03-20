<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
	<title>会员注册</title>
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
		<div style="padding-right: 15px; text-align: center;">欢迎你,{{Session::get('name')}}</div>
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
		会员注册
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
<div class="container-fluid ban">
	<div class="container-fluid banner">
		<img src="{{ asset('index/image/20181102083456676.jpg') }}" alt="">
	</div>
	<div class=" col-md-5 col-xs-5 regiborder">
	
		<div class="mTitle">绵阳军民融合用户注册</div>
		<div class="col-md-3 col-xs-3">
			<div class="regitype">会员类别</div>
		</div>
		<div class="col-md-8 col-xs-8">
			<div class="regitab">
				<div class="regitabs">个人</div>
				<div class="regitabs">企业</div>
			</div>
		</div>
		<div>
		<div class="registab">
		<form name="form1" method="post" 
    enctype="multipart/form-data">
			<div class="col-md-3 col-xs-3">
				<div class="regitexts">用户名</div>
				<div class="reginames">用户姓名</div>
				<div class="reginames">密码</div>
				<div class="reginames">确认密码</div>
				<div class="reginames">手机号</div>
				<div class="regisels">所属行业</div>
				<div class="reginames">细分领域</div>
				<div class="regicards">身份证照片</div>
			</div>
			<div class="col-md-8 col-xs-8 ">
				<input type="text" name="name" class="regitext" placeholder=" 请输入邮箱(必填)" id="names"
				>
	
				<input type="text" name="username" class="reginame" placeholder=" 请输入真实姓名(必填)" id="username">
				<input type="password" name="password" class="reginame" placeholder=" 请输入密码(必填)" id="password"> 
				<input type="password" class="reginame" id="qrpassword" placeholder=" 请再次输入密码(必填)">
				<input type="text" name="phone" class="reginame" placeholder=" 请输入手机号(必填)" id="phone">  
				<select class="regisel" name="industry">
					@foreach($industry as $val)
					<option value="{{$val->iid}}">{{$val->iname}}</option>
					@endforeach
				</select> 
				<input type="text" name="field" class="reginame" placeholder=" 请输入细分领域" id="fields">
				<div class="regicard">
					<input type="file" name="id_photo[]" multiple >
		
					<input type="file" name="id_photos[]" multiple>
				</div>
				<div class="regiche">
				<input type="checkbox" name="" id="ims">我已同意并接受<span>注册许可协议</span></div>
				<div class="loginsubs"><input type="submit" name="sub" value="注册" class="loginsub" onclick="return myCheck()">
				<input type="hidden" name="_token" value="{{ csrf_token() }}"> 
				</div>
			</div>
		</form>
		</div>
		<div class="registab">
		<form name="form1" method="post" 
    enctype="multipart/form-data">
			<div class="col-md-3 col-xs-3">
				<div class="regitexts">用户名</div>
				<div class="reginames">企业名称</div>
				<div class="reginames">密码</div>
				<div class="reginames">确认密码</div>
				<div class="reginames">手机号</div>
				<div class="regisels">所属行业</div>
				<div class="reginames">细分领域</div>
				<div class="regicards">营业执照</div>
			</div>
			<div class="col-md-8 col-xs-8">
				<input type="text" name="name" class="regitext required" placeholder=" 请输入邮箱(必填)" id="name" value="">
				<input type="text" name="enter_name" class="reginame" placeholder=" 请输入企业名称(必填)" id="entername">		
				<input type="password" name="password" class="reginame" placeholder=" 请输入密码(必填)" id="passwords">
				<input type="password" name="" id="qrpasswords" class="reginame" placeholder=" 请再次输入密码(必填)">
				<input type="text" name="phone" class="reginame" placeholder=" 请输入手机号(必填)"
				id="phones">
				<select class="regisel" name="industry" id="industry">
					@foreach($industry as $val)
					<option value="{{$val->iid}}">{{$val->iname}}</option>
					@endforeach
				</select>
				<input type="text" name="field" class="reginame" placeholder=" 请输入细分领域" id="field">
				<div class="regilicense">
					<input type="file" name="business[]" id="file" multiple >
				</div>
				<div class="regiche">
				<input type="checkbox" name="" id="im">我已同意并接受<span>注册许可协议</span></div>
				<div class="loginsubs"><input  type="submit" name="subs" id="sub" value="注册" class="loginsub" onclick="return myChecks()">
				<input type="hidden" name="_token" value="{{ csrf_token() }}"> 
				</div>
			</div>
		</form>
		</div>
		</div>
		
	</div>
</div>
</body>
<script src="{{ asset('index/js/myht.js') }}"></script>
<script type="text/javascript">
	var namess=document.getElementById('name');
   	var names=document.getElementById('names');
   	var entername=document.getElementById("entername");
   	var password=document.getElementById("password");
   	var qrpassword=document.getElementById("qrpassword");
   	var qrpasswords=document.getElementById("qrpasswords");
   	var passwords=document.getElementById("passwords");
   	var field=document.getElementById("field");
   	var fields=document.getElementById("fields");
   	var username=document.getElementById("username");
   	var file=document.getElementById("file");
   	var myreg = /^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/;
    function myCheck(){
    	var phone = document.getElementById('phone').value;
	   	if(!myreg.test(names.value))
	   	{
	   		alert('请输入正确的邮箱格式');
	   		return false;
	   	}
	   	if(username.value=='')
	   	{
	   		alert('用户姓名不能为空');
	   		return false;
	   	}
	   	if(password.value=='')
	   	{
	   		alert('密码不能为空');
	   		return false;
	   	}
	   	if(password.value!=qrpassword.value)
	   	{
	   		alert('两次密码输入不一致');
	   		return false;
	   	}	
	    if(!(/^1[34578]\d{9}$/.test(phone))){ 
	        alert("手机号码有误，请重填");  
	        return false; 
	    }
	   	if($('#ims').prop('checked') == false){
	   		alert('请同意并接受许可协议!');
	   		return false;
	   	}
	   	return true;

	}
	function myChecks(){
   		var phones = document.getElementById('phones').value;
	   	if(!myreg.test(namess.value))
	   	{
	   		alert('请输入正确的邮箱格式');
	   		return false;
	   	}
	   	if(entername.value=='')
	   	{
	   		alert('企业名称不能为空');
	   		return false;
	   	}
	   	if(passwords.value=='')
	   	{
	   		alert('密码不能为空');
	   		return false;
	   	}
	   	if(passwords.value!=qrpasswords.value)
	   	{
	   		alert('两次密码输入不一致');
	   		return false;
	   	}

	    if(!(/^1[34578]\d{9}$/.test(phones))){ 
	        alert("手机号码有误，请重填");  
	        return false; 
	    }
	   	if($('#im').prop('checked') == false){
	   		alert('请同意并接受许可协议!');
	   		return false;
	   	}
	   	return true;
	}

</script> 
</html>