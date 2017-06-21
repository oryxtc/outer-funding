<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta name="renderer" content="webkit">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>企业风采</title>
    <link href="{{asset('./AmImages/index.css')}}" rel="stylesheet" type="text/css">
    <script src="{{asset('./AmImages/jquery-1.10.1.min.js')}}"></script>
    <script language="javascript" src="{{asset('./AmImages/common.js')}}"></script>
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
    <div class="caontent">
        <div class="dqwz">
            <div class="l"> 当前位置：<a href="/gsjs">关于我们</a>&nbsp;&gt;&nbsp;公司介绍</div>
        </div>
        <div class="clist">
            <div class="clist_l">
                <div class="newcont">
                    <h1 class="cssh1">企业风采</h1>
                    <div class="art_context">
                        @if($content=\DB::table('newslists')->where('type','company_style')->orderBy('created_at','DESC')->first())
                            {!! $content->content !!}
                        @endif
                    </div>
                </div>
            </div>
            <div class="clist_r">
                <div class="fl mb7"><img src="{{asset('./AmImages/adpic2.jpg')}}" alt="股票配资"></div>
                <div class="ksnav fl bm7">
                    <div class="navsub fl">
                        <ul>
                            <li><a href="/gsjs">公司介绍</a></li>
                            <li><a href="/qywh">企业文化</a></li>
                            <li><a href="/qyfc">企业风采</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="cl"></div>
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