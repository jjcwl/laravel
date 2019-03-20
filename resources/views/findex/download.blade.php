<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>资料下载</title>
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

<!--资料下载-->
<div class="container-fluid">
	<div class="col-md-10 col-md-offset-1 col-xs-12 inves">
		<div class="container-fluid pageTitle">
			<div class="col-md-1 col-xs-1 invesesicon"><img src="{{ asset('index/image/icon_file.png') }}"></div>
			<div class="col-md-2 col-xs-3 investitle"><span>资料下载</span></div>
			<div class="col-md-9 col-xs-8 invesline"></div>
			
		</div>
	</div>
	<div class="col-md-10 col-md-offset-1 col-xs-12 downform" >
		<div class="col-md-9 col-xs-7"></div>
		<form class="col-md-3  col-xs-5" style="padding-right: 0">
		<div class="col-md-8 col-xs-8 downtext">
			<input type="text"  name="title" class="downloadtext">
		</div>
		<div class="col-md-4 col-xs-4 downsubmit">
			<input type="submit" name="sub" class="downsub" value="检索">
		</div>
		</form>
	</div>
	<div class="col-md-10 col-md-offset-1  col-xs-12 downloads">
		<div class="col-md-2 col-xs-3 downloadsTitle">
			@foreach($types as $val)
			<div class="downloadsTit">{{$val->name}}</div>
			@endforeach
		</div>
		<div class="do">
			<div class="col-md-10 col-xs-9 downloadCon">
				@foreach($download as $key=>$val)
				<div class="downloadNew">
					<div class="dow">
						<div class="dowinformationimg narrow"><img src="{{ asset('index/image/dian.png') }}">
						<a href="{{asset('uploads'.'/'.$val->file) }}">{{$val->title}}</a></div>
						<div class="dowinformation"></div>
						<div class="dowImg"><a href="{{asset('uploads'.'/'.$val->file) }}"><img src="{{ asset('index/image/icon_download.png') }}" class="img1"></a><img src="{{ asset('index/image/icon_download1.png') }}" class="img2"></div>
					</div>
					<div class="dowNew">
						@if($key<2)
						<img src="{{ asset('index/image/new.png') }}">{{date('Y-m-d',$val->create_time)}}
						<span>点击下载</span>
						@else
						{{date('Y-m-d',$val->create_time)}}
						<span>点击下载</span>
						@endif
					</div>
				</div>
				@endforeach
			</div>
			<div class="col-md-10 col-xs-9 downloadCon">
				@foreach($download2 as $key=>$val)
				<div class="downloadNew">
					<div class="dow">
						<div class="dowinformationimg narrow"><img src="{{ asset('index/image/dian.png') }}">
						<a href="{{asset('uploads'.'/'.$val->file) }}">{{$val->title}}</a></div>
						<div class="dowinformation"></div>
						<div class="dowImg"><a href="{{asset('uploads'.'/'.$val->file) }}"><img src="{{ asset('index/image/icon_download.png') }}" class="img1">
						</a><img src="{{ asset('index/image/icon_download1.png') }}" class="img2"></div>
					</div>
					<div class="dowNew">
						@if($key<2)
						<img src="{{ asset('index/image/new.png') }}">{{date('Y-m-d',$val->create_time)}}
						<span>点击下载</span>
						@else
						{{date('Y-m-d',$val->create_time)}}
						<span>点击下载</span>
						@endif
					</div>
				</div>
				@endforeach
			</div>
			<div class="col-md-10 col-xs-9 downloadCon">
				@foreach($download3 as $key=>$val)
				<div class="downloadNew">
					<div class="dow">
						<div class="dowinformationimg narrow"><img src="{{ asset('index/image/dian.png') }}">
						<a href="{{asset('uploads'.'/'.$val->file) }}">{{$val->title}}</a></div>
						<div class="dowinformation"></div>
						<div class="dowImg"><a href="{{asset('uploads'.'/'.$val->file) }}"><img src="{{ asset('index/image/icon_download.png') }}" class="img1"></a><img src="{{ asset('index/image/icon_download1.png') }}" class="img2"></div>
					</div>
					<div class="dowNew">
						@if($key<2)
						<img src="{{ asset('index/image/new.png') }}">{{date('Y-m-d',$val->create_time)}}
						<span>点击下载</span>
						@else
						{{date('Y-m-d',$val->create_time)}}
						<span>点击下载</span>
						@endif
					</div>
				</div>
				@endforeach
			</div>
			<div class="col-md-10 col-xs-9 downloadCon">
				@foreach($download4 as $key=>$val)
				<div class="downloadNew">
					<div class="dow">
						<div class="dowinformationimg narrow"><img src="{{ asset('index/image/dian.png') }}">
						<a href="{{asset('uploads'.'/'.$val->file) }}">{{$val->title}}</a></div>
						<div class="dowinformation"></div>
						<div class="dowImg"><a href="{{asset('uploads'.'/'.$val->file) }}"><img src="{{ asset('index/image/icon_download.png') }}" class="img1"></a><img src="{{ asset('index/image/icon_download1.png') }}" class="img2"></div>
					</div>
					<div class="dowNew">
						@if($key<2)
						<img src="{{ asset('index/image/new.png') }}">{{date('Y-m-d',$val->create_time)}}
						<span>点击下载</span>
						@else
						{{date('Y-m-d',$val->create_time)}}
						<span>点击下载</span>
						@endif
					</div>
				</div>
				@endforeach
			</div>
			<div class="col-md-10 col-xs-9 downloadCon">
				@foreach($download5 as $key=>$val)
				<div class="downloadNew">
					<div class="dow">
						<div class="dowinformationimg narrow"><img src="{{ asset('index/image/dian.png') }}">
						<a href="{{asset('uploads'.'/'.$val->file) }}">{{$val->title}}</a></div>
						<div class="dowinformation"></div>
						<div class="dowImg"><a href="{{asset('uploads'.'/'.$val->file) }}"><img src="{{ asset('index/image/icon_download.png') }}" class="img1"></a><img src="{{ asset('index/image/icon_download1.png') }}" class="img2"></div>
					</div>
					<div class="dowNew">
						@if($key<2)
						<img src="{{ asset('index/image/new.png') }}">{{date('Y-m-d',$val->create_time)}}
						<span>点击下载</span>
						@else
						{{date('Y-m-d',$val->create_time)}}
						<span>点击下载</span>
						@endif
					</div>
				</div>
				@endforeach
			</div>
			<div class="col-md-10 col-xs-9 downloadCon">
				@foreach($download6 as $key=>$val)
				<div class="downloadNew">
					<div class="dow">
						<div class="dowinformationimg narrow"><img src="{{ asset('index/image/dian.png') }}">
						<a href="{{asset('uploads'.'/'.$val->file) }}">{{$val->title}}</a></div>
						<div class="dowinformation"></div>
						<div class="dowImg"><a href="{{asset('uploads'.'/'.$val->file) }}"><img src="{{ asset('index/image/icon_download.png') }}" class="img1"></a><img src="{{ asset('index/image/icon_download1.png') }}" class="img2"></div>
					</div>
					<div class="dowNew">
						@if($key<2)
						<img src="{{ asset('index/image/new.png') }}">{{date('Y-m-d',$val->create_time)}}
						<span>点击下载</span>
						@else
						{{date('Y-m-d',$val->create_time)}}
						<span>点击下载</span>
						@endif
					</div>
				</div>
				@endforeach
			</div>
			
		</div>
	</div>
	<div class="col-md-10 col-md-offset-1 enterpage">
		{!! $download3->appends(['title'=>$title])->render() !!}

	</div>

<div>
	


<!-- 尾部 -->
@include('findex/foot')
</body>
<script src="{{ asset('index/js/myht.js') }}"></script>
</html>