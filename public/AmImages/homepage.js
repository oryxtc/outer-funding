$(function () {
	// 是否登录
	flushLoginTicket();
	islogin();
	$('#navlist a').removeClass('cur');
	$("#shoye").addClass("cur");
	
	$(".tc_fs_top>a").click(function(){
		$(this).parents(".tc").hide();
	});
	$(".tc_xx>a").click(function(){
		$(this).parents(".tc").hide();
	})
	
	// banner切换
	num = $(".bannerbox a").size();
	i = 0;
	theInt = null;
	$(".bannerbox a").eq(0).fadeIn(500);
	$(".bannernumber a").eq(0).addClass("cur");
	$(".bannernumber a").each(function (i) {
		$(this).click(function () {
			HuanDeng(i);
			Change(i);
		});
	});
	HuanDeng = function (p) {
	clearInterval(theInt);
	theInt = setInterval(function () {
		p++;
		if (p < num) {
			Change(p);
		} else {
			p = 0
			Change(p);
		}
		}, 5000);
	}
	HuanDeng(0);
	function Change(num) {
		$(".bannerbox a").fadeOut(500);
		$(".bannerbox a").eq(num).fadeIn(500);
		$(".bannernumber a").removeClass("cur");
		$(".bannernumber a").eq(num).addClass("cur");
	};
	
	//加载最新新闻
	$.ajax({
		url:basepath+"findNewsList",
		type:'POST',
		data:{},
		dataType:"json",
		success:function(news){
			var _media = news.media;
			var _mediaHtml = "";
			var _consult = news.consult;
			var _consultHtml = "";
			$(_media).each(function(i){
				_mediaHtml+="<li>";
				_mediaHtml+="<p class='left'><a href='"+basepath+"news/detail/"+this.id+"' target='_blank'>"+this.name+"</a></p>";
				_mediaHtml+="<i class='right'><a href='"+basepath+"news/detail/"+this.id+"' target='_blank'>["+this.addtime+"]</a></i>";
				_mediaHtml+="</li>";
			});
			$(_consult).each(function(i){
				_consultHtml+="<li>";
				_consultHtml+="<p class='left'><a href='"+basepath+"news/detail/"+this.id+"' target='_blank'>"+this.name+"</a></p>";
				_consultHtml+="<i class='right'><a href='"+basepath+"news/detail/"+this.id+"' target='_blank'>["+this.addtime+"]</a></i>";
				_consultHtml+="</li>";
			});
			$('#media_ul').html(_mediaHtml);
			$('#consult_ul').html(_consultHtml);
		}
	});
	
	$("#logine").on('click',function(){
		$(".tc").css("display","none");
		$("#username").focus();
	})
	
	$("#choujiang").on('click',function(){
		 $("#idCardmessage").html("");
		var startTime =Date.parse(new Date("2016-12-19 00:00:00"));
		startTime = startTime/1000;
		var endTime =Date.parse(new Date("2017-01-03 23:59:59"));
		endTime = endTime/1000;
		var now = Date.parse(new Date());
		now = now/1000;
		if(now < startTime){
			$("#notStart").css("display","block");
			return
		}
		if(now > endTime){
			$("#over").css("display","block");
			return
		}
		
		$.post(basepath+"homeIslogin",function(data){
			if(data.success){
				$.post(basepath+"securityInfo/realNameAuthentication",function(data){
					if(data.success){
						$.post(basepath+"/user/christmas/unpack.json",function(data){
							if(data.success){
								$("#moneys").html(data.obj);
								$("#successs").css("display","block");
							}else{
								if(data.code == "4"){
									$("#notmany").css("display","block");
									return;
								}else if(data.code == "6"){
									$("#realNameAuthentication").css("display","block");
									return
								}else if(data.code == "1"){
									$("#haved").css("display","block");
								}else if(data.code == "10"){
									$("#notIn").css("display","block");
								}
							}
						},"json")
				    }else{
				    	$("#realNameAuthentication").css("display","block");
						return
					}
				},"json");
		    }else{
		    	$("#notLogin").css("display","block");
		    	return
			}
		},"json");
	})
	
});

var loginValid = false;

//登录表单
var form = $("#loginForm");

// 回车事件
form.on("keypress", "input", function(event){
	if(event.keyCode == 13){
		$("#login").trigger("click");
		return false;
	}
})

//登录操作
$("#login").click(function(){
	var $this = $(this);
	$this.text("正在登录");
	$this.attr("disabled","disabled");
	var loginName = $.trim($("#username").val());
	var password = $.trim($("#password").val());
	if(loginName == null || loginName.length <= 0){
		$this.text("立即登录");
		$this.removeAttr("disabled");
		$("#username").focus();
		return;
	}else if(password == null || password.length <= 0){
		$this.text("立即登录");
		$this.removeAttr("disabled");
		$("#password").focus();
		return;
	}
	loginValid = true;
	$("#loginForm").submit();
	$this.text("立即登录");
	$this.removeAttr("disabled");
});

// 登录验证函数, 由 onsubmit 事件触发
function loginValidate() {
	if(loginValid) {
		deleteIFrame('#ssoLoginFrame');// 删除用完的iframe,但是一定不要在回调前删除，Firefox可能有问题的
		// 重新刷新 login ticket
		flushLoginTicket();
		// 验证成功后，动态创建用于提交登录的 iframe
		$('body').append($('<iframe/>').attr({
			style : "display:none;width:0;height:0",
			id : "ssoLoginFrame",
			name : "ssoLoginFrame",
			src : "javascript:false;"
		}));
		return true;
	}
	return false;
}

function deleteIFrame(iframeName) {
	var iframe = $(iframeName);
	if (iframe) { // 删除用完的iframe，避免页面刷新或前进、后退时，重复执行该iframe的请求
		iframe.remove();
	}
};

// 由于一个 login ticket 只允许使用一次, 当每次登录需要调用该函数刷新 lt
function flushLoginTicket() {
	var _services = 'service=' + encodeURIComponent(basepath+"indexSSO");
	$.getScript(casServerLoginUrl + '?' + _services + '&get-lt=true&n=' + new Date().getTime(), function() {
		// 将返回的 _loginTicket 变量设置到 input name="lt" 的value中。
		$('#J_LoginTicket').val(_loginTicket);
		$('#J_FlowExecutionKey').val(_flowExecutionKey);
	});
};

//判断用户是否登陆
function islogin(){
	$.post(basepath+"homeIslogin",function(data){
		if(data.success){
			$("#logindiv").hide();
			$("#logondiv").show();
			// 账户信息
	    }else{
	    	$("#logindiv").show();
			$("#logondiv").hide();
		}
	},"json");
}

function realNameAuthentication(){
	
	
}

function closeTL(){
	$("#realNameAuthentication").css("display","none");
}


//验证身份证
function validateCard1(){
	
	var name=$("#cardname").val();
	var card=$("#idcard").val();
	if(name==""){
		$("#cardname").focus(); 
		$("#idCardmessage").html("姓名不能为空");
		
		return;
	}
	if(card==""){
		$("#idcard").focus(); 
		$("#idCardmessage").html("身份证号码不能为空");
			
		return;
	}
	if(checkCard(card)==false){
		$("#idcard").focus(); 
		$("#idCardmessage").html("身份证号码数据不对");
		
		return;
	}
	
	 $.post(basepath+"securityInfo/validateCard",{"name":name,"card":card},function(data){  
			if(data.success){
				if(data.message!="" && data.message!=null){
					 if(data.message=="false"){
						 $("#idCardmessage").html("身份证信息错误");
					
					}else if(data.message=="maxnum"){
						$("#idCardmessage").html("身份证验证失败超过3次,请与客服联系");
					}else if(data.message=="exsit"){
						$("#idCardmessage").html("身份证已经存在");
						
					}else if(data.message=="haveRealName"){
						$("#idCardmessage").html("已是实名状态,不能重复实名");
						
					}else{
						closeTL();
						$("#renzhensuccess").css("display","block");
					}
				}
				
			}
		},"json"); 

}

function closeBB(){
	$("#successs").css("display","none");
	}