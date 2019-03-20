<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>项目详情</title>
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

<!-- 项目详情 -->
<div class="container-fluid">
	<div class="col-md-10 col-md-offset-1 redetit">
		<div class="col-md-2 redesize"><a href="{{url('findex/project')}}">项目列表</a> /  <a href="{{url('findex/pro_details')}}">项目详情</a></div>
		<div class="col-md-10 redeborder"></div>
	</div>
	<div class="col-md-10 col-md-offset-1 entedeborder">
		<div class="col-md-4 entedeimg">
			<div class="entedeimg bannerImgs">
				@if($photos['0'])
					@foreach($photos as $v)
					<img src="{{asset('uploads'.'/'.$v) }}">	
					@endforeach
					
				@else
					<div class="entedeimgs"><img src="{{asset('uploads'.'/'.'default.jpg') }}"></div>
				@endif
			</div>
			<div class="entedeimage">
				@if($photos['0'])
					@foreach($photos as $v)
					<div class="entedeimgs"><img src="{{asset('uploads'.'/'.$v) }}"></div>
					@endforeach
					
				@else
					<div class="entedeimgs"><img src="{{asset('uploads'.'/'.'default.jpg') }}"></div>
				@endif
				
			</div>
		</div>
		<div class="col-md-8 col-xs-12">
			<div class="entedename col-xs-12"><b>{{$pro_details->name}}</b></div>
			<div>
				<div class="col-md-6 col-xs-6">
					<div class="rededate">更新日期：{{date('Y-m-d',$pro_details->update_time)}}</div>
					<div class="rededate ">技术来源：{{$pro_details->sname}}</div>
					<div class="rededate ">合作金额：{{$pro_details->coop_money}}</div>
<!-- 					<div class="rededate ">联系人：{{$pro_details->contact}}</div> -->
				</div>
				<div class="col-md-6 col-xs-6">
					<!-- <div class="rededate ">截止日期：{{$pro_details->asdate}}</div> -->
					<div class="rededate ">合作方式：{{$pro_details->cname}}</div>
					<div class="rededate ">所属行业：{{$pro_details->iname}}</div>
<!-- 					<div class="rededate ">联系方式：{{$pro_details->phone}}</div> -->
				</div>
			</div>
			<div class="col-md-11 col-xs-12">
				<div class="prodeplases">应用领域：
				@foreach($niche as $val)
					<span>{{$val}}</span>
				@endforeach
				</div>
			</div>
			<div class="col-md-7 col-xs-12 prodelike">
				<div class="propraise">
					<span id="propraise" class="glyphicon glyphicon-thumbs-up" > 点赞（<span id="propraiseNum">{{$pro_details->praise}}</span>）</span>

				</div>
				<div class="procollection">
					<span id="procollection" class="glyphicon glyphicon-plus-sign"> 收藏（<span id="procollectionNum">{{$pro_details->collection}}</span>）</span>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-8 col-md-offset-1 col-xs-12 entert">
		<div class="proentertab">
			<div class="prodetab">
				简介
			</div>
			<div class="prodetab">
				产权情况
			</div>
			<div class="prodetab">
				获奖情况
			</div>
			<div class="prodetab">
				技术情况
			</div>
			<div class="prodetab">
				应用范围
			</div>
		</div>
		<div>
		<div class="col-md-12  prodeborders">	
			<div class="rededescribe">项目情况</div>
			<div class="redeline"></div>
			<div class="redecon"><?php
                     echo html_entity_decode($pro_details->tec_introduction);
                ?>
			</div>
			
		</div>
		<div class="col-md-12  prodeborders">	
			<div class="rededescribe">产权情况</div>
			<div class="redeline"></div>
			<div class="redecon">{{$pro_details->patent}}
			</div>
		</div>
		<div class="col-md-12  prodeborders">	
			<div class="rededescribe">获奖情况</div>
			<div class="redeline"></div>
			<div class="redecon">{{$pro_details->winning}}
			</div>
		</div>
		<div class="col-md-12  prodeborders">	
			<div class="rededescribe">技术情况</div>
			<div class="redeline"></div>
			<div class="redecon">{{$pro_details->advantage}}
			</div>
		</div>
		<div class="col-md-12  prodeborders">	
			<div class="rededescribe">应用范围</div>
			<div class="redeline"></div>
			<div class="redecon">{{$pro_details->scope}}
			</div>
		</div>
		</div>
	</div>

	
	<div class="col-md-2 pros">
		<div class="  requderesults">项目推荐</div>
		<div class="  requborders"></div>
		<div class=" requproject">
			<div class="requdeprojects">
				@foreach($project as $val)
				<div class="requdeprojectImg">
					<div class="requimmm">
						@if($val['img0'])
							<img src="{{asset('uploads'.'/'.$val['img0']) }}">	
						
						@else
							<img src="{{asset('uploads'.'/'.'default.jpg') }}">
						
						@endif
					</div>
					<div class="requprojectsIntroduce narrow"><a href="{{url('findex/pro_details')}}?id={{$val['id']}}">{{$val['name']}}</a></div>
					<div class="requprojectPlace">	
						<div class="requprojectIndustry narrow">所属行业：{{$val['iname']}}</div>
						<div class="requdata narrow">{{date('Y/m/d',$val['create_time'])}}</div>
					</div>
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
</body>
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



like('propraise','#D8290D','b','propraiseNum',"{{$pro_details->id}}","{{url('findex/pro_details')}}",'praise');

like('procollection','#043477','bcoll','procollectionNum',"{{$pro_details->id}}","{{url('findex/pro_details')}}",'collection');



</script>


<script src="{{ asset('index/js/myht.js') }}"></script>
<script type="text/javascript">
	$('.bannerImgs').children().eq(0).css({'z-index':'2'});
	$('.entedeimgs').mouseover(function(){
		$(this).parent().parent().find('.bannerImgs').find('img').eq($(this).index()).siblings().css({'z-index':'1'});
		$(this).parent().parent().find('.bannerImgs').find('img').eq($(this).index()).css({'z-index':'2'});
	})
</script>
</html>