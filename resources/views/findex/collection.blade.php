<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>个人中心</title>
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
		<div style="padding-right: 15px; ">欢迎你,{{Session::get('name')}}</div>
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

<!-- 我的收藏 -->
<div class="container-fluid">

<div class="col-md-10 col-md-offset-1 col-xs-12 downloads">
	<div class="col-md-2 downloadsTitle">
		<div class="downloadsTit">我的收藏</div>
		<div class="downloadsTit">我的赞</div>
		<div class="downloadsTit">用户信息</div>
	</div> 
	<div class="col-md-10 col-xs-12">
	<div>
		<div class="colltab">
			@foreach($projectcoll as $val)
			<a href="{{url('findex/pro_details')}}?id={{$val['id']}}">
			@if(in_array($name,$val['coll']))
			<div class="collborders">
				
				<div class="collname">{{$val['name']}}</div>
				<div class="collcon narrow">{{$val['abstract']}}</div>
				
			</div>
			@endif
			</a>
			@endforeach

			@foreach($requirementcoll as $val)
			<a href="{{url('findex/requ_details')}}?id={{$val['id']}}">
			@if(in_array($name,$val['coll']))
			<div class="collborders">
				
				<div class="collname">{{$val['name']}}</div>
				<div class="collcon narrow">{{$val['describes']}}</div>
				
			</div>
			@endif
			</a>
			@endforeach

			@foreach($enterprisecoll as $val)
			<a href="{{url('findex/ente_details')}}?id={{$val['id']}}">
			@if(in_array($name,$val['coll']))
			<div class="collborders">
				
				<div class="collname">{{$val['name']}}</div>
				<div class="collcon narrow"><?php
                     echo html_entity_decode($val['introduction']);?></div>
				
			</div>
			@endif
			</a>
			@endforeach
		</div>
		<div class="colltab">
			@foreach($projectpra as $val)
			<a href="{{url('findex/pro_details')}}?id={{$val['id']}}">
			@if(in_array($name,$val['pra']))
			<div class="collborders">
				
				<div class="collname">{{$val['name']}}</div>
				<div class="collcon narrow">{{$val['abstract']}}</div>
				
			</div>
			@endif
			</a>
			@endforeach

			@foreach($requirementpra as $val)
			<a href="{{url('findex/requ_details')}}?id={{$val['id']}}">
			@if(in_array($name,$val['pra']))
			<div class="collborders">
				
				<div class="collname">{{$val['name']}}</div>
				<div class="collcon narrow">{{$val['describes']}}</div>
				
			</div>
			@endif
			</a>
			@endforeach

			@foreach($enterprisepra as $val)
			<a href="{{url('findex/ente_details')}}?id={{$val['id']}}">
			@if(in_array($name,$val['pra']))
			<div class="collborders">
				
				<div class="collname">{{$val['name']}}</div>
				<div class="collcon narrow"><?php
                     echo html_entity_decode($val['introduction']);?></div>
				
			</div>
			@endif
			</a>
			@endforeach
			
		</div>
		@if($list)
		<div class="colltab ">
			<div class="col-md-5 col-xs-6 colltypes">
				<div class="colltype">会员类别：</div>
				<div class="colltype">用户名：</div>
				<div class="colltype">用户姓名：</div>
				<div class="colltype">密码：</div>
				<div class="colltype">所属行业：</div>
				<div class="colltype">细分领域：</div>
				<div class="colltype"><a href="{{url('findex/cancellation')}}">用户注销</a></div>
			</div>
			<div class="col-md-5 col-xs-6 collusers">
				<div class="colluser">个人</div>
				<div class="colluser">{{$list->name}}</div>
				<div class="colluser">{{$list->username}}</div>
				<div class="colluser">······ <a href="{{url('findex/update')}}?id={{$list->id}}">修改</a></div>
				<div class="colluser">{{$list->iname}}</div>
				<div class="colluser">{{$list->field}}</div>
			</div>
		</div>
		@else
		<div class="colltab">
			<div class="col-md-5 col-xs-6 colltypes">
				<div class="colltype">会员类别：</div>
				<div class="colltype">用户名：</div>
				<div class="colltype">企业名称：</div>
				<div class="colltype">密码：</div>
				<div class="colltype">所属行业：</div>
				<div class="colltype">细分领域：</div>
				<div class="colltype">企业需求：</div>
				<div class="colltype">企业信息：</div>
				<div class="colltype"><a href="{{url('findex/cancellation')}}">用户注销</a></div>
				
			</div>
			<div class="col-md-5 col-xs-6 collusers">
				<div class="colluser">企业</div>
				<div class="colluser">{{$data->name}}</div>
				<div class="colluser">{{$data->enter_name}}</div>
				<div class="colluser">······ <a href="{{url('findex/update')}}?id={{$data->id}}">修改</a></div>
				<div class="colluser">{{$data->iname}}</div>
				<div class="colluser">{{$data->field}}</div>
				<div class="colluser"><a href="{{url('findex/ente_requirement')}}">需求添加</a></div>
				<div class="colluser"><a href="{{url('findex/data')}}">公司资料添加
				</a></div>
			</div>
		</div>
		@endif
	</div>
	</div>			
</div>





<!-- 尾部 -->
@include('findex/foot')
</body>
<script src="{{ asset('index/js/myht.js') }}"></script>
</html>