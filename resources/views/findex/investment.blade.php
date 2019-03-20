<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>投融资服务</title>
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
		.modal-body {font-size:16px;line-height:1.7;}
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

$(function(){
	$(".invest").on("click",function(){
		var name = $(this).children('.digitals').children('.investmenttit').text();
		var content = $(this).children('.digitals').children('.invescon').text();
		console.log(content);
		$('#myModalLabel').html(name);
		$("#identifier .modal-body").html(content);
		$('#identifier').modal();	
	});
	
})
</script>
<!-- banner start -->
@include('findex/banner')

<!-- 投融资服务 -->
<div class="container-fluid">
	<div class="col-md-10 col-md-offset-1 col-xs-12 inves">
		<div class="container-fluid pageTitle">
			<div class="col-md-1 col-xs-1 invesesicon"><img src="{{ asset('index/image/icon_money.png') }}"></div>
			<div class="col-md-2 col-xs-3 investitle narrow"><span>投融资服务</span></div>
			<div class="col-md-9 col-xs-8 invesline"></div>
			
		</div>
	</div>
	<div class="col-md-10 col-xs-12 col-md-offset-1 invesdetailss">
	@foreach($investment as $val)
		<div class="col-md-6 col-xs-12 invest">
			<div class="col-md-3 col-xs-5 digital">{{$val->number}}</div>
			<div class="col-md-9 col-xs-7 digitals">
				<div class="investmenttit narrow">{{$val->title}}</div>
				<div class="invescon">{{$val->content}}</div>
				<div class="inveslook"></div>
			</div>
		</div>
	@endforeach
	</div>
</div>
	

<!-- 模态框（Modal） -->
<div class="modal fade" id="identifier" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel"></h4>
            </div>
            <div class="modal-body"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal -->
</div>

<!-- 尾部 -->
@include('findex/foot')
</body>
<script src="{{ asset('index/js/myht.js') }}"></script>
</html>