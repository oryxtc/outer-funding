<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>月月有余</title>
    <link href="{{asset('./AmImages/index.css')}}" rel="stylesheet" type="text/css">
    <script src="{{asset('./AmImages/jquery-1.10.1.min.js')}}"></script>
    <script language="javascript" src="{{asset('./AmImages/common.js')}}"></script>
    <!--[if lt IE 9]>
    <script src="scripts/IE9.js"></script> <![endif]-->
    {{--<script language="javascript" src="./AmImages/jquery-1.8.0.min.js"></script>--}}
    <script language="javascript" src="./AmImages/jquery-1.10.1.min.js"></script>
    <script language="javascript" src="./AmImages/tzdr.js"></script>
    <script language="javascript" src="./AmImages/preByDay.js"></script>
    <script language="javascript" src="js/bootstrap.min.js"></script>
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <script type="text/javascript">

        var basepath = '' + "/";
        var isLoginSSO = Boolean("");
        var sc_width = $(window).height();
        //if(isIE = navigator.userAgent.indexOf("MSIE")!=-1) {
        /* if(sc_width >= 780){
         loadjscssfile(basepath+'static/css/common.css','css');
         }else{
         loadjscssfile(basepath+'static/css/common.mini.css','css');
         } */
        //}
        function loadjscssfile(filename, filetype) {

            if (filetype == "js") {
                var fileref = document.createElement('script');
                fileref.setAttribute("type", "text/javascript");
                fileref.setAttribute("src", filename);
            } else if (filetype == "css") {

                var fileref = document.createElement('link');
                fileref.setAttribute("rel", "stylesheet");
                fileref.setAttribute("type", "text/css");
                fileref.setAttribute("href", filename);
            }
            if (typeof fileref != "undefined") {
                document.getElementsByTagName("head")[0].appendChild(fileref);
            }

        }
        var stockForumBasePath = 'http://bbs.tzdr.com' + "/";
        var isOpanStockForum = 'false';

        function showQQDialog() {
            window.open('http://wpa.b.qq.com/cgi/wpa.php?ln=1&uin=4000200158&curl=http://www.tzdr.com/', '在线客服', 'height=405,width=500,top=200,left=200,toolbar=no,menubar=no,scrollbars=yes, resizable=no,location=no, status=no');
        }
    </script>
</head>
<body>
@if(count($errors) > 0)
    @component('home.layouts.alert')
    @slot('status')
    success
    @endslot
    {{$errors->all()[0]}}
    @endcomponent
@endif
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
    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"
                            aria-label="Close"><span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">用户登录</h4>
                </div>
                <div class="modal-body">
                    手机号:
                    <input type="text" class="form-control" name="phone"
                           placeholder="手机哈珀" id="login-phone"
                           value="">
                    <span id="error-mes" style="color: red;display: none">用户名或密码错误!</span>
                </div>
                <div class="modal-body">
                    密码:
                    <input type="password" class="form-control" name="password"
                           placeholder="Password" id="login-password"
                           value="">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        关闭
                    </button>
                    <button type="button" class="btn btn-primary" id="login-user">登录
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="capital">

        <input type="hidden" name="type" value="1">
        <input type="hidden" name="capitalMargin" id="capitalMargin" value="10000">
        <input type="hidden" name="leverBack" id="lever" value="1">
        <input type="hidden" name="borrowPeriodBack" id="borrowPeriod" value="1">
        <input type="hidden" name="backTradeStart" id="backTradeStart" value="1">
        <input type="hidden" name="max" id="max" value="6000000.0">
        <input type="hidden" name="month" id="month">
        <input type="hidden" name="maxLever" id="maxLever" value="5">
        <input type="hidden" name="minLever" id="minLever" value="1 ">
        <input type="hidden" name="maxMonth" id="maxMonth" value="6">
        <input type="hidden" name="minMonth" id="minMonth" value="1 ">
        <input type="hidden" name="maxFunding" id="maxFunding" value="6000000.0">
        <input type="hidden" name="minFunding" id="minFunding" value="10000.0 ">
        <form method="POST" action="fundingApplication" id="funding_form">
            <input type="hidden" name="caution_money" id="caution_money" value="">
            <input type="hidden" name="multiple" id="multiple" value="1">
            <input type="hidden" name="duration" id="duration">
            <div class="capital_ctn">
                <div class="cp_main" style="border-right:1px solid #e5e5e5; margin-right:-1px;">
                    <div class="cp_m_ctn">
                        <div class="cp_m_num"><i>①</i>输入操盘保证金</div>
                        <div class="cp_m_titl">
                            <input class="font_size_22" id="tz" type="text" placeholder="1万元~600万元"
                                   onpaste="return false" autocomplete="off">
                        </div>
                        <div class="cp_m_list" id="margin">
                            <ul>
                                <li data="10000" class="on">
                                    <p><i>1万</i>元</p>
                                </li>
                                <li data="100000">
                                    <p><i>10万</i>元</p>
                                </li>
                                <li data="300000" class="">
                                    <p><i>30万</i>元</p>
                                </li>
                                <li data="500000" class="">
                                    <p><i>50万</i>元</p>
                                </li>
                                <li data="1000000" class="">
                                    <p><i>100万</i>元</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="cp_m_ctn">
                        <h3 style="display: none;" id="lever_notify">输入倍数(<span id="min_lever">1</span><span
                                    id="link">-</span><span id="max_lever">5</span>倍)</h3>
                        <div class="cp_m_num"><i>②</i>选择操盘倍数</div>
                        <div class="cp_m_titl" style="display:none;">
                            <input class="font_size_15" id="pzgg" name="lever" type="text" placeholder="1~5倍"
                                   onpaste="return false" autocomplete="off">
                        </div>
                        <div class="cp_m_list" id="capital_lever">
                            <ul class="cp_m_mul">
                                <li data="1" class="" value="1">
                                    <p><i>1倍</i></p>
                                </li>
                                <li data="2" class="" value="2">
                                    <p><i>2倍</i></p>
                                </li>
                                <li data="3" class="" value="3">
                                    <p><i>3倍</i></p>
                                </li>
                                <li data="4" class="" value="4">
                                    <p><i>4倍</i></p>
                                </li>
                                <li data="5" class="" value="5">
                                    <p><i>5倍</i></p>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="cp_m_ctn">
                        <div class="cp_m_num"><i>③</i>选择操盘月数<em
                                    style="font-size: 14px; color: #999">（1个月统一为30天，含节假日）</em></div>
                        <div class="cp_m_titl" style="height:0px">
                            <input class="font_size_15" type="hidden" id="use_day" name="borrowPeriod"
                                   placeholder="2~180天" onpaste="return false" autocomplete="off" value="">
                        </div>
                        <div class="cp_m_list" id="match_days">
                            <ul class="cp_m_dur">
                                <li data="1" style="background:#fff;" value="1">
                                    <p><i>1月</i></p>
                                </li>
                                <li data="2" style="background:#fff;" value="2">
                                    <p><i>2月</i></p>
                                </li>
                                <li data="3" style="background:#fff;" value="3">
                                    <p><i>3月</i></p>
                                </li>
                                <li data="4" style="background:#fff;" value="6">
                                    <p><i>6月</i></p>
                                </li>
                                <li data="5" style="background:#fff;" value="12">
                                    <p><i>12月</i></p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="cp_sider">
                    <div class="cp_m_num"><i>④</i>确认操盘规则<a href="#" target="_blank">今日限制股</a><a href="#" target="_blank"
                                                                                                style="margin-right:20px;">当前风控等级</a>
                    </div>
                    <div class="cp_sdfont">
                        <label>操盘须知：</label>
                        <span id="notify">仓位不限制，盈利全归您。</span></div>
                    <div class="cp_sdfont">
                        <label>操盘配额：</label>
                        <span><i id="pzje"></i>元</span>
                        <div class="uc_pay_promt uc_pay_promt1" style="display: none;"><i class="uc_pp_arrow"></i>
                            <p>借给您炒股的资金。</p>
                        </div>
                    </div>
                    <div class="cp_sdfont">
                        <label>总操盘资金：</label>
                        <span><i id="zcpzj"></i>元</span>
                        <div class="uc_pay_promt uc_pay_promt1" style="display: none;"><i class="uc_pp_arrow"></i>
                            <p>操盘保证金+操配额。</p>
                        </div>
                    </div>
                    <div class="cp_sdfont">
                        <label>亏损警戒线：</label>
                        <span><i id="ksbcx"></i>元</span>
                        <div class="uc_pay_promt uc_pay_promt2" style="display: none;"><i class="uc_pp_arrow"></i>
                            <p>当总操盘资金低于警戒线以下时，只能平仓不能建仓，需要尽快补充风险保证金，以免低于亏损平仓线被平仓。</p>
                        </div>
                    </div>
                    <div class="cp_sdfont">
                        <label>亏损平仓钱：</label>
                        <span><i id="kspcx"></i>元</span>
                        <div class="uc_pay_promt uc_pay_promt2" style="display: none;"><i class="uc_pp_arrow"></i>
                            <p>当总操盘资金低于平仓线以下时，我们将有权把您的股票进行平仓，为避免平仓发生，请时刻关注风险保证金是否充足。</p>
                        </div>
                    </div>
                    <div class="cp_sdfont">
                        <label>预计结束时间：</label>
                        <span><i id="end_day"></i></span>
                        <div class="uc_pay_promt uc_pay_promt5" style="display: none;"><i class="uc_pp_arrow"></i>
                            <p>从今天到您选择操盘天数的实际日期。</p>
                        </div>
                    </div>
                    <div class="cp_sdfont">
                        <label>月利息：</label>
                        <span class=""><i id="monthly_interest"></i>元</span>
                    </div>
                    <div class="cp_sdfont">
                        <label>管理费：</label>
                        <span class=""><i id="management_fee"></i>元</span>
                    </div>
                    <div class="cp_sdfont">
                        <label>总操盘费用：</label>
                        <span class=""><i id="lx"></i>元</span>
                    </div>
                </div>
                <div class="cp_bom">
                    <p>如您不清楚规则，或有其他疑问，请联系客服：0931-8500903</p>
                    <div class="cp_b_btn"><a href="javascript:void(0);" id="submit">提交操盘申请</a></div>
                    <div class="cp_b_link">
                        <input type="checkbox" checked="checked" id="agree">
                        <span>我已阅读并同意<a href="javascript:tradeContract(1);">《月月操盘合作协议》</a><a
                                    href="javascript:tradeContract(2);">《风险提示书》</a></span></div>
                    <p style="color:#f00; display:none;">配股宝遵守证监会新规，现暂停股票操盘业务，有疑问请联系客服：400-633-9257</p>
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
<script type="application/javascript">
    var computeFunding = function () {
        var caution_money = Number($('#tz').val().replace(/\,/g, ''));
        var multiple = $('.cp_m_mul .on').val()
        var duration = $('.cp_m_dur .on').val()
        //表单赋值
        $("#caution_money").val(caution_money)
        $("#multiple").val(multiple)
        $("#duration").val(duration)
        var request_data = {"caution_money": caution_money, "multiple": multiple, "duration": duration};
        $.post('/computeFunding', request_data, function (data) {
            if (data.status === 'success') {
                $("#pzje").text($.formatMoney(data.data.quota));
                $("#zcpzj").text($.formatMoney(data.data.funds));
                $("#ksbcx").text($.formatMoney(data.data.loss_cordon));
                $("#kspcx").text($.formatMoney(data.data.loss_money));
                $("#end_day").text(data.data.end_time);
                $("#monthly_interest").text($.formatMoney(data.data.monthly_interest));
                $("#management_fee").text($.formatMoney(data.data.management_fee));
                $("#lx").text($.formatMoney(data.data.total_costs));
            }
        })
    }
    $(function () {
        computeFunding();
        $('#tz').keyup(function () {
            computeFunding();
        })
        $('#margin ul li').click(function () {
            computeFunding();
        });
        $('#capital_lever ul li').click(function () {
            computeFunding();
        });
        $('#match_days ul li').click(function () {
            computeFunding();
        });

        $("#submit").click(function () {
            //判断是否登录
            var isLogin = $("#isLogin").val()
            if (isLogin == true) {
                $('#funding_form').submit();
            } else {
                console.log(11);
                $('#myModal').modal()
            }
        })

        $("#login-user").click(function () {
            var phone=$("#login-phone").val()
            var password=$("#login-password").val()
            var requestData={"phone":phone,"password":password};
            $.post('/login',requestData,function (data) {
                if(data.status==='success'){
                    $('#funding_form').submit();
                }else {
                    $('#error-mes').show().delay(4000).hide(0)
                }
            })
        })
    })
</script>