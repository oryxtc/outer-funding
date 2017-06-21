<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>实名认证</title>

    <link href="./AmImages/user.css" rel="stylesheet" type="text/css">
    <script src="./AmImages/jquery-1.10.1.min.js"></script>
    <script language="javascript" src="./AmImages/common.js"></script>
    <!--[if lt IE 9]>
    <script src="scripts/IE9.js"></script> <![endif]-->
    <script type="text/javascript" src="./AmImages/securityInfo.js"></script>
</head>
<body>
<script>

    function MaskControl() {
        this.show = function (html) {
            var loader = $("#div_maskContainer");
            if (loader.length == 0) {
                loader = $("<div id='div_maskContainer'><div id='div_Mask' ></div><div id='div_loading' ></div></div>");
                $("body").append(loader);
            }
            self.loader = loader;
            var w = $(window).width();
            var h = $(window).height();
            var divMask = $("#div_Mask");
            divMask.css("top", 0).css("left", 0).css("width", w).css("height", h);
            var tipDiv = $("#div_loading");
            if (html == undefined)
                html = "";
            tipDiv.html(html);
            loader.show();
            var x = (w - tipDiv.width()) / 2;
            var y = (h - tipDiv.height()) / 2;
            tipDiv.css("left", x);
            tipDiv.css("top", y);
        },
                this.hide = function () {
                    var loader = $("#div_maskContainer");
                    if (loader.length == 0) return;
                    loader.remove();
                },
                this.autoDelayHide = function (html, timeOut) {
                    var loader = $("#div_maskContainer");
                    if (loader.length == 0) {
                        this.show(html);
                    }
                    else {
                        var tipDiv = $("#div_loading");
                        tipDiv.html(html);
                    }
                    if (timeOut == undefined) timeOut = 3000;
                    window.setTimeout(this.hide, timeOut);
                }

    }


    function bandcard() {
        var idcard = '';
        if (idcard != "") {
            window.location.href = basepath + "/draw/drawmoney?tab=1";
        } else {
            showMsgDialog("提示", "请先进行实名认证");
        }
    }


</script>
@if(count($errors) > 0)
    @component('home.layouts.alert')
    @slot('status')
    danger
    @endslot
    {{$errors->all()[0]}}
    @endcomponent
@endif
<div id="div_Mask" style="display:none;"></div>
{{--导航面包屑--}}
@include('home.layouts.islogin')
<div class="wapper">
    <div class="top">
        <div class="top2"><a href="/index" title="股票配资网"><img src="./AmImages/logo.png" alt="股票配资网"> </a></div>
        <div class="top3">
            <div class="top3_box">
                <ul class="top3_nav">
                    <li><a href="/index">首页</a></li>
                    <li><a>关于我们</a><img alt="关于我们" src="./AmImages/top3_icon.png">
                        <div class="top3_popnav" style="display: none;"><a href="/gsjs">公司介绍</a> <a
                                    href="/qywh">企业文化</a> <a href="/qyfc">企业风采</a></div>
                    </li>
                    <li><a>我要配资</a><img alt="我要配资" src="./AmImages/top3_icon.png">
                        <div class="top3_popnav" style="display: none;"><a href="/wypz" target="_blank">我要配资</a> <a
                                    href="/yyyouyu">月月有余</a></div>
                    </li>
                    <li><a>股票配资</a><img alt="股票配资" src="./AmImages/top3_icon.png">
                        <div class="top3_popnav" style="display: none;"><a href="/sjgppz">啥叫股票配资</a> <a href="/gpzx">股票咨询</a>
                        </div>
                    </li>
                    <li><a>期货配资</a><img alt="期货配资" src="./AmImages/top3_icon.png">
                        <div class="top3_popnav" style="display: none;"><a href="/sjqhpz">啥叫期货配资</a></div>
                    </li>
                    <li><a href="/tzxy">投资学院</a></li>
                    <li><a href="/xzzq">下载专区</a></li>
                </ul>
            </div>
        </div>
    </div>

    <!-- notice -->

    <!-- 浮动层 -->
    <!--弹出框-->
    <div id="div_loading">
        <!--001-->
        <div class="tck01" id="idcardDiv" style="display: none;" display="block">
            <div class="navtitle"><a class="nava" style="width:90px;">实名认证</a><a class="close"
                                                                                 onclick="javascript:closeDiv(&#39;idcardDiv&#39;)"></a>
            </div>
            <div class=" wzms"> 实名信息提交后不可修改，请务必认真填写真实资料

                一个身份证只能绑定一个账号。

                如遇到问题，请联系客服 0931-8500903
            </div>
            <form action="/verifiedUser" method="post" id="verified">
                <div class="smain">
                    <div class="srk"><span class="label">真实姓名：</span>
                        <input class="au-ipt" name="actual_name" id="actual_name" type="text"><span></span>
                    </div>
                    <div class="srk"><span class="label">身份证号：</span>
                        <input class="au-ipt" name="id_card" id="id_card" type="text"><span></span>
                    </div>
                </div>
                <!--001-1-->
                <div class="anniu" style="margin-left: 75px"><a class="btn-h01" id="validating">提&nbsp;交</a><a
                            class="btn-h02" onclick="javascript:closeDiv(&#39;idcardDiv&#39;)">取&nbsp;消</a></div>
            </form>
        </div>
    </div>

    <!--弹出框-->
    <div class="centmain">
        <div class="uc_sidebar">
            <h2 id="oAccount" style="cursor: pointer;"><a href="#">用户管理<i>&gt;</i></a></h2>
            <div class="uc_nav">
                <ul>
                    <li><a id="toUserInfo" href="/userinfo" class="icon6">个人信息</a><i>&gt;</i></li>
                    <li><a id="security" href="/securityInfo" class="icon7 on">安全信息</a><i>&gt;</i></li>
                </ul>
            </div>
        </div>

        <!--个人中心导航 -->

        <div class="rightmain">
            <div class="nav">实名认证</div>
            <div class="conner">
                <ul>

                    <!--未实名验证状态-->
                    <li>

                        <div class="con_ifo left">
                            <div class="con_i">
                                @if($haveVerified)
                                    <img src="./AmImages/security_yes.png">
                                @else
                                    <img src="./AmImages/security_no.png">
                                @endif
                            </div>
                        </div>
                        <div class="con_name left">
                            <h3>实名认证</h3>
                        </div>
                        <div class="con_con left">
                            <p>实名认证后，才能申请操盘方案</p>
                        </div>
                        <div class="con_img left">
                            @if($haveVerified)
                                <div class="con_ren"><a href="javascript:void(0);"><img
                                                src="./AmImages/person.gif"></a>
                                </div>
                            @else
                                <div class="con_ren"><a href="javascript:authcard();"><img
                                                src="./AmImages/security_1.png"></a>
                                </div>
                            @endif
                        </div>
                    </li>
                </ul>
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
<div class="alert alert-success" role="alert" hidden>已成功申请认证!</div>
</body>
</html>
<script type="application/javascript">
    $(function () {
        $("#validating").click(function (e) {
            var actual_name=$("#actual_name").val();
            var id_card=$("#id_card").val();
            var request_data={"actual_name":actual_name,"id_card":id_card}
            $.post('/verifiedUser',request_data,function (data) {
                if(data.status!='success'){
                    if(data.data[0]==='真实姓名不能为空!' || data.data[1]==='请输入正确的姓名!'){
                        var actual_name_mes=data.data[0];
                        var id_card_mes=data.data[1];
                    }else{
                        var id_card_mes=data.data[0];
                    }
                    $("#actual_name+span").html("&nbsp;"+actual_name_mes)
                    $("#id_card+span").html("&nbsp;"+id_card_mes)
                }else {
                    $(".alert-success").show().delay(3000).hide(0)
                }
            })
        });
    })
</script>