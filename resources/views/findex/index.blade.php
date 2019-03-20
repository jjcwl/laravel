<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>绵阳航天军民融合服务平台</title>
	 <meta name="viewport" content="width=device-width,initial-scale=1.0">
	<link rel="stylesheet" href="{{ asset('index/css/bootstrap.min.css') }}">
	<link type="text/css" href="http://888.gtimg.com/css/v1.0/qqcaipiao/cp_party_effect.css" rel="stylesheet"/>
	<link rel="stylesheet" href="{{ asset('index/css/style.css') }}">
	<link rel="stylesheet" href="{{ asset('index/css/style2.css') }}">
	<link rel="stylesheet" href="{{ asset('index/css/swiper.min.css') }}">
	<link rel="stylesheet" href="{{ asset('index/css/myht.css') }}">
  	<script src="{{ asset('index/js/swiper.js') }}"></script>
	<script src="{{ asset('index/js/jquery.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('index/js/common.js') }}"></script>
	<script src="{{ asset('index/js/bootstrap.min.js') }}"></script>
	<script src="http(s)://cdn.ronghub.com/RongIMLib-2.3.3.min.js"></script> 
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
<script>

//图片滚动
(function($){

	$.fn.kxbdMarquee = function(options){
		var opts = $.extend({},$.fn.kxbdMarquee.defaults, options);
		
		return this.each(function(){
			var $marquee = $(this);//滚动元素容器
			var _scrollObj = $marquee.get(0);//滚动元素容器DOM
			var scrollW = $marquee.width();//滚动元素容器的宽度
			var scrollH = $marquee.height();//滚动元素容器的高度
			var $element = $marquee.children(); //滚动元素
			var $kids = $element.children();//滚动子元素
			var scrollSize=0;//滚动元素尺寸
			var _type = (opts.direction == 'left' || opts.direction == 'right') ? 1:0;//滚动类型，1左右，0上下

			//防止滚动子元素比滚动元素宽而取不到实际滚动子元素宽度
			$element.css(_type?'width':'height',10000);
			//获取滚动元素的尺寸
			if (opts.isEqual) {
				scrollSize = $kids[_type?'outerWidth':'outerHeight']() * $kids.length;
			}else{
				$kids.each(function(){
					scrollSize += $(this)[_type?'outerWidth':'outerHeight']();
				});
			}
			//滚动元素总尺寸小于容器尺寸，不滚动
			if (scrollSize<(_type?scrollW:scrollH)) return; 
			//克隆滚动子元素将其插入到滚动元素后，并设定滚动元素宽度
			$element.append($kids.clone()).css(_type?'width':'height',scrollSize*2);
			
			var numMoved = 0;
			function scrollFunc(){
				var _dir = (opts.direction == 'left' || opts.direction == 'right') ? 'scrollLeft':'scrollTop';
				if (opts.loop > 0) {
					numMoved+=opts.scrollAmount;
					if(numMoved>scrollSize*opts.loop){
						_scrollObj[_dir] = 0;
						return clearInterval(moveId);
					} 
				}
				if(opts.direction == 'left' || opts.direction == 'up'){
					var newPos = _scrollObj[_dir] + opts.scrollAmount;
					if(newPos>=scrollSize){
						newPos -= scrollSize;
					}
					_scrollObj[_dir] = newPos;
				}else{
					var newPos = _scrollObj[_dir] - opts.scrollAmount;
					if(newPos<=0){
						newPos += scrollSize;
					}
					_scrollObj[_dir] = newPos;
				}
			};
			//滚动开始
			var moveId = setInterval(scrollFunc, opts.scrollDelay);
			//鼠标划过停止滚动
			$marquee.hover(
				function(){
					clearInterval(moveId);
				},
				function(){
					clearInterval(moveId);
					moveId = setInterval(scrollFunc, opts.scrollDelay);
				}
			);
			
			//控制加速运动
			if(opts.controlBtn){
				$.each(opts.controlBtn, function(i,val){
					$(val).bind(opts.eventA,function(){
						opts.direction = i;
						opts.oldAmount = opts.scrollAmount;
						opts.scrollAmount = opts.newAmount;
					}).bind(opts.eventB,function(){
						opts.scrollAmount = opts.oldAmount;
					});
				});
			}
		});
	};
	$.fn.kxbdMarquee.defaults = {
		isEqual:true,//所有滚动的元素长宽是否相等,true,false
		loop: 0,//循环滚动次数，0时无限
		direction: 'left',//滚动方向，'left','right','up','down'
		scrollAmount:1,//步长
		scrollDelay:10,//时长
		newAmount:3,//加速滚动的步长
		eventA:'mousedown',//鼠标事件，加速
		eventB:'mouseup'//鼠标事件，原速
	};
	
	$.fn.kxbdMarquee.setDefaults = function(settings) {
		$.extend( $.fn.kxbdMarquee.defaults, settings );
	};
	
})(jQuery);
</script>
<style>

</style>
<style type="text/css">
</style>
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
@include('findex/banner')

<!-- 公告 start -->
<div class="container-fluid announcement">
    <div class="col-md-1 col-xs-1 col-md-offset-1 announcementText" style="padding-left: 0">
		<img src="{{ asset('index/image/icon_notice.png') }}" alt=""> 通知公告：
	</div>
	<div class="col-md-9 col-xs-9" id=mar3>
		<ul>
			@foreach($notice as $val)
			<li><a href="{{url('findex/notice')}}?id={{$val->id}}"> {{$val->title}}</a></li>
			@endforeach
		</ul>	
	</div>
</div>

<!-- 内容 -->
<div class="container-fluid">
	<!-- 项目库 -->
	<div class="col-md-7 col-md-offset-1 project">
		<div class="container-fluid ">
			<div class="col-md-1 col-xs-3 projectText">
				<span class="narrow">项目库</span>
			</div>
			<div class="col-md-6 col-xs-4 projectDiv">
				<div class="projectSubmit">时间<span class="glyphicon glyphicon-arrow-down"></div>
				<div class="projectSubmit">热度<span class="glyphicon glyphicon-arrow-down"></div>
			</div>
			<div class="col-md-5 col-xs-5 more"><a href="{{url('findex/project')}}">查看更多</a><img src="{{ asset('index/image/sanjiao.png') }}"></div>
		</div>
		<div class="line"></div>
		<div>
		
		<div class="projects">
			@foreach($project as $val)
			<div class=" projectImg">
				<div class="immm"  >
					@if($val['img0'])
					<img src="{{asset('uploads'.'/'.$val['img0']) }}">	
					
					@else
						<img src="{{asset('uploads'.'/'.'default.jpg') }}">
					
					@endif

				</div>
				<div class="projectsIntroduce narrow"><a href="{{url('findex/pro_details')}}?id={{$val['id']}}">{{$val['name']}}</a></div>
				<div class="projectPlace">	
					<div class="projectIndustry narrow">所属行业：{{$val
					['iname']}}</div>
					<div class="date narrow">{{date('Y-m-d',$val['create_time'])}}</div>
				</div>
			</div>
			@endforeach
		</div>
		<div class="projects">
			@foreach($project2 as $val)
			<div class=" projectImg">
				<div class="immm">
				@if($val['img0'])
				<img src="{{asset('uploads'.'/'.$val['img0']) }}">	
				
				@else
					<img src="{{asset('uploads'.'/'.'default.jpg') }}">
				
				@endif
	
				</div>
				<div class="projectsIntroduce narrow"><a href="{{url('findex/pro_details')}}?id={{$val['id']}}">{{$val['name']}}</a></div>
				<div class="projectPlace">	
					<div class="projectIndustry narrow">所属行业：{{$val
					['iname']}}</div>
					<div class="date narrow">{{date('Y-m-d',$val['create_time'])}}</div>
				</div>
			</div>
			@endforeach
		</div>
	
		</div>
	</div>

	<!-- 需求 -->
	<div class="col-md-3 demand">
		<div class="container-fluid ">
			<div class="col-md-3 col-xs-3 demandText">
				<span class="narrow">需求信息</span>
			</div>
			<div class="col-md-6 col-xs-4 projectDiv">
				<div class="projectsSubmit">时间<span class="glyphicon glyphicon-arrow-down"></div>
				<div class="projectsSubmit">热度<span class="glyphicon glyphicon-arrow-down"></div>
			</div>
			<div class="col-md-3 col-xs-5 mores narrow"><a href="{{url('findex/requirement')}}">查看更多</a><img src="{{ asset('index/image/sanjiao.png') }}"></div>
		</div>
		<div class="line"></div>
		<div>
		
		<div class="demandinformation">
		@foreach($requirement as $val)
			<div>
				<div class="information"><img src="{{ asset('index/image/dian.png') }}">
				<a href="{{url('findex/requ_details')}}?id={{$val->id}}">{{$val->name}}</a></div>
				<div class="demandDate">{{date('Y-m-d',$val->create_time)}}</div>
			</div>
		@endforeach
		</div>
		<div class="demandinformation">
		@foreach($requirement2 as $val)
			<div>
				<div class="information"><img src="{{ asset('index/image/dian.png') }}">
				<a href="{{url('findex/requ_details')}}?id={{$val->id}}">{{$val->name}}</a></div>
				<div class="demandDate">{{date('Y-m-d',$val->create_time)}}</div>
			</div>
		@endforeach
		</div>

		</div>
	</div>
	<div class=" fixedRight">
		<div class="consulting" style="cursor: pointer;">
			<img  class="tb" src="{{ asset('index/image/icon_chat.png') }}">
			<div class="wzs">在线咨询</div>
		</div>
		<div class="consulting" style="cursor: pointer;">
			<img  class="tb" src="{{ asset('index/image/icon_feedback.png') }}">
			<div class="wz">在线留言</div>
		</div>
	</div>
	<div class="pop">
		<div class="messageform">
			<form class="form-horizontal">
			  <div class="form-group">
			    <label  class="col-sm-4 control-label">联系人</label>
			    <div class="col-sm-8">
			      <input type="text" class="form-control"  name="contact" id="contact" >
			    </div>
			  </div>
			  <div class="form-group">
			    <label  class="col-sm-4 control-label">联系方式</label>
			    <div class="col-sm-8">
			      <input type="text" class="form-control" 
			       name="phone" id="phone" >
			    </div>
			  </div>
			  <div class="form-group">
			    <label  class="col-sm-4 control-label">留言内容</label>
			    <div class="col-sm-8">
			      <textarea style="width:100%" 
			      name="requirements" id="requirements"></textarea>
			    </div>
			  </div>
			  <div class="form-group">
			    <div class="col-sm-offset-4 col-sm-2">
			      <input  type="submit" class="btn btn-default" value="提交" name="sub" 
			      onclick="return myRequ()">
			    </div>
			    <div class="col-sm-offset-1 col-sm-2">
			    	<input type="button" class="btn btn-default submitOverflow" name="" value="取消">
			    </div>
			  </div>
			</form>
		</div>
	</div>
	
	<script type="text/javascript">
	function myRequ(){
		var contact = document.getElementById('contact');
		var requirements = document.getElementById('requirements');
		var phone = document.getElementById('phone').value;
		if(contact.value=='')
	   	{
	   		alert('联系人不能为空');
	   		return false;
	   	}
		if(!(/^1[34578]\d{9}$/.test(phone))){ 
		        alert("联系方式有误，请重填");  
		        return false; 
	    }
	    if(requirements.value=='')
	   	{
	   		alert('留言内容不能为空');
	   		return false;
	   	}
	}
   	
	
	$('.consulting').eq(1).click(function(){
		if($('.login').eq(0).text() == '登录'){	
	    	var r=confirm("留言前请先登录");
			if (r==true){
		    	window.location.href="{{url('findex/login')}}";
			  }
	  	}else if($('.login').eq(0).text() == '个人中心'){
	  		$('.pop').css({
	  			display:'flex'
	  		})
	  	}
	})
	$('.consulting').eq(0).click(function(){
		if($('.login').eq(0).text() == '登录'){	
	    	var r=confirm("聊天前请先登录");
			if (r==true){
		    	window.location.href="{{url('findex/login')}}";
			  }
	  	}else if($('.login').eq(0).text() == '个人中心'){
	  		window.open("http://wpa.qq.com/msgrd?v=3&uin=907962489&site=qq&menu=yes")
	  	}
	})
	//留言提交取消
	$('.submitOverflow').click(function(){
		$('.pop').css({'display':'none'});
	})
	</script>

</div>

	<!-- banners -->
	<!--div class="container-fluid">
		<div class="col-md-10 col-md-offset-1 banners"><a href="http://www.innojoy.com/account/login2.html?idEMail=wxbxian@126.com&idPassword=123456"><img src="{{ asset('index/image/79619369278157410.jpg') }}"></a></div>
	</div-->
        <!--项目列表-->
    <div class="container-fluid title">
		<div class="col-md-8 col-md-offset-1 col-xs-4 hottitle narrow">成果体系</div>
		<div class="col-md-2 col-xs-8 look">
       		<a href="{{url('findex/projectLibrary')}}">查看更多</a><img src="{{ asset('index/image/sanjiao.png') }}">
        </div>
    </div> 
    <div class="container-fluid">
		<div class="col-md-10 col-md-offset-1 col-xs-12  lines"></div>
	</div> 
    <div class="container-fluid">
        <div class="col-md-10 col-md-offset-1 pro-table" style="margin-top:0;">
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
        <div id="scrollbox-a" style="overflow: hidden; height: 200px;"> 
        	<div id="scrollbox-b">
                <table width="100%" border="0" cellpadding="0" cellspacing="0" id="tableId">
                  <tbody>
                  @foreach($projectTable as $index=>$val)
                    <tr>
                        <td width="5%">{{$index+1}}</td>
                        <td width="35%">{{$val->pro_name}}</td>
                        <td width="20%">{{$val->pro_plate}}</td>
                        <td width="20%">{{$val->pro_system}}</td>
                        <td width="20%">{{$val->pro_field}}</td>
                    </tr>
                   @endforeach 
                  </tbody>	
                </table>
            </div>
            <div id="scrollbox-c"></div>
        </div>
        </div><!--pro-table-->
    </div>
	<script type="text/javascript">
	var speed = 50;
	var demo = document.getElementById('scrollbox-a'),demo1 = document.getElementById('scrollbox-b'),demo2 = document.getElementById('scrollbox-c');  
	demo2.innerHTML = demo1.innerHTML;  
	function Marquee() {  
		if (demo2.offsetTop - demo.scrollTop <= 0) {  
			demo.scrollTop -= demo1.offsetHeight;  
		} else {  
			demo.scrollTop++;  
		}  
	}  
	var MyMar = setInterval(Marquee, speed);  
	  
	demo.onmouseover = function() {  
		clearInterval(MyMar);  
	}  
	  
	demo.onmouseout = function() {  
		MyMar = setInterval(Marquee, speed);  
	}  
	</script>


	<!-- 热点 -->
	<div class="container-fluid title">
		<div class="col-md-8 col-md-offset-1 col-xs-4 hottitle narrow">热点资讯</div>
		<div class="col-md-2 col-xs-8 look"><a href="{{url('findex/information')}}">查看更多</a><img src="{{ asset('index/image/sanjiao.png') }}"></div>
	</div>
	<div class="container-fluid">
		<div class="col-md-10 col-md-offset-1 col-xs-12  lines"></div>
	</div>
	<div class="container-fluid">
	<div class="col-md-5 col-md-offset-1 col-xs-12" style="padding: 0;">
	<div class="fcnt " id="ppt">
		<div class="mimg" id="mpc">
			@foreach($photos as $val)
			<div style="display:block">
            <a  style="display:block;" href="{{url('findex/info_details')}}?id={{$val->id}}">
            <img src="{{asset('uploads'.'/'.$val->photo) }}" alt="" />
            <h3 class="photoNewsTitle">{{$val->title}}</h3>
            </a>
            </div>
			@endforeach
		</div>
		<!-- <div id="tri"></div> -->
		<ul class="">
			@foreach($photos as $val)
			<li class="cur"><a href="{{url('findex/info_details')}}?id={{$val->id}}"><img src="{{asset('uploads'.'/'.$val->photo) }}" alt="" /></a></li>
			@endforeach
		</ul>
	</div><!--ppt end-->
	<div style="text-align:center;clear:both">
	</div>
</div>
		<div class="col-md-5 col-xs-12 dynamic">
			<div class="dynamictitle">
				@foreach($type as $val)
				<button class="dynamicbut">{{$val->name}}</button>
				@endforeach
			</div>
			<div class=" container-fluid content">
				<div class="contentTab">
					@foreach($investment1 as $val)
					<div class="cons">
						<div class=" col-md-2  col-xs-3 contentData narrow">
						{{date('Y-m-d',$val->create_time)}}</div>
						<div class=" col-md-10 col-xs-9 contentCon narrow">
						<a href="{{url('findex/info_details')}}?id={{$val->id}}">{{$val->title}}</a></div>
					</div>
					@endforeach
				</div>
				<div class="contentTab">
					@foreach($investment2 as $val)
					<div class="cons">
						<div class=" col-md-2  col-xs-3 contentData narrow">
						{{date('Y-m-d',$val->create_time)}}</div>
						<div class=" col-md-10 col-xs-9 contentCon narrow">
						<a href="{{url('findex/info_details')}}?id={{$val->id}}">{{$val->title}}</a></div>
					</div>
					@endforeach
				</div>
				<div class="contentTab">
					@foreach($investment3 as $val)
					<div class="cons">
						<div class=" col-md-2 col-xs-3
						contentData narrow">
						{{date('Y-m-d',$val->create_time)}}</div>
						<div class=" col-md-10  col-xs-9 contentCon narrow">
						<a href="{{url('findex/info_details')}}?id={{$val->id}}">{{$val->title}}</a></div>
					</div>
					@endforeach
				</div>
				<div class="contentTab">
					@foreach($investment4 as $val)
					<div class="cons">
						<div class=" col-md-2 col-xs-3 contentData narrow">
						{{date('Y-m-d',$val->create_time)}}</div>
						<div class=" col-md-10 col-xs-9 contentCon narrow">
						<a href="{{url('findex/info_details')}}?id={{$val->id}}">{{$val->title}}</a></div>
					</div>
					@endforeach
				</div>
			</div>
		</div>
	</div>

	<!-- 企业名录 -->
	<div class="container-fluid title">
		<div class="col-md-8 col-md-offset-1 col-xs-4 hottitle">企业名录</div>
		<div class="col-md-2 col-xs-8 look"><a href="{{url('findex/enterprise')}}">查看更多</a><img src="{{ asset('index/image/sanjiao.png') }}"></div>
	</div>
	<div class="container-fluid">
		<div class="col-md-10 col-md-offset-1 lines"></div>
	</div>
	<div class="container-fluid">
	<div class="  col-md-9 col-md-offset-1 col-xs-12   marquee"> 
    	<ul>	
    		@foreach($enterprise as $val)
	        <li><a href="{{url('findex/ente_details')}}?id={{$val->id}}"><img src="{{asset('uploads'.'/'.$val->logo) }}"/></a></li>
	       @endforeach
		</ul>
	</div>
	</div>
	

	<!-- 下载专区 -->
	<div class="container-fluid title">
		<div class="col-md-8 col-xs-4 col-md-offset-1 hottitle">资料下载</div>
		<div class="col-md-2 col-xs-8  look"><a href="{{url('findex/download')}}
		">查看更多</a><img src="{{ asset('index/image/sanjiao.png') }}"></div>
	</div>
	<div class="container-fluid ">
		<div class="col-md-10 col-md-offset-1 col-xs-12 
		 download">
			<div class="col-md-2 col-xs-3 downloadTitle">
				@foreach($types as $val)
				<div class="downloadTit">{{$val->name}}</div>
				@endforeach
			</div>
			<div class="do">
			<div class="col-md-10 downloadCon col-xs-8">
				@foreach($download1 as $key=>$val)
				<div class="downloadNew">
					<div class="dow">
						<div class="dowinformationimg narrow"><img src="{{ asset('index/image/dian.png') }}">
						<a href="{{url('findex/download')}}">{{$val->title}}</a></div>
						<div class="dowinformation"></div>
						<div class="dowImg"><img src="{{ asset('index/image/icon_download.png') }}" class="img1"><img src="{{ asset('index/image/icon_download1.png') }}" class="img2"></div>
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
			<div class="col-md-10 downloadCon">
				@foreach($download2 as $key=>$val)
				<div class="downloadNew">
					<div class="dow">
						<div class="dowinformationimg"><img src="{{ asset('index/image/dian.png') }}">
						<a href="download.html">{{$val->title}}</a></div>
						<div class="dowinformation"></div>
						<div class="dowImg"><img src="{{ asset('index/image/icon_download.png') }}" class="img1"><img src="{{ asset('index/image/icon_download1.png') }}" class="img2"></div>
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
			<div class="col-md-10 downloadCon">
				@foreach($download3 as $key=>$val)
				<div class="downloadNew">
					<div class="dow">
						<div class="dowinformationimg"><img src="{{ asset('index/image/dian.png') }}">
						<a href="download.html">{{$val->title}}</a></div>
						<div class="dowinformation"></div>
						<div class="dowImg"><img src="{{ asset('index/image/icon_download.png') }}" class="img1"><img src="{{ asset('index/image/icon_download1.png') }}" class="img2"></div>
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
			<div class="col-md-10 downloadCon">
				@foreach($download4 as $key=>$val)
				<div class="downloadNew">
					<div class="dow">
						<div class="dowinformationimg"><img src="{{ asset('index/image/dian.png') }}">
						<a href="download.html">{{$val->title}}</a></div>
						<div class="dowinformation"></div>
						<div class="dowImg"><img src="{{ asset('index/image/icon_download.png') }}" class="img1"><img src="{{ asset('index/image/icon_download1.png') }}" class="img2"></div>
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
	</div>
	<!-- 合作机构 -->
	<div class="container-fluid title">
		<div class="col-md-8 col-md-offset-1 col-xs-4 hottitle">合作机构</div>
	</div>
	<div class="container-fluid">
		<div class="col-md-10 col-md-offset-1 lines"></div>
	</div>
	<div class="container-fluid">
		<div class=" col-md-10 col-md-offset-1 col-xs-12 cooperation">
			@foreach($agency as $val)
				<a href="{{$val->describe}}" class="agency" target="_blank"><img src="{{asset('uploads'.'/'.$val->logo) }}"/></a>
			@endforeach
		</div>
	</div>

<!-- 尾部 -->
@include('findex/foot')
<script>
/**
　　　* @author xf.radish
     * jQuery插件 常用效果的实现
     */
    (function (jQuery) {
        jQuery.fn.extend({
            /**
             *@description 无缝滚动 支持匀速上下左右和垂直翻滚上下
             *@param {
              *      direction:string,//滚动方向 值域：top|left|bottom|right|up|down
             *      speed:string//滚动速度（垂直翻滚时为停留时间）
             * } o
             *@example
             *HTML结构
             *<div id="mar">
             *    <ul>
             *        <li>内容1</li>
             *        <li>内容2</li>
             *        <li>内容3</li>
             *    </ul>
             *</div>
             *mar样式应该包含height,width,background等 注意不要覆盖了插件附加上去的样式
             *调用：
             *jQuery("#mar").marquee({
             *    direction:"top",
             *    speed:30
             *})
             *
             */
            marquee:function (o) {
                var it = this,
                        d = o.direction || 'left', //滚动方向 默认向左
                        s = o.speed || 30, //速度 默认30毫秒
                        mar = jQuery(it),
                        mp1 = jQuery(it).children(0).attr({id:"mp1"}),
                        marqueeFunc = getMarquee(d),
                        marRun = marqueeFunc ? setInterval(marqueeFunc, s) : function () {
                            return false;
                        };//开始滚动
                //鼠标悬停事件
                jQuery(it).hover(function () {
                    clearInterval(marRun);
                }, function () {
                    marRun = setInterval(marqueeFunc, s);
                })
                /*生成滚动函数
                 *1.判断方向 *2.装载CSS *3.判断需不需要滚动 *4.构造函数
                 */
                function getMarquee(d) {
                    var marqueeFunc;
                    switch (d) {
                        //水平向左
                        case "left":
                            mar.addClass("plus-mar-left");
                            var liHeight = mar[0].offsetHeight;
                            mar.css({"line-height":liHeight + "px"});
                            if (mp1[0].offsetWidth < mar[0].offsetWidth) return false;
                            mp1.clone().attr({id:"mp2"}).appendTo(mar);
                            marqueeFunc = function () {
                                if (mar[0].scrollLeft >= mp1[0].scrollWidth) {
                                    mar[0].scrollLeft = 0;
                                } else {
                                    mar[0].scrollLeft++;
                                }
                            }
                            break;
                        //水平向上
                        case "top":
                            mar.addClass("plus-mar-top");
                            if (mp1.outerHeight() <= mar.outerHeight()) return false;
                            var mp2 = mp1.clone().attr({id:"mp2"}).appendTo(mar);
                            marqueeFunc = function () {
                                var scrollTop = mar[0].scrollTop;
                                if (mp1[0].offsetHeight > scrollTop) {
                                    mar[0].scrollTop = scrollTop + 1;
                                } else {
                                    mar[0].scrollTop = 0;
                                }
                            }
                            break;
                        //水平向右
                        case "right":
                            mar.addClass("plus-mar-left");
                            var liHeight = mar[0].offsetHeight;
                            mar.css({"line-height":liHeight + "px"});
                            if (mp1[0].offsetWidth <= mar[0].offsetWidth) return false;
                            var mp2 = mp1.clone().attr({id:"mp2"}).appendTo(mar);
                            marqueeFunc = function () {
                                if (mar[0].scrollLeft <= 0) {
                                    mar[0].scrollLeft += mp2[0].offsetWidth;
                                } else {
                                    mar[0].scrollLeft--;
                                }
                            }
                            break;
                        //水平向下
                        case "bottom":
                            mar.addClass("plus-mar-bottom");
                            if (mp1[0].offsetHeight <= mar[0].offsetHeight) return false;
                            var mp2 = mp1.clone().attr({id:"mp2"}).appendTo(mar);
                            mar[0].scrollTop = mar[0].scrollHeight;
                            marqueeFunc = function () {
                                if (mp1[0].offsetTop >= mar[0].scrollTop) {
                                    mar[0].scrollTop += mp1[0].offsetHeight;
                                } else {
                                    mar[0].scrollTop--;
 
                                }
                            }
                            break;
                        //垂直翻滚 向上
                        case "up":
                            mar.addClass("plus-mar-up");
                            var liHeight = mar[0].offsetHeight;
                            mp1.css({"line-height":liHeight + "px"});
                            marqueeFunc = function () {
                                var currLi = it.eq(0).find("ul:first");
                                currLi.animate({
                                    marginTop:-liHeight
                                }, 500, function () {
                                    currLi.find("li:first").appendTo(currLi);
                                    currLi.css({marginTop:0});
                                })
                            }
                            break;
                        //垂直翻滚 向下
                        case "down":
                            mar.addClass("plus-mar-down");
                            var liHeight = mar[0].offsetHeight,
                                    liLength = mp1.children().length,
                                    topInit = -(liLength - 1) * liHeight + "px";
                            mp1.css({"top":topInit, "line-height":liHeight + "px"});
                            marqueeFunc = function () {
                                var currLi = it.eq(0).find("ul:last");
                                currLi.animate({
                                    marginTop:liHeight
                                }, 500, function () {
                                    currLi.find("li:last").prependTo(currLi);
                                    currLi.css({marginTop:0});
                                })
                            }
                            break;
                        default:
                        {
                            marqueeFunc = null;
                            alert("滚动插件：传入的参数{direction}有误！");
                        }
                    }
                    return marqueeFunc;
                }
            }
        })
    })(jQuery);
 

 $("#mar3").marquee({
        direction:"right",
        speed:20
    });
   
</script>
<script src="{{ asset('index/js/myht.js') }}"></script>
</body>

</html>