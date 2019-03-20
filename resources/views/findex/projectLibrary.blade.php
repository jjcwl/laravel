<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>成果体系</title>
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

<!-- banner start -->
@include('findex/banner')

<!--资讯热点-->
<div class="container-fluid">
	<div class="col-md-10 col-md-offset-1 col-xs-12 inves">
		<div class="container-fluid pageTitle">
			<div class="col-md-1 col-xs-1 invesesicon"><img src="{{ asset('index/image/icon_news.png') }}"></div>
			<div class="col-md-2 col-xs-3 investitle"><span>成果体系</span></div>
			<div class="col-md-9 col-xs-8 invesline"></div>
		</div>
	</div>
	<div class="col-md-10 col-md-offset-1 col-xs-12 prolibrary">
		<div class="pro-table">
        <table width="100%" border="0" cellpadding="0" cellspacing="0" class="pro-table-title">
          <thead>
            <tr>
                <td width="5%">#</td>
                <td width="35%">产品</td>
                <td width="20%">所属产业板块</td>
                <td width="20%">所属体系</td>
                <td width="20%">所属产业领域</td>
            </tr>
          </thead>	
        </table>
                <table width="100%" border="0" cellpadding="0" cellspacing="0" id="tableId">
                  <tbody>
                  @foreach($projectLibrary as $index=>$val)
                    <tr>
                        <td width="5%">{{$val->pro_id+16600}}</td>
                        <td width="35%">{{$val->pro_name}}</td>
                        <td width="20%">{{$val->pro_plate}}</td>
                        <td width="20%">{{$val->pro_system}}</td>
                        <td width="20%">{{$val->pro_field}}</td>
                    </tr>
                   @endforeach 
                  </tbody>	
                </table>
        </div><!--pro-table-->
	</div>
	
	<div class="col-md-10 col-md-offset-1 enterpage">
		{!! $projectLibrary->render() !!}
	</div>
</div>
	


<!-- 尾部 -->
@include('findex/foot')
</body>
<script src="{{ asset('index/js/myht.js') }}"></script>
</html>