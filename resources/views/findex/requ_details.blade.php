<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>需求详情</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<meta name="_token" content="{{ csrf_token() }}"/>
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

<!-- 需求详情 -->
<div class="container-fluid">
	<div class="col-md-10 col-md-offset-1 redetit">
		<div class="col-md-2 redesize"><a href="{{url('findex/requirement')}}">需求列表</a> /  <a href="{{url('findex/requ_details')}}">需求详情</a></div>
		<div class="col-md-10 redeborder"></div>
	</div>
	<div class="col-md-10 col-md-offset-1  col-xs-12 redeintroduce">
		<div class="redename narrow">{{$requ_details->name}}</div>
		<div>
			<div class="col-md-4 col-xs-6 rededates">
				<div class="rededate">更新日期：{{date('Y-m-d',$requ_details->update_time)}}</div>
				<div class="rededate">所属行业：{{$requ_details->iname}}</div>
				<div class="rededate">合作金额：{{$requ_details->money}}</div>
				<div class="prodeplases">细分领域：
				@foreach($fields as $val)
					<span>{{$val}}</span>
				@endforeach</div>
			</div>
			<div class="col-md-4 col-xs-6 rededates">
				<div class="rededate">合作方式：{{$requ_details->cname}}
				</div>
				<div class="rededate">联系人：{{$requ_details->contact}}</div>
				<div class="rededate">联系方式：{{$requ_details->phone}}</div>
			</div>
			<div class="col-md-3 col-xs-12 rede inlineBlock">
				<div class="praise">
					<span id="requpraise" class="glyphicon glyphicon-thumbs-up">点赞（<span id="propraiseNum">{{$requ_details->praise}}</span>）</span> 
				</div>
				<div class="collection">
					<span id="requcollection" class="glyphicon glyphicon-plus-sign">收藏（<span id="procollectionNum">{{$requ_details->collection}}</span>）</span> 
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-10 col-md-offset-1 redeborders">
		<div class="col-md-7 redebor">
			<div class="rededescribe">需求描述</div>
			<div class="redeline"></div>
			<div class="redecon">
			<?php
                echo html_entity_decode($requ_details->describes);
            ?>             	
            </div>
			<div class="rededescribes">预期目标</div>
			<div class="redeline"></div>
			<div class="redecon">{{$requ_details->target}}</div>
		</div>
		<div class="col-md-1"></div>
		<div class="col-md-4 redebors">
			<div class="rededescribe">需求推荐</div>
			<div class="redeline"></div>
			<div class="demandinformation">
			@foreach($requirement as $val)
			<div>
				<div class="requinformation narrow"><img src="{{ asset('index/image/dian.png') }}"><a href="{{url('findex/requ_details')}}?id={{$val->id}}">{{$val->name}}</a></div>
				<div class="demandDate">{{date('Y/m/d',$val->create_time)}}</div>
			</div>
			@endforeach
			</div>
		</div>
	</div>
</div>
<div class="test">	
	<div id="b">{{$b}}</div>
	<div id="bcoll">{{$bcoll}}</div>
</div>


<!-- 尾部 -->
@include('findex/foot')
<script type="text/javascript">
	 $.ajaxSetup({
   headers: {
       'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
   }
});
  var like = function(lClass,lBackground,lStateId,lNumId,lId,lUrl,lPraise){
    if($('.login').eq(0).text() == '登录'){	
    	$(`.${lClass}`).css({'background':'#ccc',});
	    $(`.${lClass}`).click(function(){
	    	var r=confirm("点赞前请先登录");
			if (r==true){
		    	window.location.href="login";
			  }else{
			  	// alert("You pressed Cancel!");
			  }
	    })
    }else if($('.login').eq(0).text() == '个人中心'){
    	//开关的状态
    	let propraise = 0;
    	//进入页面时点赞的状态
    	let stateOk=$(`#${lStateId}`).text();
    	if(stateOk == 1){
	    	$(`.${lClass}`).css({'background':'#ccc',});
    		propraise = 1;
    	}
    	$(`.${lClass}`).eq(0).click(function(event){
    		let data
			if(propraise == 0){
	    		$(`#${lNumId}`).text(parseInt($(`#${lNumId}`).text()) + 1);
				let id=lId;
		    	let praise=1;
		    	if(lPraise == 'praise'){
		    		data = {praise:praise,'id':id};
		    	}else if(lPraise == 'collection'){
		    		data = {collection:praise,'id':id};
		    	}
		        $.ajax({ 
		            type:"POST", 
		            url:lUrl, 
		            data:data, 
		            success: function(data){
						console.log(data.status);
					},
					error: function(xhr, type){
						alert('Ajax error!')
					}
		        }); 

		    	$(`.${lClass}`).css({'background':'#ccc',});

	    		//点赞数增加
	    		propraise = 1;
	    	}else if(propraise == 1){
	    		$(`#${lNumId}`).text(parseInt($(`#${lNumId}`).text()) - 1);
		    	$(`.${lClass}`).css({'background':lBackground,});	

				let id=lId;
		    	let praise=0;
		    	if(lPraise == 'praise'){
		    		data = {praise:praise,'id':id};
		    	}else if(lPraise == 'collection'){
		    		data = {collection:praise,'id':id};
		    	}
		        $.ajax({ 
		            type:"POST", 
		            url:lUrl, 
		            data:data, 
		            success: function(data){
						console.log(data.status);
					},
					error: function(xhr, type){
						alert('Ajax error!')
					}
		        });

	    		// 点赞数减少
	    		propraise = 0;
	    	}
    	})
	}
}



like('praise','#D8290D','b','propraiseNum',"{{$requ_details->id}}","{{url('findex/requ_details')}}",'praise');

like('collection','#043477','bcoll','procollectionNum',"{{$requ_details->id}}","{{url('findex/requ_details')}}",'collection');
</script>
</body>

<script src="{{ asset('index/js/myht.js') }}"></script>
</html>