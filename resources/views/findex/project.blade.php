<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>项目列表</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<meta name="_token" content="{{ csrf_token() }}"/>
	<link rel="stylesheet" href="{{ asset('index/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('index/css/myht.css') }}">
	<link rel="stylesheet" href="{{ asset('index/css/style.css') }}">
	<link type="text/css" href="http://888.gtimg.com/css/v1.0/qqcaipiao/cp_party_effect.css" rel="stylesheet"/>
	<script src="{{ asset('index/js/jquery.min.js') }}"></script>
	<script src="{{ asset('index/js/bootstrap.min.js') }}"></script>
	<style type="text/css">
		p{margin:0;padding:0;}
	</style>
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

<!-- banner start -->
@include('findex/banner')

<!-- 项目 -->
<div class="container-fluid">
	<div class="col-md-10 col-md-offset-1 col-xs-12 inves">
		<div class="container-fluid pageTitle">
			<div class="col-md-1 col-xs-1 invesesicon"><img src="{{ asset('index/image/icon_item.png') }}"></div>
			<div class="col-md-1 col-xs-2 investitle"><span>项目</span></div>
			<div class="col-md-10 col-xs-9 invesline"></div>
			
		</div>
	</div>
	<div class="col-md-10 col-md-offset-1 col-xs-12	 enterborder"  style="padding-bottom:20px;">
		<div class="col-md-8 col-xs-12	 enterprise">
			<div class="container-fluid col-md-12 col-xs-12 requireente">
				<div class="col-md-12 col-xs-12 entercon">
					<div class="col-md-2 col-xs-2 entertit">所属行业</div>
					<div class="col-md-10 col-xs-10 en">
						<div class="enterbuts noLimit">不限</div>
						@foreach($industry as $val)
						<div class="enterbut narrow" id="i1">{{$val->iname}}</div>
						@endforeach
						
					</div>
				</div>
				<div class="col-md-12 entercon">
					<div class="col-md-2 col-xs-2 entertit">合作方式</div>
					<div class="col-md-10 col-xs-10
					en">
						<div class="enterbuts noLimit">不限</div>
						@foreach($cooperation as $val)
						<div class="enterbut narrow" id="i1">{{$val->cname}}</div>
						@endforeach
					</div>
				</div>
				<div class="col-md-12 entercon ">
					<div class="col-md-2 col-xs-2 entertit">成熟度</div>
					<div class="col-md-10 col-xs-10 
					en">
						<div class="enterbuts noLimit">不限</div>
						@foreach($mature as $val)
						<div class="enterbut narrow" id="i1">{{$val->mname}}</div>
						@endforeach
					</div>
				</div>
				<div class="col-md-12 entercon">
					<div class="col-md-2  col-xs-2 entertit">价格区间</div>
					<div class="col-md-10   col-xs-10
					en">
						<div class="enterbuts noLimit">不限</div>
						<div class="enterbut narrow" id="mo1">一万以下</div>
						<div class="enterbut narrow" id="mo2">一万到三万</div>
						<div class="enterbut narrow" id="mo3">三万以上</div>
					</div>
				</div>
				<div>
					<form action="{{url('findex/project')}}" id="prosubmit">
						<input type="text" id="proindustry" name="proindustry">
						<input type="text" id="procooperation" name="procooperation">
						<input type="text" id="promature" name="promature">
						<input type="text" id="procoop_money" name="procoop_money">
						<!-- <input type="submit" id="prosubmit" name="sub"> -->
					</form>
				</div>
			</div>
		</div>
		
		<div class="col-md-4 enterimg">
			<!--img src="{{ asset('index/image/pro.png') }}"-->
		</div>
	</div>
	<div class="container-fluid">
		<div class="col-md-4 col-md-offset-1 col-xs-12 entertab">
			<div class="entertabs">
				时间<span class="glyphicon glyphicon-arrow-down"></span>
			</div>
			<div class="entertabs">
				人气<span class="glyphicon glyphicon-arrow-down"></span>
			</div>
			<div class="entertabs">
				收藏<span class="glyphicon glyphicon-arrow-down"></span>
			</div>
		</div>
		<!-- <div class="col-md-3 col-xs-12"></div> -->
		<form class="col-md-4 col-md-offset-2 col-xs-12 proform">
			<div class="container-fluid">
				<div class="entersearch col-md-8 col-xs-12">
					<select class="enterselect" name="entesel">
				         <option value="1">名称</option>
				         <option value="2">细分领域</option>
					</select>
					<input type="text" class="entertext" name="name" value="{{ Session::get('selname') }}">
				</div>
				<div class="col-md-3 col-xs-12 entersubmit">
					<input type="submit" class="entersub" name="sub" value="搜索">
				</div>
			</div>
		</form>
		<div class="col-md-1"></div>
	</div>
	<div class="col-md-10 col-md-offset-1 col-xs-12 entborder"></div>
	<div>
	@if(count($project)<1)
	<div class="col-md-10 col-md-offset-1" style="text-align: center;padding-top: 50px;">暂无项目</div>
	@else
	

	<div class="enterprisetab container-fluid">
		@foreach($project as $val)
		<a href="{{url('findex/pro_details')}}?id={{$val['id']}}">
		<div class="col-md-10 col-md-offset-1 col-xs-12 enterpise">
			<div class="col-md-4 col-xs-5 proimg">
				@if($val['img0'])
					<img src="{{asset('uploads'.'/'.$val['img0']) }}">	
				
				@else
					<img src="{{asset('uploads'.'/'.'default.jpg') }}">
				
				@endif
			</div>
			<div class="col-md-8 col-xs-7 enterintroduce">
				<div class="col-md-12 col-xs-12 entername narrow"><b>{{$val['name']}}</b></div>
				<div id="prolook" class="col-md-12 col-xs-12 enterint">
				{{$val['abstract']}}</div>
				<div class=" col-md-12 col-xs-12 enterfield">应用领域： {{$val['niche'] }}</div>
				<div class="col-md-12  col-xs-12 enterdate">发布日期： {{date('Y/m/d',$val['create_time'])}}</div>
				<div class="col-md-12 col-xs-12">
					<div class="col-md-8  col-xs-7 enterplase"><!-- 地点： {{$val['area']}} <span class="glyphicon glyphicon-send"></span> --></div>
					<div class="col-md-4  col-xs-5 enterlook narrow">浏览量： {{$val['look']}}</div>
				</div>
			</div>
		</div>
		</a>
		@endforeach
	</div>

	<div class="enterprisetab container-fluid">
		@foreach($project1 as $val)
		<a href="{{url('findex/pro_details')}}?id={{$val['id']}}">
		<div class="col-md-10 col-md-offset-1 col-xs-12 enterpise">
			<div class="col-md-4 col-xs-5 proimg">
				@if($val['img0'])
					<img src="{{asset('uploads'.'/'.$val['img0']) }}">	
				
				@else
					<img src="{{asset('uploads'.'/'.'default.jpg') }}">
				
				@endif
			</div>
			<div class="col-md-8 col-xs-7 enterintroduce">
				<div class="col-md-12 col-xs-12 entername narrow"><b>{{$val['name']}}</b></div>
				<div id="prolook" class="col-md-12 col-xs-12 enterint">
				{{$val['abstract']}}</div>
				<div class=" col-md-12 col-xs-12 enterfield">应用领域： {{$val['niche'] }}</div>
				<div class="col-md-12  col-xs-12 enterdate">发布日期： {{date('Y/m/d',$val['create_time'])}}</div>
				<div class="col-md-12 col-xs-12">
					<div class="col-md-8  col-xs-7 enterplase"><!-- 地点： {{$val['area']}} <span class="glyphicon glyphicon-send"></span> --></div>
					<div class="col-md-4  col-xs-5 enterlook narrow">浏览量： {{$val['look']}}</div>
				</div>
			</div>
		</div>
		</a>
		@endforeach
	</div>

	<div class="enterprisetab container-fluid">
		@foreach($project2 as $val)
		<a href="{{url('findex/pro_details')}}?id={{$val['id']}}">
		<div class="col-md-10 col-md-offset-1 col-xs-12 enterpise">
			<div class="col-md-4 col-xs-5 proimg">
				@if($val['img0'])
					<img src="{{asset('uploads'.'/'.$val['img0']) }}">	
				
				@else
					<img src="{{asset('uploads'.'/'.'default.jpg') }}">
				
				@endif
			</div>
			<div class="col-md-8 col-xs-7 enterintroduce">
				<div class="col-md-12 col-xs-12 entername narrow"><b>{{$val['name']}}</b></div>
				<div id="prolook" class="col-md-12 col-xs-12 enterint">
				{{$val['abstract']}}</div>
				<div class=" col-md-12 col-xs-12 enterfield">应用领域： {{$val['niche'] }}</div>
				<div class="col-md-12  col-xs-12 enterdate">发布日期： {{date('Y/m/d',$val['create_time'])}}</div>
				<div class="col-md-12 col-xs-12">
					<div class="col-md-8  col-xs-7 enterplase"><!-- 地点： {{$val['area']}} <span class="glyphicon glyphicon-send"></span> --></div>
					<div class="col-md-4  col-xs-5 enterlook narrow">浏览量： {{$val['look']}}</div>
				</div>
			</div>
		</div>
		</a>
		@endforeach
	</div>
	@endif
	</div>
	<div class="col-md-10 col-md-offset-1 enterpage">

		{!! $project->appends(['proindustry'=>$proindustry,'procooperation'=>$procooperation,
		'promature'=>$promature,'procoop_money'=>$procoop_money,'name'=>$name])->render() !!}
		<span>共  {{$project->total()}} 条</span>
	</div>
	<div class="col-md-10 col-md-offset-1 requresults">需求推荐</div>
	<div class="col-md-10 col-md-offset-1 requborders"></div>
	<div class="col-md-10 col-md-offset-1 projectrequ">
		@foreach($requirement as $val)
		<div class="prorequ">
			<div class="requinformation narrow"><img src="{{ asset('index/image/dian.png') }}">
			<a href="{{url('findex/requ_details')}}?id={{$val->id}}">{{$val->name}}</a></div>
			<div class="demandDate">{{date('Y-m-d',$val->create_time)}}</div>
		</div>
		@endforeach
	</div>
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
$('#prosubmit').css({'display':'none'});
(function(){
var li = document.querySelectorAll('.en');
var data = [];
var inputId = ['proindustry','procooperation','promature','procoop_money']
var dataId = ['','','','']
var valId = []
for(var i = 0; i <li.length; i++){
	data[i] = '';
	console.log(data)
    setClick(li[i],i);
}

function setClick(parent,index){
    var option = parent.getElementsByTagName("div");
    for(var i = 0; i < option.length; i++){
    /*
    建一个数组
    */
    option[i].onclick = function(){
        data[index] = this.innerHTML;
        dataId[index] = data[index]
        $('#proindustry').val(dataId[0]);
        $('#procooperation').val(dataId[1]);
        $('#promature').val(dataId[2]);
        $('#procoop_money').val(dataId[3]);
        $('#prosubmit').submit();
        };
    }
}
function getQueryString(name) {  
        var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i");  
        var r = window.location.search.substr(1).match(reg);  
        let enNum = $('.en').children().length;
		if (r != null) return decodeURI(r[2]);
    }

function dataArr(dataId){
	for(let index = 0; index < dataId.length;index ++){
		console.log(dataId[index].length)
		if(dataId[index].length != 0 && getQueryString(inputId[index]).length == 0){
			console.log(11)
		}else{
			dataId[index] = getQueryString(inputId[index])
		}
		console.log(dataId)
	}
}
dataArr(dataId)

for(let j = 0;j < dataId.length;j ++){
  let childLength = $('.en').eq(j).children().length;
  for(let i = 0;i < childLength;i ++){
      $('.en').eq(j).children().eq(i).css({'background':'#fff'})
    if(dataId[j] == undefined || dataId[j].length == 0){
      $('.en').eq(j).children().eq(0).css({'background':'rgb(255, 0, 0)','color':'#fff'})
    }else if($('.en').eq(j).children()[i].innerHTML == dataId[j]){
      $('.en').eq(j).children().eq(i).css({'background':'rgb(255, 0, 0)','color':'#fff'})
    }else{
    }
  }
}

})(); 

</script>
<script src="{{ asset('index/js/myht.js') }}"></script>
</html>