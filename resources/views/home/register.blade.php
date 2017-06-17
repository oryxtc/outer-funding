<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<title>用户注册</title>
<link href="./AmImages/index.css" rel="stylesheet" type="text/css">
<script src="./AmImages/jquery-1.10.1.min.js"></script>
<script language="javascript" src="./AmImages/common.js"></script>
</head>
<body>
<div class="headTop">
<div class="header">
<div class="salogan"></div>
<p> <a href="/login" rel="nofollow">登录</a>|<a href="/register" rel="nofollow">免费注册</a> <span>客服热线：</span><font>0931-8500903</font> </p>
</div>
</div>
<div class="wapper">
<div class="top">
<div class="top2"><a href="/index" title="股票配资网" ><img src="./AmImages/logo.png" alt="股票配资网"> </a></div>
<div class="top3">
<div class="top3_box">
<ul class="top3_nav">
<li><a href="/index">首页</a></li>
<li><a>关于我们</a><img alt="关于我们" src="./AmImages/top3_icon.png">
<div class="top3_popnav" style="display: none;"> <a href="/gsjs">公司介绍</a> <a href="/qywh">企业文化</a> <a href="/qyfc">企业风采</a> </div>
</li>
<li><a>我要配资</a><img alt="我要配资" src="./AmImages/top3_icon.png">
<div class="top3_popnav" style="display: none;"> <a href="/wypz" target="_blank">我要配资</a> <a href="/yyyouyu">月月有余</a> </div>
</li>
<li><a>股票配资</a><img alt="股票配资" src="./AmImages/top3_icon.png">
<div class="top3_popnav" style="display: none;"> <a href="/sjgppz">啥叫股票配资</a> <a href="/gpzx">股票咨询</a></div>
</li>
<li><a>期货配资</a><img alt="期货配资" src="./AmImages/top3_icon.png">
<div class="top3_popnav" style="display: none;"> <a href="/sjqhpz">啥叫期货配资</a> </div>
</li>
<li><a href="/tzxy">投资学院</a></li>
<li><a href="/xzzq">下载专区</a></li>
</ul>
</div>
</div>
</div>
<div class="register">
<div class="rg_ctn">
<h3>用户注册
<p id="rightP" style="margin-top:-15px; *margin-top:-34px;">已有账号？<a href="/login">立即登录</a></p>
</h3>
<form class="form" action="" method="post">
<ul class="rg_list">
<li> <i>*</i>
<label>手机号码</label>
<input type="text" class="phone rg_l_ip rg_l_iperror" id="mobile" name="mobile" maxlength="11">
<span class="rg_l_promt" style="display: block;">以后用该手机号码登录平台</span>
<p style="display: none;" class="rg_l_error">该手机号码已经存在</p>
</li>
<li> <i>*</i>
<label>手机验证</label>
<input type="text" class="rg_l_codeip rg_l_tlcode rg_l_ip" id="code" name="code" maxlength="6">
<span class="rg_l_promt" style="display: none">请先获取验证码</span> 
<!-- <a href="javascript:void(0);" status="true" id="getCode" name="getCode" class="rg_l_codebtn">获取验证码</a> --> 
<a href="javascript:void(0);" status="true" id="openYZMBox" name="openYZMBox" class="rg_l_codebtn" onclick="_hmt.push([&#39;_trackEvent&#39;,&#39;signin&#39;,&#39;click&#39;,&#39;sendcode&#39;]);">获取验证码</a>
<p style="display: none;" class="rg_l_error">输入验证码有误！</p>
</li>
<li> <i>*</i>
<label>登录密码</label>
<input type="password" class="rg_l_password rg_l_ip" id="password" name="password" maxlength="16">
<span class="rg_l_promt" style="display: none">6-16位数字和字母组成</span>
<p style="display: none;" class="rg_l_error">密码必须由6-16位数字和字母组成</p>
</li>
<li> <i>*</i>
<label>确认密码</label>
<input type="password" class="rg_l_password rg_l_ip" id="affirmpassword" name="affirmpassword" maxlength="16">
<span class="rg_l_promt" style="display: none">请再输入一次您设置的密码</span>
<p style="display: none;" class="rg_l_error">两次密码不一致</p>
</li>
</ul>
<div class="rg_agree">
<input type="checkbox" checked="checked" id="agreement" name="agreement">
我已阅读并同意<a href="javascript:showAgreement();">《配资网站服务协议》</a></div>
<div class="rg_btn"><a status="true" id="signin" name="signin" href="javascript:void(0);">立即注册</a></div>
</form>
</div>
<div style="display: none;">
<form id="loginForm" action="http://login.peigubao.com/login" onsubmit="return loginValidate();" method="post" target="ssoLoginFrame">
<input type="hidden" name="isajax" value="true">
<input type="hidden" name="isframe" value="true">
<input type="hidden" name="lt" value="" id="J_LoginTicket">
<input type="hidden" name="execution" value="e4s1" id="J_FlowExecutionKey">
<input type="hidden" name="_eventId" value="submit">
<input type="hidden" name="username" id="loginUsername">
<input type="hidden" name="password" id="loginPassword">
</form>
</div>
</div>
<div class="foot_x">
<div class="footnav"><a href="/index" title="首页">首页</a> <a title="关于我们" href="/gsjs">关于我们</a>  <a title="免责声明" href="/mzsm">免责声明</a> <a title="站点地图" href="/zddt">站点地图</a> <a title="联系我们" href="/lxwm">联系我们</a> </div>
<div class="boottxt"> 地址：&nbsp;&nbsp;&nbsp;&nbsp;电话：<br>
&copy;版权所有：股票配资网 </div>
</div>
</div>
</body>
</html>