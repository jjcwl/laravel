<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>绵阳航天军民融合服务平台介绍</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<link rel="stylesheet" href="{{ asset('index/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('index/css/myht.css') }}">
	<link rel="stylesheet" href="{{ asset('index/css/style.css') }}">
	<link type="text/css" href="http://888.gtimg.com/css/v1.0/qqcaipiao/cp_party_effect.css" rel="stylesheet"/>
	<script src="{{ asset('index/js/jquery.min.js') }}"></script>
	<script src="{{ asset('index/js/bootstrap.min.js') }}"></script>
	<style type="text/css">
		.bannerout-scroll {width:100%;height:300px;overflow:hidden;}
		.banner-scroll {width:100%;height:100%;background-size:100%;animation: am 6s linear infinite alternate 1s;overflow:hidden;}
		 @keyframes am {0%{transform: scale(1);-webkit-transform: scale(1);}100%{transform: scale(1.2);-webkit-transform: scale(1.2);}}     
		.aboutUsBar {width:80%;margin:20px auto;}
		.contents-head {border-bottom:1px solid #e1e3e5;line-height:50px;margin-top:30px;}
		.contents-head h1 {font-size: 24px;font-weight: bold;display: inline-block;vertical-align: top;}
		.aboutContent {font-size: 16px;line-height:2.2;color: #323232;padding-top: 30px;padding-bottom: 5px;text-align: justify;overflow:hidden;}
		.aboutContent .jpysbox {width:50%;float:left;margin:0 15px 15px 0;font-size:14px;line-height:1.7;}
		.aboutContent .jpysbox img {width:100%;margin-bottom:10px;}
		.aboutuscontent {width:45%;height:360px;float:right;border-left:1px solid #ddd;padding-left:4.9%;text-indent:2em;}
		.service {text-align:center;margin-top:20px;}
		.service img {width:80%;}
		.milestones {margin-left:35px;padding-top: 35px;}
		.milestones .stones {font-size: 14px;padding-bottom: 8px;padding-top: 75px;border-left: 1px solid #969799;position: relative;}
		.stones p:before {content: '';width: 15px;height: 15px;display: block;position: absolute;left: -8px;top: 9px;background: #969799;
			border-radius: 50%;border: 4px solid #fff;box-sizing: border-box;}
		.stones .date {background: #969799;border-radius: 50%;text-align: center;width: 50px;height: 50px;line-height: 50px;color: #fff;
			position: absolute;left: -25px;top: 0;}
		.milestones .stones p {padding-left: 25px;line-height: 45px;position: relative;font-size:18px;}
		@media screen and ( max-width: 769px ){
			.contents-head {margin-top:20px;}
			.banner-scroll {height:160px;}
			.aboutUsBar {width:90%;}
			.service img {width:100%;}
			.aboutContent .jpysbox {margin-bottom:5px;}
			.aboutContent,.milestones .stones p {font-size:16px;}
			.aboutuscontent {width:100%;height:auto;float:none;border-left:none;padding-left:0;}
			.aboutContent .jpysbox {width:100%;}
		}
	</style>
</head>
<body>
<!-- 头部 -->
@include('findex/header')
@include('findex/mobile')
<div class="bannerout-scroll">
	<div class="banner-scroll" style="background:url({{ asset('index/image/banner.jpg') }}) center center no-repeat;"></div>
</div>

<div class="aboutUsBar">
	<div class="contents-head"><h1>简介</h1></div>
    <div class="aboutContent">
    <div class="jpysbox">
    <img src="{{ asset('index/image/aboutus_pic1.jpg') }}" />
    <p>上图为中国航天科工集团三院副院长徐涛、中国工程院刘永才院士、绵阳市委副书记、代市长元方、四川省国防科工办副主任施遐、航天科工集团310所所长谷满仓、科创区党工委书记周钰、航天科工集团三院产业部副部长王晓东、国防科技大学、航天科工集团310所总师桂立昌为成果转化基地揭牌</p>
    </div>
    <div class="aboutuscontent">绵阳航天军民融合服务平台由航天军民融合成果转化基地（四川）建设运营；航天军民融合成果转化基地（四川）是由中国航天科工集团第三研究院第三一〇研究所与绵阳科教创业园区管理委员会共同建立，由四川航科易知科技有限公司运营管理。基地依托航天科工集团强大的军工资源和地方政府的大力支持以及企业的参与，进行军转民、民参军服务；依托航天云网建设军民融合成果转化服务平台，提供科研成果发布，产品、技术、人才等供求信息以及技术成果交易、投融资、全球知识产权检索、情报分析等服务。基地还将通过落地实施成果转化项目、建立航天军民融合产为基金、建设军民融合产业园等方式，助力地方科技和经济发展。</div>
    </div><!--aboutcontent-->
    <div class="contents-head"><h1>基地服务</h1></div>
    <div class="service">
    	<img src="{{ asset('index/image/aboutus_pic2.gif') }}" />
    </div>
    <div class="contents-head"><h1>大事记</h1></div>
    <div class="milestones">
    	 <div class="stones">
         	<p>2018年11月：环球嘉年华文化旅游综合体项目对接</p>
            <p>2018年11月：中装融合直升机项目北京对接交流</p>
            <p>2018年10月：中兴智慧产业园深圳对接</p>
            <p>2018年9月：中航国际未来城项目对接</p>
            <p>2018年9月：半导体薄膜项目三台对接</p>
            <p>2018年9月：航天科工资产管理公司交流会</p>
            <p>2018年9月：航天科工高速列车项目德阳对接</p>
            <p>2018年9月：人社部和绵阳市政府主办的科技人才交流活动项目路演</p>
            <p>2018年9月：超威锂电池项目组绵阳考察交流</p>
            <p>2018年9月：与德阳中江丰泰科技企业孵化器开展合作交流</p>
            <p>2018年8月：联系航天科工集团参加科技城国际科技博览会</p>
            <p>2018年8月：与航天云网签署项目合作协议</p>
            <p>2018年8月：航天云网、国安启祥绵阳数据中心合作项目讨论会</p>
            <p>2018年7月：接待国防科工局专家组一行在绵专项调研</p>
            <p>2018年7月：气凝胶首条全自动生产线项目绵阳考察</p>
            <p>2018年6月：出席航天科工2018工业互联网高峰论坛</p>
            <p>2018年6月：2018沪绵军民融合金融-人才对接会项目路演</p>
            <p>2018年6月：航天科工卫星应用、自主可控设备采购等项目对接</p>
            <p>2018年6月：航天军民融合第三批成果转化项目发布</p>
            <p>2018年5月：江西赣州稀金谷大数据平台项目商谈</p>
            <p>2018年5月：12寸半导体级硅晶片项目说明会在桃花岛顺利举行</p>
            <p>2018年4月：绵阳教育系统人脸识别项目正式启动</p>
            <p>2018年4月：与长虹电源公司对接相变材料应用项目</p>
            <p>2018年3月：中农城投项目绵阳考察交流</p>
            <p>2018年3月：中电信息绵阳军民融合产业考察及战略合作</p>
            <p>2018年3月：航天军民融合第二批成果转化项目发布</p>
        </div>
        <div class="stones">
            <div class="date">2017</div>
            <p>2017年12月：与九洲集团对接航天技术合作</p>    
            <p>2017年11月：航天军民融合首批成果转化项目发布</p>    
            <p>2017年10月：航天导弹总体专业情报网学术研讨会成功举办</p>
            <p>2017年10月：航天军民融合成果转化基地（四川）揭牌</p>
        </div>
    </div>
</div><!--aboutUsBar-->

<!-- 基地介绍 -->
<!--div class="container-fluid">
	<div class="col-md-10 col-md-offset-1 col-xs-12 inves">
		<div class="container-fluid pageTitle">
			<div class="col-md-1 col-xs-1 invesesicon"><img src="{{ asset('index/image/icon_build.png') }}"></div>
			<div class="col-md-2 col-xs-4 investitle"><span>基地介绍</span></div>
			<div class="col-md-9 col-xs-7 invesline"></div>
			
		</div>
	</div>
	<div class=" col-md-10  col-md-offset-1 col-xs-12 base">
		<div class="col-md-6 col-xs-12  baseimg">
			<img src="{{asset('uploads'.'/'.$base->photo) }}">
		</div>
		<div class="col-md-6  col-xs-12 basecon">
			<div class="basecon1"><'?php
                     echo html_entity_decode($base->content);
                ?></div>
			<div class="basecon2"></div>
		</div>
	</div>
	
</div-->
<!-- 尾部 -->
<div class="container-fluid">
@include('findex/foot')
</div>
</body>
<script src="{{ asset('index/js/myht.js') }}"></script>
</html>