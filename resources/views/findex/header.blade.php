<div class="top container-fluid">
	<div class="col-md-6 col-md-offset-1 col-xs-7">
		<span class="title">欢迎来到绵阳航天军民融合服务平台</span>
		<span class="service">客服电话：0816-2263966</span>
	</div>
	<div class="col-md-1 col-xs-2 abc">
		<a href="#" class="moblie">手机端</a>
	</div>
	<div class="col-md-3 col-xs-2  zxc " >
		@if(Session::get('id'))
		<div style="padding-right: 15px;">欢迎你,{{Session::get('name')}}</div>
		<a href="{{url('findex/collection')}}" class="login">个人中心</a>
		@else
		<a href="{{url('findex/login')}}" class="login">登录</a>
		<a href="{{url('findex/registration')}}" class="registered">注册</a>
		@endif
		
	</div>
</div>
<!-- logo -->
<div class="logo container-fluid">
	<div class="logoimg col-md-4 col-md-offset-1 col-xs-5">
		<a href="{{url('/')}}"><img src="{{ asset('index/image/logo.png') }}"></a>
	</div>
	<form class="col-md-5 col-xs-6">
		<div class="container-fluid">
			<div class="search col-md-8 col-xs-8">
				<select class="selectRea" name="sel">
			         <option value="1">项目</option>
			         <option value="2">需求</option>
			         <option value="3">企业</option>
				</select>
				<input type="text" class="searchText" name="aname">
			</div>
			<div class="col-md-2 col-xs-4">
				<input type="submit" class="searchSub" name="sub" value="搜索">
			</div>
		</div>
	</form>
	<div class=" codes col-md-1" >
		<img src="{{ asset('index/image/ic_wechat.jpg') }}" class="code">
	</div>
	
</div>
<!-- 导航 -->
<div class="nav container-fluid">
	<div class="col-md-10 col-md-offset-1 navs">
		<a class="navigation navigationBorder" href="{{url('/')}}">首页</a>
		<a class="navigation" href="{{url('findex/base')}}">关于我们</a>
		<a class="navigation" href="{{url('findex/project')}}">项目库</a>
		<a class="navigation" href="{{url('findex/requirement')}}">需求信息</a>
		<a class="navigation" href="http://www.innojoy.com/account/login2.html?idEMail=wxbxian@126.com&idPassword=123456">专利大数据</a>
		<a class="navigation" href="{{url('findex/investment')}}">投融资服务</a>
		<a class="navigation" href="{{url('findex/information')}}">资讯热点</a>
		<a class="navigation" href="{{url('findex/enterprise')}}">企业名录</a>
		<a class="navigation" href="{{url('findex/download')}}">资料下载</a>
	</div>
</div>

