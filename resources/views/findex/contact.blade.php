<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>联系我们</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<link rel="stylesheet" href="{{ asset('index/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('index/css/myht.css') }}">
	<link rel="stylesheet" href="{{ asset('index/css/style.css') }}">
	<link type="text/css" href="http://888.gtimg.com/css/v1.0/qqcaipiao/cp_party_effect.css" rel="stylesheet"/>
	<script src="{{ asset('index/js/jquery.min.js') }}"></script>
	<script src="{{ asset('index/js/bootstrap.min.js') }}"></script>
	<style type="text/css">
		.leftImg{
			background-image: url("{{ asset('index/image/bannerLeft.svg') }}");
			background-repeat: no-repeat;
		}
		.rightImg{
			background-image: url("{{ asset('index/image/bannerRight.svg') }}");
			background-repeat: no-repeat;
		}
	</style>
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
<script>
	var interval;
	var pos = 0;
    var run = function(images) {
        interval = setInterval(function() {
            images[pos].style.display = 'none';
            pos = ++pos == images.length ? 0 : pos;
            images[pos].style.display = 'block';
        }, 3000);
    }
	window.onload = function() {
		var tab = document.getElementById('tab');
		var images = $(".banner-scroll");
		//var images = tab.getElementsByTagName('img');
		tab.onmouseover = function() {
		    clearInterval(interval);
		}
		tab.onmouseout = function() {
		    run(images);
		}
		run(images);
		$('.right').click(function(){
			images[pos].style.display = 'none';
            pos = ++pos == images.length ? 0 : pos;
            images[pos].style.display = 'block';
		});
		$('.left').click(function(){
			images[pos].style.display = 'none';
            pos = --pos == -1 ? (images.length-1) : pos;
            images[pos].style.display = 'block';
		})
    }
</script>
<!-- banner start -->
@include('findex/banner')

<!-- 联系我们 -->
<div class="container-fluid">
	<div class="contacttit">联系我们</div>
	<div class="col-md-10 col-md-offset-1 col-xs-12 contact ">
		<div class="col-md-3  contactborder">
			<div class="contactimg"><img src="{{asset('index/image/adress.png') }}"></div>
			<div class="contactimg">咨询地址</div>
			<div class="contactimg">中国（绵阳）科技城创新中心</div>
		</div>
		<div class="col-md-3  contactborder">
			<div class="contactimg"><img src="{{asset('index/image/iphone.png') }}"></div>
			<div class="contactimg">联系电话</div>
			<div class="contactimg">0816-2263966</div>
		</div>
		<div class="col-md-3  contactborder">
			<div class="contactimg"><img src="{{asset('index/image/yx.png') }}"></div>
			<div class="contactimg">邮箱</div>
			<div class="contactimg">ad@htjmrh.cn</div>
		</div>
	</div>
</div>
	


<!-- 尾部 -->
@include('findex/foot')
</body>
<script src="{{ asset('index/js/myht.js') }}"></script>
</html>