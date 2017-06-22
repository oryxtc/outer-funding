<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta name="renderer" content="webkit">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>用户登录</title>

    <link href="./AmImages/user.css" rel="stylesheet" type="text/css">
    <script src="./AmImages/jquery-1.10.1.min.js"></script>
    <script language="javascript" src="./AmImages/common.js"></script>
    <!--[if lt IE 9]>
    <script src="scripts/IE9.js"></script> <![endif]-->
</head>
<body>
{{--导航面包屑--}}
@include('home.layouts.islogin')
<div class="wapper">
    <div class="top">
        <div class="top2"><a href="/index" title="股票配资网"><img src="{{asset('./AmImages/logo.png')}}" alt="股票配资网"> </a>
        </div>
        <div class="top3">
            <div class="top3_box">
                <ul class="top3_nav">
                    <li><a href="/index">首页</a></li>
                    <li><a href="/gsjs">关于我们</a><img alt="关于我们" src="{{asset('./AmImages/top3_icon.png')}}">
                        <div class="top3_popnav" style="display: none;"><a href="/gsjs">公司介绍</a> <a
                                    href="/qywh">企业文化</a> <a href="/qyfc">企业风采</a></div>
                    </li>
                    <li><a href="/yyyouyu">我要配资</a><img alt="我要配资" src="{{asset('./AmImages/top3_icon.png')}}">
                        <div class="top3_popnav" style="display: none;"><a href="/yyyouyu" target="_blank">我要配资</a> <a
                                    href="/wypz">月月有余</a></div>
                    </li>
                    <li><a href="/sjgppz">股票配资</a><img alt="股票配资" src="{{asset('./AmImages/top3_icon.png')}}">
                        <div class="top3_popnav" style="display: none;"><a href="/sjgppz">啥叫股票配资</a> <a href="/gpzx">股票咨询</a>
                        </div>
                    </li>
                    <li><a href="/sjqhpz">期货配资</a><img alt="期货配资" src="{{asset('./AmImages/top3_icon.png')}}">
                        <div class="top3_popnav" style="display: none;"><a href="/sjqhpz">啥叫期货配资</a></div>
                    </li>
                    <li><a href="/tzxy">投资学院</a></li>
                    <li><a href="/xzzq">下载专区</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="centmain">

        <!--个人中心导航 -->
        <div class="uc_sidebar">
            <h2 id="oAccount" style="cursor: pointer;"><a href="#">用户管理<i>&gt;</i></a></h2>
            <div class="uc_nav">
                <ul>
                    <li class="on"><a id="toUserInfo" href="/userinfo" class="icon6">个人信息</a><i>&gt;</i></li>
                    <li><a id="security" href="/securityInfo" class="icon7 on">安全信息</a><i>&gt;</i></li>
                </ul>
            </div>
        </div>
        <!--个人信息-->
        <div class="uc_mianbar">
            <div class="uc_info">
                <h3><i>个人信息</i></h3>
                <div class="uc_i_list">
                    <ul>
                        <li>
                            <label>真实姓名：</label>
                            @if(empty(auth()->user()->actual_name))
                                <span>未认证</span><a href="/securityInfo">认证</a>
                            @else
                                <span>{{auth()->user()->actual_name}}</span>
                            @endif
                        </li>
                        <li>
                            <label>身份证号码：</label>
                            @if(empty(auth()->user()->id_card))
                                <span>未认证</span><a href="/securityInfo">认证</a>
                            @else
                                <span>{{auth()->user()->id_card}}</span>
                            @endif
                        </li>
                        <li>
                            <label>手机号码：</label>
                            <span>
                              {{substr_replace (auth()->user()->phone,'****',4,4)}}
                            </span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
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