<!-- 手机端 -->
<div class="mTop">
	<div class="mNavIcon">
		<img src="{{ asset('index/image/all.svg') }}">
	</div>
	<div class="mMeIcon">
		<img src="{{ asset('index/image/set.svg') }}">
	</div>
</div>
<div class="mNav">
	<div class="mNavClose">x</div>
	<div class="mLogo">
		<a href="{{url('/')}}"><img src="{{ asset('index/image/logo.png') }}"></a>
	</div>
	<form class="mSearch">
			<div class="search">
				<select class="selectRea" name="sel">
			         <option value="1">项目</option>
			         <option value="2">需求</option>
			         <option value="3">企业</option>
				</select>
				<input type="text" class="searchText" name="aname">
			</div>
			<div class="searchBtn">
				<input type="submit" class="searchSub" name="sub" value="搜索">
			</div>
	</form>
	<div class="mNavCon">
		<li class="navigation navigationBorder"><a href="{{url('/
		')}}">首页</a></li>
		<li class="navigation"><a href="{{url('findex/base')}}">关于我们</a></li>
		<li class="navigation"><a href="{{url('findex/project')}}">项目库</a></li>
		<li class="navigation"><a href="{{url('findex/requirement')}}">需求信息</a></li>
		<li class="navigation"><a href="http://www.innojoy.com/account/login2.html?idEMail=wxbxian@126.com&idPassword=123456">专利大数据</a></li>
		<li class="navigation"><a href="{{url('findex/investment')}}">投融资服务</a></li>
		<li class="navigation"><a href="{{url('findex/information')}}">资讯热点</a></li>
		<li class="navigation"><a href="{{url('findex/enterprise')}}">企业名录</a></li>
		<li class="navigation"><a href="{{url('findex/download')}}">资料下载</a></li>
	</div>
	<!-- <div class="mQrCode">
		<img src="{{ asset('index/image/ic_wechat.jpg') }}" class="code">
	</div> -->
</div>
<div class="mMe">
	<div class="mMeClose">x</div>
	<div class="zxc">
		@if(Session::get('id'))
		<div style="padding-right: 15px; text-align: center;">欢迎你,{{Session::get('name')}}</div>
		<a href="{{url('findex/collection')}}" class="login">个人中心</a>
		@else
		<a href="{{url('findex/login')}}" class="login">登录</a>
		<a href="{{url('findex/registration')}}" class="registered">注册</a>
		@endif
	</div>
	<div class="mWd">
		<div class="title">欢迎来到绵阳航天军民融合服务平台
		</div>
		<div class="service">
			客服电话：0816-2263966
		</div>
	</div>
</div>
<div class="mBg"></div>
