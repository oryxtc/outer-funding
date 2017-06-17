document.writeln("");
$(document).ready(function(){

	// 头部小图标效果
	$(".top1_list li").hover(function(){		
			$(this).find("img").animate({top:"-40px"},200);
	},function(){
		$(this).find("img").animate({top:"0px"},200);
	});
	
	// 头部微信效果
	$("#top_wx1").mouseover(function(){
		$(".top1_wx1").slideDown(500);
	});		
	
	$(".top2,.top3,top4").mouseover(function(){
		$(".top1_wx1").slideUp(500);
	});	
	$(".top1_list li").not("#top_wx1").mouseover(function(){
		$(".top1_wx1").slideUp(500);
	});
	
	
	$("#top_wx2").mouseover(function(){
		$(".top1_wx2").slideDown(500);
	});	
	
	$(".top2,.top3,top4").mouseover(function(){
		$(".top1_wx2").slideUp(500);
	});	
	$(".top1_list li").not("#top_wx2").mouseover(function(){
		$(".top1_wx2").slideUp(500);
	});	
	
	// 快速通道 效果
	$(".m2td_iconlinks a").each(function(index){
		if(index==0){
			$(this).hover(function(){
				$(".m2td_phone").show(500);
				//$(".m2td_iconlinks").css("display","none");
			});
		}else if(index==2){
			$(this).hover(function(){
				$(".m2td_wx").show(500);
			});
		}
	});
	
	$(".m2td_phone").mouseleave(function(){
		//$(".m2td_iconlinks").css("display","block");
		$(this).hide(500);
	});
	$(".m2td_wx").mouseleave(function(){
		//$(".m2td_iconlinks").css("display","block");
		$(this).hide(500);
	});
	
	
	// 为当前页面添加属性
	var url=window.location.href;
	$(".lycenL_2").find("a").each(function(){				
		//if($(this).attr("href")==url){
		// 这里使用字符串匹配，考虑到分页的情况。
		if(url.indexOf($(this).attr("href"))>=0){					
			$(this).addClass("hover");
		}else{
			$(this).removeClass("hover");
		}
	});

	//左边几个咨询按钮动画
	$(".lycenL_3 ul li").each(function(){
	  $(this).hover(function(){
		$(this).find("a").animate({top:"-50px"},200);
		},function(){
		$(this).find("a").animate({top:"0px"},200);
			})
	});
	
	
	// 导航菜单效果
	$(".top3_nav li").hover(function(){
		$(this).find(".top3_popnav").css("display","block");
	},function(){
		$(this).find(".top3_popnav").css("display","none");
	});
	
	
	$(".in_yyhja2 div").mouseover(function(){
		$(this).stop().animate({"top":"-138px"},50); 
	  })
	$(".in_yyhja2 div").mouseout(function(){
		$(this).stop().animate({"top":"0"},50); 
	})
	
	$(".in_yyhja4 div").mouseover(function(){
		$(this).stop().animate({"top":"-290px"},50); 
	  })
	$(".in_yyhja4 div").mouseout(function(){
		$(this).stop().animate({"top":"0"},50); 
	})
		
	//底部几个咨询按钮动画
	$("#foot_zximg ul li").each(function(){
	  $(this).hover(function(){
		$(this).find(".foot_zximg").animate({top:"-28px"},200);
	  },function(){
		$(this).find(".foot_zximg").animate({top:"0px"},200);
	  });
	});
	//首页BANNER下几个咨询按钮动画
	$(".top5_links ul li").each(function(){
	  $(this).hover(function(){
		$(this).find("a").animate({top:"-70px"},150);
	  },function(){
		$(this).find("a").animate({top:"0px"},150);
	  });
	});
	
	//首页底部滑出微信二维码
	$("#foot_wx_tc").hover(function(){
		$(".foot_1_wx").slideDown(1000);
	},function(){
		$(".foot_1_wx").slideUp(1000);
	});
	
	//首页友情链接滑块
	$(".in_link_1 ul li").click(function(){
		var tid = $(this).attr("id");		
		$(this).addClass("hover").siblings("li").removeClass("hover");		
		$(".in_link_2").hide();
		$("#"+tid+"_").show();		
	});
	
	//技术优势滑块1
	$(".nyjs_listhk ul li").hover(function(){
		var tid = $(this).attr("id");		
		$(this).addClass("hover").siblings("li").removeClass("hover");		
		$(".nyjshk").hide();
		$("#"+tid+"_").show();		
	});
	//技术优势滑块2
	$(".nyjs_listhka ul li").hover(function(){
		var tid = $(this).attr("id");		
		$(this).addClass("hover").siblings("li").removeClass("hover");		
		$(".nyjshka").hide();
		$("#"+tid+"_").show();		
	});
	//技术优势滑块3
	$(".nyjs_listhkb ul li").hover(function(){
		var tid = $(this).attr("id");		
		$(this).addClass("hover").siblings("li").removeClass("hover");		
		$(".nyjshkb").hide();
		$("#"+tid+"_").show();		
	});
	//技术优势滑块3
	$(".nyjs_listhkc ul li").hover(function(){
		var tid = $(this).attr("id");		
		$(this).addClass("hover").siblings("li").removeClass("hover");		
		$(".nyjshkc").hide();
		$("#"+tid+"_").show();		
	});
	//技术优势滑块3
	$(".nyjs_listhkd ul li").hover(function(){
		var tid = $(this).attr("id");		
		$(this).addClass("hover").siblings("li").removeClass("hover");		
		$(".nyjshkd").hide();
		$("#"+tid+"_").show();		
	});
	//技术优势滑块3
	$(".nyjs_listhke ul li").hover(function(){
		var tid = $(this).attr("id");		
		$(this).addClass("hover").siblings("li").removeClass("hover");		
		$(".nyjshke").hide();
		$("#"+tid+"_").show();		
	});
	//技术优势滑块3
	$(".nyjs_listhkf ul li").hover(function(){
		var tid = $(this).attr("id");		
		$(this).addClass("hover").siblings("li").removeClass("hover");		
		$(".nyjshkf").hide();
		$("#"+tid+"_").show();		
	});
	//技术优势滑块3
	$(".nyjs_listhkg ul li").hover(function(){
		var tid = $(this).attr("id");		
		$(this).addClass("hover").siblings("li").removeClass("hover");		
		$(".nyjshkg").hide();
		$("#"+tid+"_").show();		
	});
	
	//技术优势滑块4
	$(".nyjs_listbyk ul li").hover(function(){
		var tid = $(this).attr("id");		
		$(this).addClass("hover").siblings("li").removeClass("hover");		
		$(".nyjsbyk").hide();
		$("#"+tid+"_").show();		
	});	
	//技术优势滑块5
	$(".nyjs_listzxk ul li").hover(function(){
		var tid = $(this).attr("id");		
		$(this).addClass("hover").siblings("li").removeClass("hover");		
		$(".nyjszxk").hide();
		$("#"+tid+"_").show();		
	});		
	
	//挂号页面tab
	$(".yygh_page3 ul li").hover(function(){
		var tid = $(this).attr("id");		
		$(this).addClass("hover").siblings("li").removeClass("hover");		
		$(".yygh_page4").hide();
		$("#"+tid+"_").show();		
	});
	
	// 频道页效果
	// 频道快速通道效果	
	$("#cat1R_wx").hover(function(){
		$(".cat1R_wx").show("fast");
	});
	$(".cat1R_wx").mouseleave(function(){
		$(this).hide("fast");
	});
	
	var bottomHeight = $(document).height()-$(window).height()-199;
	//简介旁边NAV添加浮动
	$(window).scroll(function() {
		var scrolltop = $(window).scrollTop();
		if (scrolltop >= 510 && scrolltop<bottomHeight) {
			$(".lycen_L").addClass("fixed");
		} else if(scrolltop <510) {
			$(".lycen_L").removeClass("fixed");
			$(".lycen_L").removeClass("bottom");
		}else if(scrolltop>bottomHeight){
			$(".lycen_L").removeClass("fixed");
			$(".lycen_L").addClass("bottom");
			$(".lycen_L").css("bottom","245px");
			//$(".lycen_L").animate({bottom:"245px"},100);
		}
	});
	
	// 内容页右边浮动
/*	$(window).scroll(function() {
		var scrolltop = $(window).scrollTop();
		if (scrolltop >= 510 && scrolltop<bottomHeight) {
			$(".newsShowR").addClass("fixed");
		}else if(scrolltop <510) {
			$(".newsShowR").removeClass("fixed");
			$(".newsShowR").removeClass("bottom");
		}else if(scrolltop>bottomHeight){
			$(".newsShowR").removeClass("fixed");
			$(".newsShowR").addClass("bottom");
			$(".newsShowR").css("bottom","245px");
			//$(".newsShowR").animate({bottom:"245px"},100);
		}
	});*/
	
	// 大事记 切换效果
	$(".djs_1a").each(function(){
		$(this).click(function(){
			var id=$(".djs_1a").index($(this));
			$(".djs_2 ul li").css("display","none");
			$(".djs_2 ul li:eq("+id+")").css("display","block");
			$(".djs_1a").removeClass("hover");
			$(this).addClass("hover");
		});
	});
	
  
   
	
	//专题汇总滑块
	$(".zthzy_1 ul li").hover(function(){
		var tid = $(this).attr("id");		
		$(this).addClass("hover").siblings("li").removeClass("hover");		
		$(".zthzy_2").hide();
		$("#"+tid+"_").show();		
	});
	
	// 环境展示 的图集特效
	picNav("huanjing_box","huanjing_jieshao","rydaohang",-51);
	// 荣誉页面 的图片导航特效
	picNav("rongyu_list","rongyu_jieshao","rydaohang");
	//picNav  begin
	function picNav(box,info,nav, marginVal){
	var boxClass="."+box;
	var infoClass="."+info;
	var navClass="."+nav;
	
	$(boxClass).mouseover(function(){
		if(info!='null'){
			// 变字体颜色 和 背景颜色
			$(this).find(infoClass).css("color","#FFFFFF");
			$(this).find(infoClass).css("background-color","#c13145");
		}

		// 让小的导航图片居中
		var leftVal=$(this).width()/2;
		leftVal= leftVal -$(this).children(navClass).width()/2;
		leftVal= Math.ceil(leftVal);
		$(this).children(navClass).css("left",leftVal+"px");

		//alert(leftVal);
		
		// 计算top的值
		var topVal=0;
		if(info!='null'){
			topVal = topVal + $(this).find(infoClass).innerHeight();		
		}
		topVal= topVal + $(this).find("img").innerHeight()/2;
		topVal= topVal + $(this).children(navClass).innerHeight()/2;
		topVal= Math.ceil(topVal);		
		topVal= topVal + (marginVal?marginVal:0);	// 如果弹出的导航框做了margin处理时，加上margin值。
		
		$(this).children(navClass).animate({top:"-"+topVal+"px"},{queue: false, duration: 350 });
	});	
	
	$(boxClass).mouseleave(function(){		
		$(this).children(navClass).animate({top:"0px"},{queue: false, duration: 350 });
		if(info!='null'){
			$(this).find(infoClass).css("color","#333333");
			$(this).find(infoClass).css("background-color","#E5E5E5");
		}		
	});	
   }
   //picNav end
	
});

//commmon



