// JavaScript Document
$(function () {
    var mySwiper2, mySwiper3;

    /*显示白色头部导航实现切换效果*/
    $(".navg_head_zx>ul>li").mouseenter(function () {
        var thisdom = $(this);
        var indexdom = $(".navg_head_zx>ul>li").index(thisdom);
        if (indexdom == 0) return;
        $(".down_arrow").hide();
        $(".navg_head_zx>ul>li").css("border-bottom", "0");
        $(".navg_xm_zx>div[class^=xm]").hide();
        if ($($(".navg_xm_zx>div[class^=xm]").get(indexdom - 1)).find("ul>li").length) {
//                thisdom.css("border-bottom", "1px solid #c70025");
            $($(".xiangmu_zx").get(indexdom)).next(".down_arrow").show();
            $($(".navg_xm_zx>div[class^=xm]").get(indexdom - 1)).css("display", "inline-block");
            // $(".navg_xm_zx").slideDown(500, "linear");
		    $(".navg_xm_zx").show();
        } else {
            $(".navg_head_zx>ul>li").css("border", 0);
        }

    });
    /*鼠标移出时隐藏效果实现*/
    $(".cont_head_zx").mouseleave(function () {
        $(".navg_xm_zx").slideUp(500, "swing", function () {
            $(".navg_head_zx>ul>li").css("border-bottom", "0");
            $(".down_arrow").hide();
        });
    });
	$(".xm_myhs").mouseenter(function(){
		$(".navg_xm_zx").slideUp(500, "swing", function () {
            $(".navg_head_zx>ul>li").css("border-bottom", "0");
            $(".down_arrow").hide();
        });
		})
    /*中部科室导航*/
    $(".xm_navg>ul>li>div").mouseenter(function () {
        var thisdom = $(this);
        var index = $(".xm_navg>ul>li>div").index(thisdom);
        $(".xm_navg>ul>li>div").removeClass("active");
        thisdom.addClass("active");
        $("div[class^=zxm_list_]").hide();
        $(".zxm_list_" + (index + 1)).css("display", "inline-block");
        $(".zxm_navg").slideDown();
    });
    $(".navg").mouseleave(function () {
        $(".xm_navg>ul>li>div").removeClass("active");
        $(".zxm_navg").hide();
    });

    /*最先动态切换效果*/
    $(".navg_news>ul>li").mouseenter(function () {
        var thisdom = $(this);
        var index = $(".navg_news>ul>li").index(thisdom);
        $(".navg_news>ul>li").removeClass("active");
        thisdom.addClass("active");
        $("div[class^=banner_]").hide();
        $($("div[class^=banner_]").get(index)).show();
        /*切换到当前分类的时候，生成资讯切换效果（siwper.js只对显示的dom元素起作用，对隐藏的dom元素无法绑定切换效果）*/
        if (index == 1) {
            if (!mySwiper2) {
                mySwiper2 = new Swiper('.swiper-container.zmm', {
                    slidesPerView: 3,
                    paginationClickable: true,
                    spaceBetween: 30,
                    // 如果需要前进后退按钮
                    nextButton: '.prev_bott.zmm',
                    prevButton: '.next_bott.zmm'
                });
            }
        } else if (index == 2) {
            if (!mySwiper3) {
                mySwiper3 = new Swiper('.swiper-container.tcyh', {
                    slidesPerView: 3,
                    paginationClickable: true,
                    spaceBetween: 30,
                    // 如果需要前进后退按钮
                    nextButton: '.prev_bott.tcyh',
                    prevButton: '.next_bott.tcyh'
                });
            }
        }
    });

    var swiperks = [];//科室专家切换
    /*科室专家交互*/
    $("#keshizj").change(function(){
        var ksid = $(this).val();
        $(".conn_zjtd").hide();
        $(".navg_zjtd").hide();
        $($(".conn_zjtd").get(ksid)).show();
        $($(".navg_zjtd").get(ksid)).show();
        if(ksid==1&&swiperks[ksid]==null){
            var swiperks1 = new Swiper(".swiper-container.zjtd16",{
               autoplay:3000,
                slideToClickedSlide:true,
                slidesPerView: 5,
                paginationClickable: true,
                spaceBetween: 10,
                prevButton:'.swiper-button-prev.zjtd16',
                nextButton:'.swiper-button-next.zjtd16'
            });
        }else if(ksid==2&&swiperks[ksid]==null){
            swiperks[ksid] = new Swiper(".swiper-container.zjtd16",{
                autoplay:3000,
                slideToClickedSlide:true,
                slidesPerView: 5,
                paginationClickable: true,
                spaceBetween: 10,
                prevButton:'.swiper-button-prev.zjtd16',
                nextButton:'.swiper-button-next.zjtd16'
            });
        }else if(ksid==3&&swiperks[ksid]==null){
            swiperks[ksid] = new Swiper(".swiper-container.zjtd16",{
                autoplay:3000,
                slideToClickedSlide:true,
                slidesPerView: 5,
                paginationClickable: true,
                spaceBetween: 10,
                prevButton:'.swiper-button-prev.zjtd16',
                nextButton:'.swiper-button-next.zjtd16'
            });
        }else if(ksid==4&&swiperks[ksid]==null){
            swiperks[ksid] = new Swiper(".swiper-container.zjtd16",{
                autoplay:3000,
                slideToClickedSlide:true,
                slidesPerView: 5,
                paginationClickable: true,
                spaceBetween: 10,
                prevButton:'.swiper-button-prev.zjtd16',
                nextButton:'.swiper-button-next.zjtd16'
            });

         }else if(ksid==5&&swiperks[ksid]==null){
            swiperks[ksid] = new Swiper(".swiper-container.zjtd16",{
                autoplay:3000,
                slideToClickedSlide:true,
                slidesPerView: 5,
                paginationClickable: true,
                spaceBetween: 10,
                prevButton:'.swiper-button-prev.zjtd16',
                nextButton:'.swiper-button-next.zjtd16'
            });



          }


    });

    var swiperks0 = new Swiper(".swiper-container.zjtd16",{
        autoplay:3000,
        slideToClickedSlide:true,
        slidesPerView: 5,
        paginationClickable: true,
        spaceBetween: 10,
        prevButton:'.swiper-button-prev.zjtd16',
        nextButton:'.swiper-button-next.zjtd16'
    });




    var mySwiper0 = new Swiper('.swiper-container.bann', {
        autoplay: 1,
        speed: 1000,
        paginationClickable: true,
        onTransitionStart: function (swiper) {
            swiper.stopAutoplay();
            $(".logo_press").stop(true, true).delay(3000).animate({width: "100%"}, 10000, function () {
                swiper.startAutoplay();
                $(".logo_press").css("width", 0);
            })
        }
    });

    var mySwiper1 = new Swiper('.swiper-container.news', {
        slidesPerView: 3,
        paginationClickable: true,
        spaceBetween: 30,
        // 如果需要前进后退按钮
        nextButton: '.prev_bott.news',
        prevButton: '.next_bott.news'
    });

    /* 悬浮导航的鼠标hover效果*/
    var xfdhys ;
    $(".xfdh>div").mouseenter(function () {
        clearTimeout(xfdhys);
        $("div[class*=_xf_tc]").removeClass("active");
        $(this).css("overflow","visible");
        $(this).find("div[class$=_xf_tc]").addClass("active");
    });
    $(".xfdh>div").mouseleave(function () {
        var thisdom = $(this);
        $("div[class*=_xf_tc]").removeClass("active");
        xfdhys = setTimeout(function(){
            $(thisdom).css("overflow","hidden");
        },1000)
    });

    var navgzxf = {
        xfswith : false,
        sfbv : $(window).innerWidth()/1650*876,
        heights : $(window).innerHeight(),
        navgdom : $(".navg"),

        //设置悬浮导航
        setNavg:function(){
            navgzxf.navgdom.addClass("navg_xf");
            navgzxf.xfswith = true;
            $(window).scroll(function(){
                var scrollTop = document.documentElement.scrollTop || document.body.scrollTop;
                if((scrollTop+navgzxf.heights-70)>navgzxf.sfbv){
                    if(navgzxf.xfswith){
                        navgzxf.navgdom.removeClass("navg_xf");
                        navgzxf.xfswith = false;
                    }
                }else{
                    if(!navgzxf.xfswith){
                        navgzxf.navgdom.addClass("navg_xf");
                        navgzxf.xfswith = true;
                    }
                }
            });
        },

        //重置参数
        resize:function(){
            this.xfswith = false;
            this.sfbv = $(window).innerWidth()/1650*876;
            this.heights = $(window).innerHeight();
            if(this.heights<(this.sfbv+70)){
                this.setNavg();
            }else{
                this.navgdom.removeClass("navg_xf");
            }
        },

        //初始化导航，并判断是否需要浮动
        init:function(){
            this.resize();
            $(window).resize(function(){
                navgzxf.resize();
            });

        }
    }

    /*中部导航自悬浮*/
    navgzxf.init();

});


/*banner下面导航效果*/
$("#nav01").mouseenter(function(){
			
	$(".bannerfnavtopbox01").toggle();
	})
$("#nav01").mouseleave(function(){
	$(".bannerfnavtopbox01").toggle();
	})
	
$("#nav02").mouseenter(function(){
	$(".bannerfnavtopbox02").toggle();
	})
$("#nav02").mouseleave(function(){
	$(".bannerfnavtopbox02").toggle();
	})
	
$("#nav03").mouseenter(function(){
	$(".bannerfnavtopbox03").toggle();
	})
$("#nav03").mouseleave(function(){
	$(".bannerfnavtopbox03").toggle();
	})
	
$("#nav04").mouseenter(function(){
	$(".bannerfnavtopbox04").toggle();
	})
$("#nav04").mouseleave(function(){
	$(".bannerfnavtopbox04").toggle();
	})
	
	
	
	
/*首页诊疗项目*/
$(".zlxmnavtleft").mouseenter(function(){
	$(".zlxmtunav").toggle();
	})
$(".zlxmnavtleft").mouseleave(function(){
	$(".zlxmtunav").toggle();
	})
	

	
$(".zlxmnav01").mouseenter(function(){
	$(".zlxmnav01").addClass("zlxmcurrter");
	$(".zlxmnav02").removeClass("zlxmcurrter");
	$(".zlxmnav03").removeClass("zlxmcurrter");
	$(".zlxmnav04").removeClass("zlxmcurrter");
	$(".zlxmnav05").removeClass("zlxmcurrter");
	$(".zlxmnavt01").css("display","block");
	$(".zlxmnavt02").css("display","none");
	$(".zlxmnavt03").css("display","none");
	$(".zlxmnavt04").css("display","none");
	$(".zlxmnavt05").css("display","none");
	})
	
$(".zlxmnav02").mouseenter(function(){
	$(".zlxmnav02").addClass("zlxmcurrter");
	$(".zlxmnav01").removeClass("zlxmcurrter");
	$(".zlxmnav03").removeClass("zlxmcurrter");
	$(".zlxmnav04").removeClass("zlxmcurrter");
	$(".zlxmnav05").removeClass("zlxmcurrter");
	$(".zlxmnavt02").css("display","block");
	$(".zlxmnavt01").css("display","none");
	$(".zlxmnavt03").css("display","none");
	$(".zlxmnavt04").css("display","none");
	$(".zlxmnavt05").css("display","none");
	})
	
$(".zlxmnav03").mouseenter(function(){
	$(".zlxmnav03").addClass("zlxmcurrter");
	$(".zlxmnav01").removeClass("zlxmcurrter");
	$(".zlxmnav02").removeClass("zlxmcurrter");
	$(".zlxmnav04").removeClass("zlxmcurrter");
	$(".zlxmnav05").removeClass("zlxmcurrter");
	$(".zlxmnavt03").css("display","block");
	$(".zlxmnavt01").css("display","none");
	$(".zlxmnavt02").css("display","none");
	$(".zlxmnavt04").css("display","none");
	$(".zlxmnavt05").css("display","none");
	})
	
$(".zlxmnav04").mouseenter(function(){
	$(".zlxmnav04").addClass("zlxmcurrter");
	$(".zlxmnav01").removeClass("zlxmcurrter");
	$(".zlxmnav02").removeClass("zlxmcurrter");
	$(".zlxmnav03").removeClass("zlxmcurrter");
	$(".zlxmnav05").removeClass("zlxmcurrter");
	$(".zlxmnavt04").css("display","block");
	$(".zlxmnavt01").css("display","none");
	$(".zlxmnavt02").css("display","none");
	$(".zlxmnavt03").css("display","none");
	$(".zlxmnavt05").css("display","none");
	})
	
$(".zlxmnav05").mouseenter(function(){
	$(".zlxmnav05").addClass("zlxmcurrter");
	$(".zlxmnav01").removeClass("zlxmcurrter");
	$(".zlxmnav02").removeClass("zlxmcurrter");
	$(".zlxmnav03").removeClass("zlxmcurrter");
	$(".zlxmnav04").removeClass("zlxmcurrter");
	$(".zlxmnavt05").css("display","block");
	$(".zlxmnavt01").css("display","none");
	$(".zlxmnavt02").css("display","none");
	$(".zlxmnavt03").css("display","none");
	$(".zlxmnavt04").css("display","none");
	})
	
	
	
	
/*首页关于百佳*/	
/*环境展示*/
$(".gybjlht").mouseenter(function(){
		$(".gybjlhthsbg").css("display","block")
		})
$(".gybjlht").mouseleave(function(){
	$(".gybjlhthsbg").css("display","none")
	})
	
$(".gybjlhf").mouseenter(function(){
	$(".gybjlhfhsbg").css("display","block")
	})
$(".gybjlhf").mouseleave(function(){
	$(".gybjlhfhsbg").css("display","none")
	})
	
$(".gybjcht").mouseenter(function(){
	$(".gybjchthsbg").css("display","block")
	})
$(".gybjcht").mouseleave(function(){
	$(".gybjchthsbg").css("display","none")
	})
	
$(".gybjrht").mouseenter(function(){
	$(".gybjrhthsbg").css("display","block")
	})
$(".gybjrht").mouseleave(function(){
	$(".gybjrhthsbg").css("display","none")
	})
	
$(".gybjchf").mouseenter(function(){
	$(".gybjchfhsbg").css("display","block")
	})
$(".gybjchf").mouseleave(function(){
	$(".gybjchfhsbg").css("display","none")
	})
	
	
/*品质服务*/
$(".gybjlpt").mouseenter(function(){
	$(".gybjlpthsbg").css("display","block")
	})
$(".gybjlpt").mouseleave(function(){
	$(".gybjlpthsbg").css("display","none")
	})
	
$(".gybjlpc").mouseenter(function(){
	$(".gybjlpchsbg").css("display","block")
	})
$(".gybjlpc").mouseleave(function(){
	$(".gybjlpchsbg").css("display","none")
	})
	
$(".gybjlpf").mouseenter(function(){
	$(".gybjlpfhsbg").css("display","block")
	})
$(".gybjlpf").mouseleave(function(){
	$(".gybjlpfhsbg").css("display","none")
	})
	
$(".gybjrpt").mouseenter(function(){
	$(".gybjrpthsbg").css("display","block")
	})
$(".gybjrpt").mouseleave(function(){
	$(".gybjrpthsbg").css("display","none")
	})
	
$(".gybjrpff").mouseenter(function(){
	$(".gybjrpffhsbg").css("display","block")
	})
$(".gybjrpff").mouseleave(function(){
	$(".gybjrpffhsbg").css("display","none")
	})
	
/*技术设备*/
$(".gybj_hjzs").mouseenter(function(){
	$(".gybj_hjzs").addClass("gybj_currter");
	$(".gybj_pzfw").removeClass("gybj_currter");
	$(".gybj_jssb").removeClass("gybj_currter");
	
	$(".gybjh").css("display","block");
	$(".gybjp").css("display","none");
	$(".gybjj").css("display","none");
	
	})
	
$(".gybj_pzfw").mouseenter(function(){
	$(".gybj_pzfw").addClass("gybj_currter");
	$(".gybj_hjzs").removeClass("gybj_currter");
	$(".gybj_jssb").removeClass("gybj_currter");
	
	$(".gybjp").css("display","block");
	$(".gybjh").css("display","none");
	$(".gybjj").css("display","none");
	
	})
	
$(".gybj_jssb").mouseenter(function(){
	$(".gybj_jssb").addClass("gybj_currter");
	$(".gybj_hjzs").removeClass("gybj_currter");
	$(".gybj_pzfw").removeClass("gybj_currter");
	
	$(".gybjj").css("display","block");
	$(".gybjh").css("display","none");
	$(".gybjp").css("display","none");
	
	})


$(".gybjljt").mouseenter(function(){
	$(".gybjljthsbg").css("display","block")
	})
$(".gybjljt").mouseleave(function(){
	$(".gybjljthsbg").css("display","none")
	})
	
$(".gybjljf").mouseenter(function(){
	$(".gybjljfhsbg").css("display","block")
	})
$(".gybjljf").mouseleave(function(){
	$(".gybjljfhsbg").css("display","none")
	})
	
$(".gybjcjf").mouseenter(function(){
	$(".gybjcjfhsbg").css("display","block")
	})
$(".gybjcjf").mouseleave(function(){
	$(".gybjcjfhsbg").css("display","none")
	})
	
$(".gybjrjt").mouseenter(function(){
	$(".gybjrjthsbg").css("display","block")
	})
$(".gybjrjt").mouseleave(function(){
	$(".gybjrjthsbg").css("display","none")
	})
	
$(".gybjrjf").mouseenter(function(){
	$(".gybjrjfhsbg").css("display","block")
	})
$(".gybjrjf").mouseleave(function(){
	$(".gybjrjfhsbg").css("display","none")
	})
	
	
/*	
//底部友情链接
$(".zddwnav").click(function(){
	$(".zhidaodanwei").css("display","block");
	$(".youqinglianjie").css("display","none");
	});
$(".yqljnav").click(function(){
	$(".zhidaodanwei").css("display","none");
	$(".youqinglianjie").css("display","block");
	});


//套式计划
            $(".nosub").css({display:"none"});
            $("#sub1").show();
            $("#sub2").show();
            
			$(".flNavDt1").click(function(){
				$(".flNavDt1").removeClass("flNavDt1c");
				$(this).addClass("flNavDt1c");
				});
			
            
            $(".submenu > dl > div > dt").bind("click",function(){
                if($(this).hasClass("nyNav1")){
                    
                    $(this).parent().find("dd").slideUp(); 
                    		
                }else
                {
                    $(".submenu > dl > div > dd").slideUp();
                    $(this).parent().find("dd").slideDown("normal"); 
                    
                }
                    });
            $(".submenu > dl > div > dd").bind("click",function(){
                    
                    $(this).children().find("ul").slideDown("normal");
                    });


//新闻活动

$(".c_navnews").mouseenter(function(){
	$(".c_toptitle").removeClass("c_topcurrter");
	$(this).addClass("c_topcurrter");
	$(".c_news").animate({width:630},"slow");
	$(".c_events").animate({width:0},"slow");
	$(".c_article").animate({width:0},"slow");
	
	});
$(".c_navevents").mouseenter(function(){
	$(".c_toptitle").removeClass("c_topcurrter");
	$(this).addClass("c_topcurrter");
	$(".c_events").animate({width:630},"slow");
	$(".c_news").animate({width:0},"slow");
	$(".c_article").animate({width:0},"slow");
	
	});
$(".c_navarticle").mouseenter(function(){
	$(".c_toptitle").removeClass("c_topcurrter");
	$(this).addClass("c_topcurrter");
	$(".c_article").animate({width:630},"slow");
	$(".c_news").animate({width:0},"slow");
	$(".c_events").animate({width:0},"slow");
	
	});*/



	$(document).ready(function(){
	

	
	//底部浮动
	

});