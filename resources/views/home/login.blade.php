<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>用户登录</title>
    <link href="{{asset('./AmImages/index.css')}}" rel="stylesheet" type="text/css">
    <script src="{{asset('./AmImages/jquery-1.10.1.min.js')}}"></script>
    <script language="javascript" src="{{asset('./AmImages/common.js')}}"></script>
    <!--[if lt IE 9]>
    <script src="scripts/IE9.js"></script> <![endif]-->
</head>
<body>
//导航面包屑
@include('home.layouts.islogin')
<div class="wapper">
    <div class="top">
        <div class="top2"><a href="/index" title="股票配资网"><img src="{{asset('./AmImages/logo.png')}}" alt="股票配资网"> </a>
        </div>
        <div class="top3">
            <div class="top3_box">
                <ul class="top3_nav">
                    <li><a href="/index">首页</a></li>
                    <li><a>关于我们</a><img alt="关于我们" src="{{asset('./AmImages/top3_icon.png')}}">
                        <div class="top3_popnav" style="display: none;"><a href="/gsjs">公司介绍</a> <a
                                    href="/qywh">企业文化</a> <a href="/qyfc">企业风采</a></div>
                    </li>
                    <li><a>我要配资</a><img alt="我要配资" src="{{asset('./AmImages/top3_icon.png')}}">
                        <div class="top3_popnav" style="display: none;"><a href="/wypz" target="_blank">我要配资</a> <a
                                    href="/yyyouyu">月月有余</a></div>
                    </li>
                    <li><a>股票配资</a><img alt="股票配资" src="{{asset('./AmImages/top3_icon.png')}}">
                        <div class="top3_popnav" style="display: none;"><a href="/sjgppz">啥叫股票配资</a> <a href="/gpzx">股票咨询</a>
                        </div>
                    </li>
                    <li><a>期货配资</a><img alt="期货配资" src="{{asset('./AmImages/top3_icon.png')}}">
                        <div class="top3_popnav" style="display: none;"><a href="/sjqhpz">啥叫期货配资</a></div>
                    </li>
                    <li><a href="/tzxy">投资学院</a></li>
                    <li><a href="/xzzq">下载专区</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="logon-wrap clearfix">
        <form id="fm1" class="form" action="/login" method="post">
            <div class="ui-logon login1" id="login">
                <h3>用户登录<p id="rightP" style="margin-top:-15px; *margin-top:-34px;">没有账号？<a href="/register">立即注册</a>
                    </p></h3>
                <input type="hidden" name="lt" value="LT-229661-ytbFueloc4TOwP7W5Y9oe0SlPQ6CYY-www.tzdr.com"> <input
                        type="hidden" name="execution" value="e5s1"> <input type="hidden" name="_eventId"
                                                                            value="submit">
                <div class="logon-ipt userNameLi" style="margin-top: 80px;">
                    <label>手机号码</label>
                    <input id="username" name="phone" class="holder userName" tabindex="1" accesskey="n" type="text"
                           maxlength="11" autocomplete="off">
                    <div class="ui-err loginError usernameError" style="display: none; width:140px;"></div>
                </div>
                <div class="logon-ipt mgt20 passwordLi">
                    <label>登录密码</label>
                    <input id="password" name="password" tabindex="2" class="password" type="password" value=""
                           maxlength="16" autocomplete="off">
                    <div class="ui-err loginError passwordError" style="display: none; width:140px; height:auto;">

                    </div>
                </div>
                <div class="login-btn">
                    <button class="loginbtn" type="submit" id="loginbtn">登录</button>
                </div>
                <div class="lastP">
                    <a class="forget" href="/forgetpw">忘记密码？</a> <a class="registerlink" href="/register">免费注册</a>
                </div>
            </div>
        </form>
    </div>
    <div class="foot_x">
        <div class="footnav"><a href="/index" title="首页">首页</a> <a title="关于我们" href="/gsjs">关于我们</a> <a title="免责声明"
                                                                                                         href="/mzsm">免责声明</a>
            <a title="站点地图" href="/zddt">站点地图</a> <a title="联系我们" href="/lxwm">联系我们</a></div>
        <div class="boottxt"> 地址：&nbsp;&nbsp;&nbsp;&nbsp;电话：<br>
            &copy;版权所有：股票配资网
        </div>
    </div>
</div>
</body>
</html>