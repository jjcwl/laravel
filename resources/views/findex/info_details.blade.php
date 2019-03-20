<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>{{$info_details->title}}</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<link rel="stylesheet" href="{{ asset('index/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('index/css/myht.css') }}">
	<link rel="stylesheet" href="{{ asset('index/css/style.css') }}">
	<link type="text/css" href="http://888.gtimg.com/css/v1.0/qqcaipiao/cp_party_effect.css" rel="stylesheet"/>
	<script src="{{ asset('index/js/jquery.min.js') }}"></script>
	<script src="{{ asset('index/js/bootstrap.min.js') }}"></script>
</head>
<body>

<!-- 头部 -->
@include('findex/header')

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

<!-- 资讯详情 -->
<div class="container-fluid" style="display: inline-block;">
	<div class="col-md-10 col-md-offset-1 col-xs-12 redetit">
		<div class="col-md-2 col-xs-4 redesize"><a href="{{url('findex/index')}}">首页</a> /  <a href="{{url('findex/info_details')}}">资讯详情</a></div>
		<div class="col-md-10 col-xs-8 redeborder"></div>
	</div>
	<div class="col-md-10 col-md-offset-1 col-xs-12 indeleft">
		<div class="col-md-9 col-xs-12 indeleft">
        <div class="newswrap">
			<div class="indetit">{{$info_details->title}}</div>
			<div class="container-fluid indea">
            	<div class="col-md-5   indedate">关键词：{{$info_details->keywords}}</div>
                <div class="col-md-5 indedate">来源：{{$info_details->source}}</div>
				<div class="col-md-2  indedate narrow">阅读量：{{$info_details->look}}</div>
			</div>
            <div class="container-fluid indea">
            	<div class="col-md-6 indedate narrow">发布时间：{{date('Y-m-d',$info_details->create_time)}}</div>
			</div>
			<div class="col-md-11 col-xs-11 indeintroduction">引言：{{$info_details->introduction}}</div>
			<div class="col-md-11 col-xs-11 indecon">
				<?php echo html_entity_decode($info_details->content);?></div>
            </div><!--newswrap-->
		</div><!--inleft-->
		<div class="col-md-3  col-xs-12 inderight">
			<div class="rededescribe">资讯推荐</div>
			<div class="redeline"></div>
			<div class="demandinformation">
			@foreach($investment as $val)
			<div>
				<div class="requinformation narrow" ><a href="{{url('findex/info_details')}}?id={{$val->id}}">{{$val->title}}</a></div>
				<div class="demandDate" style="padding-left: 0">{{date('Y-m-d',$val->create_time)}}</div>
			</div>
			@endforeach	
			</div>
		</div>
	</div>

	
</div>
	


<!-- 尾部 -->
@include('findex/foot')
</body>
<script src="{{ asset('index/js/myht.js') }}"></script>
</html>