<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>网站正在建议中</title>
<link rel="stylesheet" href="{{ asset('index/style.css') }}" type="text/css" />
	<!--[if lt IE 8]>
		<script src="http://ie7-js.googlecode.com/svn/version/2.0(beta3)/IE8.js" type="text/javascript"></script>
	<![endif]-->
	
	<!--[if IE]>
		<link rel="stylesheet" href="ie.css" type="text/css" />
	<![endif]-->
	


</head>


<body>

<div id="header"> <!-- start header -->
	<a href="{{url('/')}}"><img src="{{ asset('index/image/logo.png') }}" alt="Your Company Logo" id="logo" /></a>

	<ul> 
		<li>联系人:焦健</li> <!-- enter your details here -->
		<li>联系电话: 010-68376645</li> <!-- enter your details here -->
		<li>邮箱: luke@titaniumfish.com</li> <!-- enter your details here -->
	</ul>
</div> <!-- end header -->



<div id="main"> <!-- start main -->
	<div id="message"> <!-- start message -->
		<img src="{{ asset('index/img/sorry.png') }}" alt="Sorry!" id="sorry" width="347" height="72" />
		<p>我们的网站正在开发</p> <!-- you can enter your own customised message here -->
		<p>但是我们会很快完成!</p>
	</div> <!-- end message -->

	<div id="progress" class="progress70"> <!-- change this to 'progressXX' to change the progress bar (where XX is either 10, 20, 30... 100) -->
	</div>

	<p id="completion">我们完成了大约70%!</p> <!-- change this to state the % completed -->
</div> <!-- end main -->



<div id="tweet_wrap"> <!-- start tweet_wrap -->
	<div id="twitterLogo"></div>

	<div id="tweet"> <!-- start tweet -->	
		<img src="{{ asset('index/img/loading.gif') }}" alt="loading..." class="loading"/>
	</div> <!-- end tweet -->
</div> <!-- end tweet_wrap -->

</body>
</html>
