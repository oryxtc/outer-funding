<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>股票配资网</title>
    <link href="{{asset('./AmImages/index.css')}}" rel="stylesheet" type="text/css">
    <script src="{{asset('./AmImages/jquery-1.10.1.min.js')}}"></script>
    <script language="javascript" src="{{asset('./AmImages/common.js')}}"></script>
    <script type="text/javascript" src="{{asset('./AmImages/myjs.js')}}"></script>
    <script type="text/javascript" src="./AmImages/lrtk.js"></script>
    <script src="./AmImages/jquery-1.8.0.min.js"></script>
    <script src="./AmImages/homepage.js"></script>
    <script type="text/javascript">
        var basepath = "";
        var casServerLoginUrl = "";
    </script>
    <script src="./AmImages/jquery-1.7.2.min.js"></script>
    <script src="./AmImages/jquery.SuperSlide.2.1.1.js" type="text/javascript"></script>
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
    <div class="banner">
        <div class="p1">
            <div class="pic">
                <div class="shu bannernumber"><span><a href="javascript: void(0);" title="1" class="cur">1</a></span>
                    <span><a href="javascript: void(0);" title="2" class="">2</a></span> <span><a
                                href="javascript: void(0);" title="3" class="">3</a></span></div>
                <div class="tu bannerbox" style="display:block;"><a href="#" target="_blank"
                                                                    style="display: block;"><img
                                src="./AmImages/ban.jpg"></a> <a href="#" target="_blank" style="display: none;"><img
                                src="./AmImages/ban2.jpg"></a> <a href="#" target="_blank" style="display: none;"><img
                                src="./AmImages/ban3.jpg"></a></div>
                <div class="login" id="logindiv" style="display: none">
                    <div class="main">
                        <form id="loginForm" name="loginForm" action="/login" method="post">
                            <input type="hidden" name="isajax" value="true">
                            <input type="hidden" name="isframe" value="true">
                            <input type="hidden" name="lt" value="" id="J_LoginTicket">
                            <input type="hidden" name="execution" value="e1s1" id="J_FlowExecutionKey">
                            <input type="hidden" name="_eventId" value="submit">
                            <p class="t1">用户登录</p>
                            <input class="uname" id="username" name="phone" placeholder="请输入手机号码" value="">
                            <input class="key" type="password" id="password" name="password" placeholder="请输入登录密码"
                                   value="">
                            <input class="bot" id="login" type="submit" value="登录" rel="nofollow">
                            <p class="fr"><span><a href="/forgetpw" rel="nofollow">忘记密码？</a></span><font><a
                                            href="/register" rel="nofollow">免费注册</a></font></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(function () {
            // TODO 临时注释
//	$('#id-xm-rorate').Microslider();
        });
    </script>
    <div class="main">
        <div class="congz">
            <div class="navleft"><a href="/sjgppz" target="_blank" title="股票配资"> <img src="./AmImages/hqzx.jpg"></a>
            </div>
            <div class="gpfw">
                <div class="list_not1">
                    <iframe width="300" scrolling="no" height="230" frameborder="0" marginheight="0" marginwidth="0"
                            src="./AmImages/stock_1.html"></iframe>
                </div>
            </div>
            <div class=" infBox">
                <div class="tab_tit"><a class="ck" onmouseover="tab_v(1,&#39;wja_&#39;,&#39;wjn_&#39;,4)" id="wja_1">股票资讯</a>
                    <a onmouseover="tab_v(2,&#39;wja_&#39;,&#39;wjn_&#39;,4)" id="wja_2" class="">期货资讯</a>
                    <div class="dw_t_r"><a id="more_url" href="/gpzixun/stock" target="_blank">MORE+</a></div>
                </div>
                <div id="wjn_1" style="display:block;">
                    <div class="news">
                        <div class="t_news">
                            <ul>
                                @if(isset($stock_data[0]))
                                    <li><a href="/xiangqing/stock/{{$stock_data[0]->id}}"
                                           title="{{$stock_data[0]->title}}"
                                           target="_blank">{{$stock_data[0]->title}}</a></li>
                                    <span class="cc">{!!substr($stock_data[0]->content,0,100) !!}</span>
                                @else
                                    <li>暂时没有新文章!</li>
                                @endif
                            </ul>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <!--end news-->
                    <div class="list_inf">
                        <ul>
                            @foreach($stock_data as $key=>$item)
                                @if($key>0)
                                    <li><a target="_blank" href="/xiangqing/stock/{{$item->id}}"
                                           class="&#39;s&#39;">{{$item->title}}</a><span>{{ \Carbon\Carbon::parse($item->created_at)->format('Y-m-d') }}</span>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="infcon" id="wjn_2" style="display:none;">
                    <div class="news">
                        <div class="t_news">
                            <ul>
                                <li><a href="/xiangqing/futures/{{$futures_data[0]->id}}"
                                       title="{{$futures_data[0]->title}}"
                                       target="_blank">{{$futures_data[0]->title}}</a></li>
                                <span class="cc">{!!substr($futures_data[0]->content,0,100) !!}</span>
                            </ul>
                        </div>
                        <div class="clear"></div>
                        <!--end news-->
                        <div class="list_inf">
                            <ul>
                                @foreach($futures_data as $key=>$item)
                                    @if($key>0)
                                        <li><a target="_blank" href="/xiangqing/futures/{{$item->id}}"
                                               class="&#39;s&#39;">{{$item->title}}</a><span>{{ \Carbon\Carbon::parse($item->created_at)->format('Y-m-d') }}</span>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="cn_ly">
                <div class="lytit">
                    <ul class="lyul">
                        <li><a class="ck" onmouseover="tab_v(1,&#39;wjb_&#39;,&#39;wjc_&#39;,4)" id="wjb_1"
                               href="/gsys">公司优势</a></li>
                        <li><a class="" onmouseover="tab_v(2,&#39;wjb_&#39;,&#39;wjc_&#39;,4)" id="wjb_2" href="/pzlc">配资流程</a>
                        </li>
                    </ul>
                </div>
                <div class="lysub" id="wjc_1" style="display:block;">
                    <div class="s_ys">
                        <ul>
                            @foreach($company_data as $key=>$item)
                                <li>
                                    <a target="_blank" href="/xiangqing/company/{{$item->id}}"
                                       class="&#39;s&#39;">{{$item->title}}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="lysub" id="wjc_2" style="display:none;">
                    <div class="s_lc"><a href="#liucheng/"> <img src="./AmImages/lc1.jpg"></a> <a href="#liucheng/">
                            <img src="./AmImages/lc2.jpg"></a> <a href="#liucheng/"> <img src="./AmImages/lc3.jpg"></a>
                        <a href="#liucheng/"> <img src="./AmImages/lc4.jpg"></a></div>
                </div>
            </div>
        </div>
    </div>
    <div class="panel" id="slides">
        <ul class="wall1">
            <li class="banner_li mr6"><a target="_blank" href="#" title="期货配资">
                    <div class="toll_img show1"><img src="./AmImages/qh.jpg"></div>
                </a></li>
            <li class="banner_li mr6"><a href="#/" target="_blank" title="股票配资">
                    <div class="toll_img show1"><img src="./AmImages/gp.jpg"></div>
                </a></li>
            <li class="banner_li mr6"><a href="#" target="_blank" title="股指配资" style="top: 0px;">
                    <div class="toll_info show2" style="display: block;"><img src="./AmImages/gz2.jpg"></div>
                </a></li>
            <li class="banner_li"><a href="#" target="_blank" title="外盘配资" style="top: 0px;">
                    <div class="toll_info show2" style="display: block;"><img src="./AmImages/wp2.jpg"></div>
                </a></li>
        </ul>
    </div>
    <div class="main">
        <div class="congzCenter">
            <div class="navleft1"><a href="/sjgppz" target="_blank" title="股票配资"> <img src="./AmImages/gppz.jpg"></a>
            </div>
            <div class="gpfw11">
                <div class="kfj_l">
                    <div class="kf"><img src="./AmImages/kf_03.jpg"></div>
                    <div class="but">
                        <ul class="ul1">
                            <li><a href="/wypz" target="_blank">我要配资</a></li>
                        </ul>
                        <ul class="ul2">
                            <li><a href="/yyyouyu" target="_blank">月月有余</a></li>
                        </ul>
                    </div>
                </div>
                <div class="list_not2">
                    <div id="slideBox" class="slideBox">
                        <div class="hd">
                            <ul>
                                <li class=""></li>
                                <li class="on"></li>
                            </ul>
                        </div>
                        <div class="bd">
                            <div class="tempWrap" style="overflow:hidden; position:relative; ">
                                <ul style="width: 1184px; position: relative; overflow: hidden; padding: 0px; margin: 0px;">
                                    <li class="clone" style="float: left;"><a><img src="./AmImages/gp.jpg"></a></li>
                                    <li style="float: left;"><a><img src="./AmImages/gp2.jpg"></a>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <script id="jsID" type="text/javascript">
                        jQuery(".slideBox").slide({mainCell: ".bd ul", effect: "leftLoop", autoPlay: true});
                    </script>
                </div>
            </div>
            <div class="gppzRight">
                <div class="pzjd">
                    <h2><a href="/sjgppz" target="_blank">什么是股票配资</a></h2>
                    <img src="./AmImages/6.jpg"/>
                    <p>股票配资是指交易客户联系配资公司解决资金。同时约定股票交易规则，ST
                        *ST带有杠杆的是不允许交易。目前配资的市场与期货相比，股票市场份额大。为了更好的服务交易者，中国配资网还提供股票推荐服务，行情走势分析，交易账单管理等。许交易。目前配资的市场与期货相比，股票市场份额大。为了更好的服务交易者，中国配资网还提供股票推荐，行情走势分析，交易，行情走势分析，交易服务账单管理等。</p>
                </div>
                <div class="gppzleft">
                    <div class="gppzjq">
                        <div class="tit">
                            <h2><a href="/gppzjq">股票配资技巧</a></h2>
                        </div>
                        <div class="gppzinfcon">

                            <!--end news-->
                            <div class="gppzlist_inf">
                                <ul>
                                    @foreach($skill_data as $key=>$item)
                                        <li>
                                            <a target="_blank" href="/xiangqing/skill/{{$item->id}}"
                                               class="&#39;s&#39;">{{$item->title}}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="jgpl">
                        <div class="tit">
                            <h2><a href="/jgpl">机构评论</a></h2>
                        </div>
                        <div class="gppzinfcon">

                            <!--end news-->
                            <div class="gppzlist_inf">
                                <ul>
                                    @foreach($discuss_data as $key=>$item)
                                        <li>
                                            <a target="_blank" href="/xiangqing/discuss/{{$item->id}}"
                                               class="&#39;s&#39;">{{$item->title}}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="panel" id="slides">
        <ul class="wall1">
            <li class="banner_li mr6"><a target="_blank" href="#" title="期货配资">
                    <div class="toll_img show1"><img src="./AmImages/qh.jpg"></div>
                </a></li>
            <li class="banner_li mr6"><a href="#" target="_blank" title="股票配资">
                    <div class="toll_img show1"><img src="./AmImages/gp.jpg"></div>
                </a></li>
            <li class="banner_li mr6"><a href="#" target="_blank" title="股指配资" style="top: 0px;">
                    <div class="toll_info show2"><img src="./AmImages/gz2.jpg"></div>
                </a></li>
            <li class="banner_li"><a href="#" target="_blank" title="外盘配资" style="top: 0px;">
                    <div class="toll_info show2"><img src="./AmImages/wp2.jpg"></div>
                </a></li>
        </ul>
    </div>
    <div class="main">
        <div class="qhpzbottom">
            <div class="navleft282"><a href="/sjgppz" target="_blank" title="股票配资"> <img src="./AmImages/qhpz.jpg"></a>
            </div>
            <div class="gpfw11">
                <div class="kfj_l">
                    <div class="kf"><img src="./AmImages/kf_03.jpg"></a></div>
                    <div class="but">
                        <ul class="ul1">
                            <li><a href="/xzzq">下载专区</a></li>
                        </ul>
                        <ul class="ul2">
                            <li><a href="/tzxy" target="_blank">投资学院</a></li>
                        </ul>
                    </div>
                </div>
                <div class="list_not3">
                    <div id="slideBox1" class="slideBox1">
                        <div class="hd">
                            <ul>
                                <li class=""></li>
                                <li class="on"></li>
                            </ul>
                        </div>
                        <div class="bd">
                            <div class="tempWrap" style="overflow:hidden; position:relative;">
                                <ul style="width: 1184px; position: relative; overflow: hidden; padding: 0px; margin: 0px; ">
                                    <li class="clone" style="float: left;"><a><img src="./AmImages/qh2.jpg"></a></li>
                                    <li style="float: left;"><a><img src="./AmImages/qh.jpg"></a>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <script id="jsID" type="text/javascript">
                        jQuery(".slideBox1").slide({mainCell: ".bd ul", effect: "leftLoop", autoPlay: true});
                    </script>
                </div>
            </div>
            <div class="gppzRight">
                <div class="pzjd">
                    <h2><a href="/sjqhpz" target="_blank">什么是期货配资</a></h2>
                    <img src="./AmImages/5.jpg"/>
                    <p>
                        期货交易者对于行情把握较好。此时对于资金的需求比较大。期货配资的意义在于。解决期货交易者的资金需求。同时配资放大杠杆，这样交易者就需要把握住交易风险。目前配资市场发展至现在有6年时间，市场逐步在认可。欢迎全国代理与客户咨询，上门洽谈。期货交易者对于行情把握较好。此时对于资金的需求比较大。期货配资的意义在于。解决期货交易者的资金需求。同时配资放大杠杆，这样交易者就需要把握住交易风险。目前配资市场发展至现在有6年时间，市场逐步在认可。</p>
                </div>
                <div class="gppzleft">
                    <div class="qhpzleft">
                        <div class="qhpz">
                            <div class="gb_tit">
                                <ul>
                                    <li><a href="/qhpz" target="_blank">期货配资</a></li>
                                </ul>
                            </div>
                            <div class="gb_sub">
                                <ul>
                                    @foreach($funding_data as $key=>$item)
                                        <li>
                                            <a target="_blank" href="/xiangqing/funding/{{$item->id}}"
                                               class="&#39;s&#39;">{{$item->title}}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="mjgd">
                            <div class="gb_tit">
                                <ul id="myTab2">
                                    <li><a href="/mjgd" target="_blank">名家观点</a></li>
                                </ul>
                            </div>
                            <div class="gb_sub">
                                <ul>
                                    @foreach($famous_data as $key=>$item)
                                        <li>
                                            <a target="_blank" href="/xiangqing/famous/{{$item->id}}"
                                               class="&#39;s&#39;">{{$item->title}}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="qhpzpic"><img src="AmImages/4.jpg"/><img src="AmImages/4.jpg"/></div>
                </div>
            </div>
        </div>
    </div>
    <div class="main">
        <div class="titleT"><a href="#">友情链接</a></div>
        <div class=" link">
            <div class="linktext"><a href="#">第一金融网</a> <a href="#">东方财经</a> <a href="#">财经头条</a> <a href="#">中信证券</a>
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
    <div class="main-im">
        <div id="open_im" class="open-im">&nbsp;</div>
        <div class="im_main" id="im_main">
            <div id="close_im" class="close-im"><a href="javascript:void(0);" title="点击关闭">&nbsp;</a></div>
            <a href="#" class="im-qq qq-a" title="在线QQ客服"><span>在线客服</span></a>
            <div class="im-tel">
                <div>QQ</div>
                <div class="tel-num">1109310121</div>
                <div>微信</div>
                <div class="tel-num">wy986546414</div>
                <div>联系电话</div>
                <li class="tel-num2">
                    <marquee scrollamount="3" style=" margin-left:5px; margin-right:5px;">
                        18993032529
                    </marquee>
                </li>
            </div>
        </div>
    </div>
</div>
</body>
</html>