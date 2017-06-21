<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta name="renderer" content="webkit">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>找回密码</title>
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
    <div class="resetpassword register">
        <h3>密码重置<p id="rightP" style="width:150px;text-align:right; margin-top:-15px; *margin-top:-34px;">没有账号？<a
                        href="/register">立即注册</a></p></h3>
        <form class="form" action="/password/reset" method="post">
            <ul class="rg_list">
                <li><i>*</i>
                    <label>手机号码</label>
                    <input type="text" class="phone rg_l_ip rg_l_iperror" id="phone" name="phone" maxlength="11">
                    @if ($errors->has('phone'))
                        <span class="rg_l_error">{{ $errors->first('phone') }}</span>
                    @endif
                </li>
                <li><i>*</i>
                    <label>手机验证</label>
                    <input type="text" class="rg_l_codeip rg_l_tlcode rg_l_ip" id="phone_code" name="phone_code" maxlength="6">
                    <span class="rg_l_promt" style="display: none">请先获取验证码</span>
                    <!-- <a href="javascript:void(0);" status="true" id="getCode" name="getCode" class="rg_l_codebtn">获取验证码</a> -->
                    <a id="push_phone_code" href="javascript:void(0);" status="true" id="openYZMBox" name="openYZMBox"
                       class="rg_l_codebtn"
                       onclick="">获取验证码</a>
                    @if ($errors->has('phone_code'))
                        <span class="rg_l_error">{{ $errors->first('phone_code') }}</span>
                    @endif
                </li>
                <li><i>*</i>
                    <label>新密码</label>
                    <input type="password" class="rg_l_password rg_l_ip" id="password" name="password"
                           maxlength="16">
                    <span class="rg_l_promt" style="display: none">6-16位数字和字母组成</span>
                    @if ($errors->has('password'))
                        <span class="rg_l_error">{{ $errors->first('password') }}</span>
                    @endif
                </li>
                <li><i>*</i>
                    <label>确认密码</label>
                    <input type="password" class="rg_l_password rg_l_ip" id="affirmpassword"
                           name="password_confirmation"
                           maxlength="16">
                    <span class="rg_l_promt" style="display: none">请再输入一次您设置的密码</span>
                    @if ($errors->has('password_confirmation'))
                        <span class="rg_l_error">{{ $errors->first('password_confirmation') }}</span>
                    @endif
                    {{--<p style="display: none;" class="rg_l_error">两次密码不一致</p>--}}
                </li>
            </ul>
            <div class="rg_btn">
                <a status="true" id="signin" name="signin" href="javascript:void(0);" onclick="$('.form').submit()">确认重置</a>
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
<script type="application/javascript">
    $(function () {
        var countdown=60;
        function settime(val) {
            console.log(val)
            if (countdown == 0) {
                val.attr("disabled", false);
                val.text("重新发送");
                val.css({
                    "background":"#fe8836"
                });
                countdown = 60;
                return false;
            } else {
                val.attr("disabled", true);
                val.text("正在获取"+countdown);
                val.css({
                    "background":"#ccc"
                });
                countdown--;
            }
            setTimeout(function() {
                settime(val);
            },1000);
        }
        
        $('#push_phone_code').click(function () {
            var phone=$('#phone').val();
            var type='reset_pass';
            var btn=$(this);
            $.post('/sendValidatorCode',{"phone":phone,"type":type},function (data) {
                settime(btn)
            })
        })
    })
</script>