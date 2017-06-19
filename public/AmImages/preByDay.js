var minOperMoney = null;
var maxOperMoney = null;
var minHoldDays = null;
var maxHoldDays = null;
var interestCoefficient = null;
var manageFeeCoefficient = null;
var minFunding = null;
var maxFunding = null;
var minLever = null;
var maxLever = null;

$(document).ready(function(e) {
	
	minOperMoney = Number($("#minOperMoney").val());
	maxOperMoney = Number($("#maxOperMoney").val());
	minHoldDays = Number($("#minHoldDays").val());
	maxHoldDays = Number($("#maxHoldDays").val());
	interestCoefficient = Number($("#interestCoefficient").val());
	manageFeeCoefficient = Number($("#manageFeeCoefficient").val());
	minFunding = Number($("#minFunding").val());
	maxFunding = Number($("#maxFunding").val());
	minLever = Number($("#minLever").val());
	maxLever = Number($("#maxLever").val());

	$('#navlist a').removeClass('cur');
	$("#stockli").addClass("cur");

	//初始化交易日选项
	var initTradeStart= function(){
		$.post(basepath + "isTrading.json", {}, function(result) {
		if (result.success) {
			var tday = $(".tday");
			var nday = $(".nday");
			if (result.data.isTradeDay) {
				tday.show();			
				nday.show();
				tday.click();
				$("#hint").html("30分钟内开户");
			} else {
				tday.hide();
				nday.show();
				nday.click();	
				$("#hint").html("下个交易日9:15前开户");
			}
		} else {
			showMsgDialog("提示",result.message);
		}
	}, "json");
	}
	
	//预计结束时间
	var endday=function(borrowPeriod,tradeStart){
		$.post(basepath + "endDay.json", {borrowPeriod:borrowPeriod,tradeStart:tradeStart}, function(result) {
			if (result.success) {
				$("#end_day").html(result.data.endDay);
			} else {
				showMsgDialog("提示",result.message);
			}
		}, "json");
	}
	
	//下个交易日“点击事件”
	$('.nday').click(function() {
		if($.isNumeric($('#use_day').val())){
		var borrowPeriod = Number($('#use_day').val());
		endday(borrowPeriod,1);
		$("#hint").html("下个交易日9:15前开户");
		}
	});
	
	//立即交易“点击事件”
	$('.tday').click(function() {
		if($.isNumeric($('#use_day').val())){
		var borrowPeriod = Number($('#use_day').val());
		endday(borrowPeriod,0);
		$("#hint").html("30分钟内开户");
		}
	});

	//风控参数
	function risk(pzgg, pzje) {
		$.post(basepath+"risk.json",{lever:pzgg,ajax:1},function(data){  //获取风控信息
			if(data.success && data.code=="200"){
				var lossWarningLine = Number(data.obj.lossWarningLine);
				var lossCloseLine = Number(data.obj.lossCloseLine);
				$('#ksbcx').text($.formatMoney((pzje * lossWarningLine).toFixed()));
				$('#kspcx').text($.formatMoney((pzje * lossCloseLine).toFixed()));
			}
		},"json");
	}

	//操盘须知
	function operatorsInfo(zcpzj) {
		if (zcpzj <= 300000) {
			$('#notify').removeClass('cp_ru_ctn2');
			$('#notify').html('投资沪深A股，仓位不限制。');
		} else if (300000 < zcpzj && zcpzj <= 500000) {
			$('#notify').addClass('cp_ru_ctn2');
			$('#notify').html('投资沪深A股，仓位有限制，单股不超总操盘资金的70%。');
		}else if (500000 < zcpzj && zcpzj <= 1000000) {
			$('#notify').addClass('cp_ru_ctn2');
			$('#notify').html('投资沪深A股，仓位有限制，单股不超总操盘资金的50%。');
		} else if (1000000 < zcpzj) {
			$('#notify').addClass('cp_ru_ctn2');
			$('#notify').html('投资沪深A股，仓位有限制，单股不超总操盘资金的50%(创业板33%)。');
		}
	}
	
	var tzMaxMoney=Number(maxOperMoney);   //最大保证金
	var minMoney=Number(minOperMoney);  //最小保证金
	function getMoney(){
		return $.trim($("#tz").val()).replace(/\,/g,"");
	}
	function getIntMoney(){
		var money = getMoney();
		return /^\d+$/.test($.trim(money))?parseInt(money,10):0;
	}

	function moneyChange(){   //保证金金额输入变化
		var money = getMoney();
		if(/^\d+$/.test(money)){
			var moneyInt = getIntMoney();
			if(moneyInt>tzMaxMoney){
				$("#tz").val($.formatMoney(tzMaxMoney));
			}else{
				$("#tz").val($.formatMoney(moneyInt));
			}
		}else{
			$("#tz").val("");
		}
		return true;
	}

	var maxday = Number(maxHoldDays);  //最大天数
	var minday = Number(minHoldDays);    //最小天数
	function getDay() {
		return $.trim($("#use_day").val()).replace(/\,/g, "");
	}
	function getIntDay() {
		var day = getDay();
		return /^\d+$/.test($.trim(day)) ? parseInt(day, 10) : 0;
	}

	function dayChange() {  //交易天数输入变化
		var day = getDay();
		if (/^\d+$/.test(day)) {
			var day = getIntDay();
			if (day > maxday) {
				$("#use_day").val(maxday);
			} else if (day < minday) {
				$("#use_day").val(minday);
			}
		} else {
			$("#use_day").val("");
		}
	}
	
	function getPzgg() {
		return $.trim($("#pzgg").val()).replace(/\,/g, "");
	}
	function getIntPzgg() {
		var pzggInt = getPzgg();
		return /^\d+$/.test($.trim(pzggInt)) ? parseInt(pzggInt, 10) : 0;
	}

	function pzggChange() {   //倍数输入变化
		var minPzgg =  minLever;
		var maxPzgg = maxLever;	
		var gg = getPzgg();
		if (/^\d+$/.test(gg)) {
			var gzgg = getIntPzgg();
			if (gzgg > maxPzgg) {
				$("#pzgg").val(maxPzgg);
			} else if (gzgg < minPzgg) {
				$("#pzgg").val(minPzgg);
			}
		} else {
			$("#pzgg").val("");
		}
	}

	var maxMoney = Number(maxFunding);   //最大配额
	var minPzjeMoney = Number(minFunding);   //最小配额
	var getAllData=function(gg){
		moneyChange();
		var pzbzj= $.isNumeric(getIntMoney())?getIntMoney():0;
		$('#capitalMargin').val(pzbzj);
		var minpzgg = Math.ceil(minPzjeMoney / pzbzj);
		var maxpzgg = maxLever;
		
		if($.isNumeric(gg)){
			var pzgg = Number($("#pzgg").val());
			if(gg<=maxpzgg){
				pzgg=gg;
				$("#pzgg").val(gg);
			}else{
				pzgg=maxpzgg;
				$("#pzgg").val(maxpzgg);
		    }
			var pzje = pzbzj * pzgg;
			var zcpzj = pzje + pzbzj;
			$('#pzje').text($.formatMoney(Number(pzje)));
			$('#zcpzj').text($.formatMoney(Number(zcpzj)))	
			operatorsInfo(pzje);
			if(pzbzj>=minMoney){
				if($.isNumeric($('#use_day').val()*30)){
					getData();
				}
				//设置平仓线 补仓线
				risk(pzgg, pzje)
			}
	  } 
	}

	//利息、管理费
	function getData() {
		var borrowPeriod = Number($('#use_day').val());
		var capitalMargin = $.isNumeric(getIntMoney())?getIntMoney():0;
		var lever = Number($('#pzgg').val());
		var tradeStart = typeof($("input[name='tradeStart']:checked").val()) == "undefined"?1:$("input[name='tradeStart']:checked").val();
		if(capitalMargin>=minOperMoney&&borrowPeriod>=minHoldDays&&lever>=minLever){
		if(capitalMargin*lever>=minPzjeMoney){
		$.post(basepath + "data.json", {
			borrowPeriod : borrowPeriod,
			lever : lever,
			capitalMargin : capitalMargin,
			tradeStart:tradeStart
		}, function(result) {
			if (result.success) {
				$("#end_day").html(result.data.endDay);
				$("#lx").html(result.data.totalInterestFee);
				$("#pzglf").html(result.data.manageFee);
			} else {
				showMsgDialog("提示",result.message);
			}
		}, "json");
			}
		}
	}
	
	//配额选项
	var onTz = function (){
		var capitalMoney=getMoney();
		$('#margin ul li').each(function(i){
			if($(this).attr('data')==capitalMoney){
				$(this).addClass('on');
			 }else{
				$(this).removeClass('on'); 
			 }
		});
	}
	
	//倍数选项
	var onLerver = function (){
		var lever=Number($("#pzgg").val());
		$('#capital_lever ul li').each(function(i){
			if($(this).attr('data')==lever){
				$(this).addClass('on');
			 }else{
				$(this).removeClass('on'); 
			 }
		});
	}
	
	//天数选项
	var onDay = function (){
		var onDay=Number($("#use_day").val());
		$('#match_days ul li').each(function(i){
			if($(this).attr('data')==onDay){
				$(this).addClass('on');
			 }else{
				$(this).removeClass('on'); 
			 }
		});
	}
	
	//输入配额
	$("#tz").keypress(T.numKeyPress).keyup(function() {
		getAllData($("#pzgg").val());
		onTz();
		onLerver();
		onDay();
		showLever();
		$(this).focus();
	}).focus(function() {
		if($(this).val()==''){
			$("#tz").removeClass("font_size_15").addClass("font_size_22");	
			$(this).val('');
			}
		$(this).css("ime-mode","disabled");
	}).blur(function(){   
		var moneyInt = getIntMoney();    
		if (moneyInt<minMoney){
			$("#tz").val($.formatMoney(minMoney));
			getAllData($("#pzgg").val());
			onTz();
			onLerver(); 
			onDay();
			showLever();
		}
	});;
	
	//输入倍数
	$("#pzgg").keypress(T.numKeyPress).keyup(function() {
		pzggChange();
		getAllData($("#pzgg").val());
		onTz();
		onLerver();
		onDay();
		$(this).focus();
	}).focus(function() {
		if($(this).val()==''){
			$("#pzgg").removeClass("font_size_15").addClass("font_size_22");	
			$(this).val('');
			}
		$(this).css("ime-mode","disabled");
	});

	//输入天数
	$("#use_day").keypress(T.numKeyPress).keyup(function() {
		dayChange();
		getData();
		onTz();
		onLerver();
		onDay();
		$(this).focus();
	}).focus(function() {
		if($(this).val()==''){
			$("#use_day").removeClass("font_size_15").addClass("font_size_22");
			$(this).val('');
			}
		$(this).css("ime-mode","disabled");
	});
	
	//配额选中事件
	$('#margin ul li').click(function() {
		$("#tz").removeClass("font_size_15").addClass("font_size_22");
		$('#margin ul li.on').removeClass('on');
		$(this).addClass('on');
		$("#tz").val($.formatMoney(Number($(this).attr('data'))));
		// getAllData($("#pzgg").val());
		showLever();

	});
	
	//倍数选中事件
/*	$('#capital_lever ul li').click(function() {
		$("#pzgg").removeClass("font_size_15").addClass("font_size_22");	
		$('#capital_lever ul li.on').removeClass('on');
		$(this).addClass('on');
		$("#pzgg").val(Number($(this).attr('data')));
		getAllData($("#pzgg").val());
	});*/
	
	//天数选中事件
	$('#match_days ul li').click(function() {
		$("#use_day").removeClass("font_size_15").addClass("font_size_22");
		$('#match_days ul li.on').removeClass('on');
		$(this).addClass('on');
		// $("#use_day").val(Number($(this).attr('data')));
		dayChange();
		getData();
	});

	$("#submit").on("click",function(){
		var T_pzbzj = $.isNumeric(getIntMoney())?getIntMoney():0;
		var T_pzgg = Number($("#pzgg").val());
		var T_pzje=T_pzbzj*T_pzgg;
		
		$.post(basepath + "maxAmount.json", {		
			lever : T_pzgg
		}, function(result) {
			if (result.success) {
				var maxAmount=maxFunding;
				var maxLeverMoney=Number(result.data.maxLeverMoney);
				var isOpen=Number(result.data.isOpen);
				var loginStatus = Number(result.data.loginStatus);
				var userTodayTradeNum = Number(result.data.userTodayTradeNum);
				var limitTradeNum = Number(result.data.limitTradeNum);
				if(T_pzje>maxAmount){
					showMsgDialog("提示",T_pzgg+"倍最大操盘配额为"+maxFunding+"元");	
					return false;	
				}if(isOpen==1&& loginStatus==1 && (T_pzje>maxLeverMoney || userTodayTradeNum >= limitTradeNum)){
					$('#OK').parent().find('p i').text($.formatMoney(maxLeverMoney,2));
					$('#OK').parent().find('p span i').text(limitTradeNum);
					$('#OK').parent().css({display:'block'});
					$('.fl_mask').css({display:'block'});
					return false;	
				}else{
					if($("#agree").attr("checked")){
						var pzbzjTemp = $.isNumeric(getIntMoney())?getIntMoney():0;
						if(pzbzjTemp>=minOperMoney){ 
							var no=Number($("#use_day").val());
							if(no<=maxHoldDays&&no>=minHoldDays){
								var minPzgg = minLever;
								var maxPzgg = maxLever;
								var inputgg=$('#pzgg').val()
								if(inputgg>=minPzgg&&inputgg<=maxPzgg){
									if(typeof($("input[name='tradeStart']:checked").val())!='undefined'){
									if($("input[name='tradeStart']:checked").val()==1){
									showConfirmDialog("提示","请确认是否要在下个交易日开始操盘!",function(){
										if(!isLoginSSO){
							    			window.location.href=basepath+"/toDaySSO"; 
										}else{
											$("form").submit();		
										}		
									},"确定",function(){
										return true;		
									});
									}else{
										if(!isLoginSSO){
							    			window.location.href=basepath+"/toDaySSO"; 
										}else{
											$("form").submit();		
										}
									}
									}else{
										showMsgDialog("提示","请选择开始交易时间！");	
									}
									
								}else{
								showMsgDialog("提示","请选择操盘倍数！"); 
								}
							}else{
								showMsgDialog("提示","操盘天数最少"+minHoldDays+"天，最多"+maxHoldDays+"天");	
							}
						}else{
							showMsgDialog("提示","操盘保证金最少"+minOperMoney+"元，最多"+(maxOperMoney/10000).toFixed(1)+"万元。");
						}
					}else{
						showMsgDialog("提示","请阅读并同意《借款协议》。");
					}		
				}
			} else {
				showMsgDialog("提示",result.message);
			}
		}, "json");
	});

	if($('#capitalMargin').val()!=0){
		$("#tz").val($.formatMoney(Number($('#capitalMargin').val())));
		$("#pzgg").val($('#lever').val());
		$("#use_day").val($('#borrowPeriod').val());
		var start=$('#backTradeStart').val();
		if(start==0){
		$("input[name='tradeStart'][value=0]").attr("checked",true); 
		$("#hint").html("30分钟内开户");
		}else{
		$("input[name='tradeStart'][value=1]").attr("checked",true); 
		$("#hint").html("下个交易日9:15前开户");
		}
		initTradeStart();
		getAllData(Number($('#lever').val()));
		onTz();
		onLerver();
		onDay();
	}else{	
		var tz=$.isNumeric($('#margin ul li.on').attr('data'))?$.formatMoney(Number($('#margin ul li.on').attr('data'))):'';
		if(tz==''){
			$("#tz").removeClass("font_size_22").addClass("font_size_15");	
		}
		$("#tz").val(tz);
		var gg=$.isNumeric($('#capital_lever ul li.on').attr('data'))?Number($('#capital_lever ul li.on').attr('data')):'';
		if(gg==''){
			$("#pzgg").removeClass("font_size_22").addClass("font_size_15");
		}
		$("#pzgg").val(gg);
		var use_day=$.isNumeric($('#match_days ul li.on').attr('data'))?Number($('##match_days ul li.on').attr('data')):'';
		if(use_day==''){
			$("#use_day").removeClass("font_size_22").addClass("font_size_15");	
		}
		$("#use_day").val(use_day);
		var capitalMargin = $.isNumeric(getIntMoney())?getIntMoney():0;
		$('#capitalMargin').val(capitalMargin);
		if($.isNumeric(gg)){
			getAllData(gg);
		}
		initTradeStart();
	}
	
	  // 提示框
    $('.cp_sdfont').each(function() {
        $('.uc_pay_promt').hide();
        var promtbtn = $(this);
        promtbtn.children('label').children('a').hover(function() {
            promtbtn.find('.uc_pay_promt ').show();
        }, function() {         
            promtbtn.find('.uc_pay_promt ').hide();
        });
    });
	
    //关闭最大融资额限制弹框
    $('#OK').live('click',function(){
    	var $this = $(this);
    	$this.parent().css({display:'none'});
    	$('.fl_mask').css({display:'none'});
    });
    
    //保证金变更时，校验倍数是否允许选择
    var  showLever=function(){
    	var moneyInt = getIntMoney();
    	var maxSelLever = maxMoney/moneyInt;
    	var minSelLever = minPzjeMoney/moneyInt;
        $('.cp_m_mul li').each(function() {
           var lidata = $(this).attr("data");
           if (lidata >=minSelLever && lidata <= maxSelLever){
        	  if ($(this).hasClass("no")){
        		$(this).removeClass("no");
        	  }
        	  // 绑定点击事件
        	  $(this).click(function() {
        			$("#pzgg").removeClass("font_size_15").addClass("font_size_22");	
        			$('#capital_lever ul li.on').removeClass('on');
        			$(this).addClass('on');
        			// $("#pzgg").val(Number($(this).attr('data')));
        			getAllData($("#pzgg").val());
        		});
           }else
        	{
        	   if (!$(this).hasClass("no")){
        		   $(this).addClass("no");
        	   }
        	   // 清除不满足条件的选中状态
        	   if ($(this).hasClass('on')){
        		   $(this).removeClass('on'); 
        		   $("#pzgg").val("");
        	   }
        	   // 移除点击事件
        	   $(this).unbind("click");
        	}
        });
    }
    
  //返回修改时，默认显示值
    showLever();
});