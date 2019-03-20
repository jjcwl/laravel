<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>公告详情</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<link rel="stylesheet" href="{{ asset('index/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('index/css/myht.css') }}">
	<link rel="stylesheet" href="{{ asset('index/css/style.css') }}">
	<link type="text/css" href="http://888.gtimg.com/css/v1.0/qqcaipiao/cp_party_effect.css" rel="stylesheet"/>
	<script src="{{ asset('index/js/jquery.min.js') }}"></script>
	<script src="{{ asset('index/js/bootstrap.min.js') }}"></script>
</head>
<body>
<script type="text/javascript">
$(document).ready(function(){
	$('.marquee').kxbdMarquee({
			direction:'right',
			eventA:'mouseenter',
	});
});
</script> 
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

<!-- 通知公告 -->
<div class="container-fluid" >
	<div class="col-md-10 col-md-offset-1 col-xs-12 redetit">
		<div class="col-md-1 col-xs-4 redesize"><a href="{{url('findex/index')}}">首页</a></div>
		<div class="col-md-11 col-xs-8 redeborder"></div>
	</div>
	<div class="col-md-10 col-md-offset-1 col-xs-12 indeleft">
		<div class="col-md-12 col-xs-12 indeleft">
			<div class="indetit">{{$list->title}}</div>

			<div class="col-md-11 col-xs-11 indecon">
				{{$list->content}}
                	
            </div>

	

		</div>
	</div>

	
</div>
	


<!-- 尾部 -->
@include('findex/foot')
</body>
<script src="{{ asset('index/js/myht.js') }}"></script>
</html>