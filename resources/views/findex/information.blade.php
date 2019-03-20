<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>资讯热点</title>
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
		//var images = tab.getElementsByTagName('img');
		var images = $(".banner-scroll");
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

<!-- banner start -->
@include('findex/banner')

<!--资讯热点-->
<div class="container-fluid">
	<div class="col-md-10 col-md-offset-1 col-xs-12 inves">
		<div class="container-fluid pageTitle">
			<div class="col-md-1 col-xs-1 invesesicon"><img src="{{ asset('index/image/icon_news.png') }}"></div>
			<div class="col-md-2 col-xs-3 investitle"><span>资讯热点</span></div>
			<div class="col-md-9 col-xs-8 invesline"></div>
			
		</div>
	</div>
	<div class="col-md-10 col-md-offset-1  col-xs-12 downloads">
		<div class="col-md-2 col-xs-3 downloadsTitle">
			@foreach($types as $val)
			<div class="downloadsTit">{{$val->name}}</div>
			@endforeach
		</div>
		<div class="do">
			<div class="col-md-10 col-xs-9 downloadCon">
				@foreach($information as $key=>$val)
				<div class="downloadNew">
					<div class="dow">
						<div class="dowinformationimg narrow"><img src="{{ asset('index/image/dian.png') }}">
						<a href="{{url('findex/info_details')}}?id={{$val->id}}">{{$val->title}}</a></div>
					</div>
					<div class="dowNew">
						@if($key<2)
						<img src="{{ asset('index/image/new.png') }}">{{date('Y-m-d',$val->create_time)}}
						@else
						{{date('Y-m-d',$val->create_time)}}
						@endif
					</div>
				</div>
				@endforeach
			</div>
			<div class="col-md-10 col-xs-9 downloadCon">
				@foreach($information2 as $key=>$val)
				<div class="downloadNew">
					<div class="dow">
						<div class="dowinformationimg narrow"><img src="{{ asset('index/image/dian.png') }}">
						<a href="{{url('findex/info_details')}}?id={{$val->id}}">{{$val->title}}</a></div>
					</div>
					<div class="dowNew">
						@if($key<2)
						<img src="{{ asset('index/image/new.png') }}">{{date('Y-m-d',$val->create_time)}}
						@else
						{{date('Y-m-d',$val->create_time)}}
						@endif
					</div>
				</div>
				@endforeach
			</div>
			<div class="col-md-10 col-xs-9 downloadCon">
				@foreach($information3 as $key=>$val)
				<div class="downloadNew">
					<div class="dow">
						<div class="dowinformationimg narrow"><img src="{{ asset('index/image/dian.png') }}">
						<a href="{{url('findex/info_details')}}?id={{$val->id}}">{{$val->title}}</a></div>
					</div>
					<div class="dowNew">
						@if($key<2)
						<img src="{{ asset('index/image/new.png') }}">{{date('Y-m-d',$val->create_time)}}
						@else
						{{date('Y-m-d',$val->create_time)}}
						@endif
					</div>
				</div>
				@endforeach
			</div>
			<div class="col-md-10 col-xs-9 downloadCon">
				@foreach($information4 as $key=>$val)
				<div class="downloadNew">
					<div class="dow">
						<div class="dowinformationimg narrow"><img src="{{ asset('index/image/dian.png') }}">
						<a href="{{url('findex/info_details')}}?id={{$val->id}}">{{$val->title}}</a></div>
					</div>
					<div class="dowNew">
						@if($key<2)
						<img src="{{ asset('index/image/new.png') }}">{{date('Y-m-d',$val->create_time)}}
						@else
						{{date('Y-m-d',$val->create_time)}}
						@endif
					</div>
				</div>
				@endforeach
			</div>
			
		</div>
	</div>
	<div class="col-md-10 col-md-offset-1 enterpage">
		{!! $information3->render() !!}
	</div>

<div>
	


<!-- 尾部 -->
@include('findex/foot')
</body>
<script src="{{ asset('index/js/myht.js') }}"></script>
</html>