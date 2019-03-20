// 首页


$(".zxc a").click(function(){
	$(this).addClass('color').siblings().removeClass('color');
});
$(".abc a").click(function(){
	$(this).addClass('col').siblings().removeClass('col');
});
$(".searchSub").click(function(){
	$(this).addClass('searchcolor').siblings().removeClass('searchcolor');
});
$(".more").click(function(){
	$(this).addClass('morecolor').siblings().removeClass('morecolor');
});
$(".mores").click(function(){
	$(this).addClass('morescolor').siblings().removeClass('morescolor');
});
$(".look").click(function(){
	$(this).addClass('lookcolor').siblings().removeClass('lookcolor');
});
$(".information").click(function(){
	$(this).addClass('informationcolor').siblings().removeClass('informationcolor');
});

//项目库选项卡
$(".projects:not(:first)").hide();
$(".projectSubmit:first").addClass("projectSubmitcolor");
$(".projectSubmit").click(function(){
$(this).addClass("projectSubmitcolor").siblings().removeClass("projectSubmitcolor");
var num=$(this).index();
$(".projects").eq(num).show().siblings().hide();
});
//需求信息选项卡
$(".demandinformation:not(:first)").hide();
$(".projectsSubmit:first").addClass("projectsSubmitcolor");
$(".projectsSubmit").click(function(){
$(this).addClass("projectsSubmitcolor").siblings().removeClass("projectsSubmitcolor");
var num=$(this).index();
$(".demandinformation").eq(num).show().siblings().hide();
});
//下载专区文字点击变色
$(".img2").hide();
$(".dowinformationimg").click(function(){
	$(this).css('color','#043477').parents(".downloadNew").siblings().find(".dowinformationimg").css('color','#333');
	$(this).siblings(".dowImg").find("img").toggle();
})

//下载专区鼠标悬浮变色 换图片
//选项卡变色
$(".downloadTit").hover(function(){
     $(this).addClass("downloadcolor").siblings().removeClass("downloadcolor");
     var color=$(this).index();
     $(".downloadCon").eq(color).show().siblings().hide();
},function(){
     var color=$(this).index();
     $(".downloadCon").eq(color).show().siblings().hide();
});
//文字变色
$(".dowinformationimg").hover(function(){
	$(this).css('color','#043477').parents(".downloadNew").siblings().find(".dowinformationimg").css('color','#333');
	$(this).parent().find(".img1").hide();
	$(this).parent().find(".img2").show();
},function(){
	$(this).css('color','#333').parents(".downloadNew").siblings().find(".dowinformationimg").css('color','#043477');
	    $(this).parent().find(".img1").show();
		$(this).parent().find(".img2").hide();
	})

//导航点击加下划线
// $(".navigation:first").addClass("navigationBorder");
// $(".navigation").click(function(){
// 	$(this).addClass('navigationBorder').siblings().removeClass('navigationBorder');
// });
//工作动态选项卡
$(".contentTab:not(:first)").hide();
$(".dynamicbut:first").addClass("contentcolor");
$(".dynamicbut").click(function(){
$(this).addClass("contentcolor").siblings().removeClass("contentcolor");
var num=$(this).index();
$(".contentTab").eq(num).show().siblings().hide();
});
//工作动态鼠标悬浮变色
//选项卡变色
$(".dynamicbut").hover(function(){
     $(this).addClass("contentcolor").siblings().removeClass("contentcolor");
     var color=$(this).index();
     $(".contentTab").eq(color).show().siblings().hide();
},function(){
     var color=$(this).index();
     $(".contentTab").eq(color).show().siblings().hide();
});
//下载专区选项卡
$(".downloadCon:not(:first)").hide();
$(".downloadTit:first").addClass("downloadcolor");
$(".downloadTit").click(function(){
$(this).addClass("downloadcolor").siblings().removeClass("downloadcolor");
var color=$(this).index();
$(".downloadCon").eq(color).show().siblings().hide();
});


//点击下载特效
$(".dowNew span").hide();
$(".dowImg img").hover(function(){
	$(this).parents(".downloadNew").find(".dowNew span").show();
	},function(){
		$(this).parents(".downloadNew").find(".dowNew span").hide();
	})
//点击下载特效
$(".dowNews span").hide();
$(".dowImg img").hover(function(){
	$(this).parents(".downloadNew").find(".dowNews span").show();
	},function(){
		$(this).parents(".downloadNew").find(".dowNews span").hide();
	})


//去掉点击下划线
$("a").click(function(){
	$(this).css("text-decoration","none")
})

// 需求页面

//需求点击特效
$(".enterbut").click(function(){
	$(this).addClass('enterbutcolor').siblings().removeClass('enterbutcolor');
});
$(".enterbuts").click(function(){
	$(this).addClass('enterbutcolor').siblings().removeClass('enterbutcolor');
});
$(".enterone").click(function(){
	$(this).addClass('enteronecolor').siblings().removeClass('enteronecolor');
});
$(".enternext").click(function(){
	$(this).addClass('enteronecolor').siblings().removeClass('enteronecolor');
});
$(".enterpise").click(function(){
	$(this).addClass('enterpisecolor').siblings().removeClass('enterpisecolor');
});
$(".requirement").hover(function(){
	$(this).addClass('enterpisecolor').siblings().removeClass('enterpisecolor');
});

$(".enterpise").hover(function(){
	$(this).addClass('enterpisecolor').siblings().removeClass('enterpisecolor');
});

$(".collborders").hover(function(){
	$(this).addClass('enterpisecolor').siblings().removeClass('enterpisecolor');
});
//需求选项卡
$(".enterprisetab:not(:first)").hide();
$(".entertabs:first").addClass("enterprisecolor");
$(".entertabs").click(function(){
$(this).addClass("enterprisecolor").siblings().removeClass("enterprisecolor");
var color=$(this).index();
$(".enterprisetab").eq(color).show().siblings().hide();
});

//企业名录页面


//企业名录选项卡
$(".requements:not(:first)").hide();
$(".entertabs:first").addClass("enterprisecolor");
$(".entertabs").click(function(){
$(this).addClass("enterprisecolor").siblings().removeClass("enterprisecolor");
var color=$(this).index();
$(".requements").eq(color).show().siblings().hide();
});
//企业名录点击特效
$(".requirement").click(function(){
	$(this).addClass('enterpisecolor').siblings().removeClass('enterpisecolor');
});

 // $(".en div").mouseover(function(){
 //    $(this).addClass("enterbutcolor").siblings().removeClass("enterbutcolor")
 //    })



//下载专区页面

//选项卡切换
$(".downloadCon:not(:first)").hide();
$(".downloadsTit:first").addClass("downloadscolor");
$(".downloadsTit").click(function(){
$(this).addClass("downloadscolor").siblings().removeClass("downloadscolor");
var color=$(this).index();
$(".downloadCon").eq(color).show().siblings().hide();
});

//企业详情页面
$(".prodetabs:not(:first)").hide();
$(".prodetab:first").addClass("prodetabscolor");
$(".prodetab").click(function(){
$(this).addClass("prodetabscolor").siblings().removeClass("prodetabscolor");
var color=$(this).index();
$(".prodetabs").eq(color).show().siblings().hide();
});

//项目详情页面
$(".prodeborders:not(:first)").hide();
$(".prodetab:first").addClass("prodetabscolor");
$(".prodetab").click(function(){
$(this).addClass("prodetabscolor").siblings().removeClass("prodetabscolor");
var color=$(this).index();
 $(".prodeborders").eq(color).show().siblings().hide();
});

//注册页面选项卡
$(".registab:not(:first)").hide();
$(".regitabs:first").addClass("regetabscolor");
$(".regitabs").click(function(){
$(this).addClass("regetabscolor").siblings().removeClass("regetabscolor");
var color=$(this).index();
$(".registab").eq(color).show().siblings().hide();
});

//个人中心选项卡
$(".colltab:not(:first)").hide();
$(".downloadsTit:first").addClass("downloadscolor");
$(".downloadsTit").click(function(){
$(this).addClass("downloadscolor").siblings().removeClass("downloadscolor");
var color=$(this).index();
$(".colltab").eq(color).show().siblings().hide();
});

$(function(){
	//获取div下面所有的a标签（返回节点对象）
	var myNav = document.getElementsByClassName("navs")[0].getElementsByTagName("a");
	//获取当前窗口的url
	var myURL = document.location.href;
	//循环div下面所有的链接，
	for(var i=1;i<myNav.length;i++){
	//获取每一个a标签的herf属性
	  var links = myNav[i].getAttribute("href");
	  var myURL = document.location.href;
	  myURL = myURL.toString();
	  links = links.toString();
	  myURL = myURL.split('_')[0];
	  console.log(myURL);
	  console.log(links);
	  //查看div下的链接是否包含当前窗口，如果存在，则给其添加样式
	  if(myURL === links || links.indexOf(myURL) != -1 || myURL.indexOf(links) != -1){
	  	//换成首页地址
	  	if(myURL != 'http://www.htjmrh.cn/'){
		  	$('.navs a').eq(i).addClass('navigationBorder');
		  	$('.navs a').eq(i).siblings().removeClass('navigationBorder');
	  	}
	   }
	}
})
	