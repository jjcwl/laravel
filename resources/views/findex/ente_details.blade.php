<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>企业详情</title>
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

<!-- 企业详情 -->
<div class="container-fluid">
	<div class="col-md-10 col-md-offset-1 redetit">
		<div class="col-md-2 redesize"><a href="{{url('findex/enterprise')}}">企业列表</a> /  <a href="{{url('findex/ente_details')}}">企业详情</a></div>
		<div class="col-md-10 redeborder"></div>
	</div>
	<div class="col-md-10 col-md-offset-1 prodeborder">
		<div class="col-md-4 prodeimg">
        	<div class="prodeimgbox">
			<img src="{{asset('uploads'.'/'.$ente_details->logo) }}">
            </div>
		</div>
		<div class="col-md-8 col-xs-12 ">
			<div class="redename">{{$ente_details->name}}</div>
			<div>
				<div class="col-md-6 col-xs-6">
					<div class="rededate ">更新日期：{{date('Y/m/d',$ente_details->update_time)}}</div>
					<div class="rededate">联系人：{{$ente_details->contact}}</div>
					<div class="prodeplase ">地址：{{$ente_details->area}}
					<span class="glyphicon glyphicon-send"></span></div>
				</div>
				<div class="col-md-6 col-xs-12">
					<div class="rededate">所属行业：{{$ente_details->iname}}</div>
					<div class="rededate">联系方式：{{$ente_details->phone}}</div>
				</div>
			</div>
			<div class="col-md-11 col-xs-12">
				<div class="prodeplases">细分领域：
				@foreach($field as $val)
					<span>{{$val}}</span>
				@endforeach</div></div>
			</div>
			<div class="col-md-7 prodelike">
				<div class="propraise">
					<span id="entepraise" class="glyphicon glyphicon-thumbs-up"
					rel="{{$ente_details->praise}}"> 点赞（<span id="propraiseNum">{{$ente_details->praise}}</span>）</span>
				</div>
				<div class="procollection">
					<span id="entecollection" class="glyphicon glyphicon-plus-sign"> 收藏（<span id="procollectionNum">{{$ente_details->collection}}</span>）</span>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-3 col-md-offset-1 entertab">
		<div class="prodetab">
			企业简介<span class="glyphicon glyphicon-arrow-down"></span>
		</div>
		<div class="prodetab">
			企业项目<span class="glyphicon glyphicon-arrow-down"></span>
		</div>
	</div>
	<div class="col-md-10 col-md-offset-1 prodeborderss">
		<div class="prodetabs">
			<!--div class="rededescribe">企业简介</div>
			<div class="redeline" style="padding-top: 20px;"></div-->
			<div class="col-md-7" style="padding-left: 0;">
				<div class="prodecon"><?php
                     echo html_entity_decode($ente_details->introduction);
                ?></div>
			</div>
			<div class="col-md-5">
				<div class="prodeimgs"><img src="{{asset('uploads'.'/'.$ente_details->logo) }}"></div>
			</div>
		</div>
		<div class="prodetabs">
			<!--div class="rededescribe">企业项目</div>
			<div class="redeline" style="padding-top: 20px;"></div-->
			<div class="col-md-7" style="padding-left: 0;">
				<div class="prodecon">{{$ente_details->en_project}}</div>
			</div>
			<div class="col-md-5">
				<div class="prodeimgs"><img src="{{asset('uploads'.'/'.$ente_details->logo) }}"></div>
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
	    $(`.${lClass}`).eq(0).click(function(){
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



like('propraise','#D8290D','b','propraiseNum',"{{$ente_details->id}}","{{url('findex/ente_details')}}",'praise');

like('procollection','#043477','bcoll','procollectionNum',"{{$ente_details->id}}","{{url('findex/ente_details')}}",'collection');
</script>
</body>

<script src="{{ asset('index/js/myht.js') }}"></script>
</html>