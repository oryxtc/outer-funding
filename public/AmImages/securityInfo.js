var waittime = 60;
var flag = true;
var timeid;
$(document).ready(function () {

    $("#security").parent().addClass("on");
    // $("#toupdatephone").live("click", function (event) {
    //     event.stopPropagation();
    //     updateMobile();
    // });


    $("#security").addClass('on');

});
//立即开始实名认证
function authcard() {
    $("#cardname").val("");
    $("#idcard").val("");
    var obj = new MaskControl();
    var cardcontent = $("#idcardDiv").html();
    $("#idcardDiv").attr("display", "block");
    $("#cardname").val("");
    $("#idcard").val("");
    $("#idcardDiv").css("display", "block");
    $("#div_Mask").show();
    //var url=basepath+"static/toBindingPhone.jsp";
    //showPageDialog(url,'rrr',677,477);
}

//验证身份证
function validateCard() {

    var name = $("#cardname").val();
    var card = $("#idcard").val();
    if (name == "") {
        $("#cardname").focus();
        $.alertTip($("#cardname"), "姓名不能为空");

        return;
    }
    if (card == "") {
        $("#idcard").focus();
        $.alertTip($("#idcard"), "身份证号码不能为空");

        return;
    }
    if (checkCard(card) == false) {
        $("#idcard").focus();
        $.alertTip($("#idcard"), "身份证号码数据不对");

        return;
    }
    $("#validating").text("正在验证");
    $.post(basepath + "securityInfo/validateCard", {"name": name, "card": card}, function (data) {
        if (data.success) {
            $("#validating").text("提交");
            if (data.message != "" && data.message != null) {
                if (data.message == "false") {
                    $.alertTip($("#idcard"), "身份证信息错误");

                } else if (data.message == "maxnum") {
                    $.alertTip($("#idcard"), "身份证验证失败超过3次,请与客服联系");
                } else if (data.message == "exsit") {
                    $.alertTip($("#idcard"), "身份证已经存在");

                } else if (data.message == "haveRealName") {
                    $.alertTip($("#idcard"), "已是实名状态,不能重复实名");

                } else {
                    /*$("#idcardDiv").css("display","none");
                     var hml="<a class='colorred font14 fontarail '>"+data.message+
                     "</a><a class='color34b3e0 font14 mglt10' href='javascript:toupdateCardFile();'>上传照片</a>";
                     $("#cardInfo").html(hml);*/
                    $("#div_Mask").hide();
                    alert('验证成功');
                    window.location.href = basepath + "securityInfo/secInfo";

                }
            }

        }
    }, "json");

}

//关闭div
function closeDiv(id) {
    $("#div_Mask").hide();
    $("#" + id).css("display", "none");
}

checkpwd = function (password) {
    if (password == null || password.length <= 0 || !/^[0-9a-zA-Z]{6,16}$/.test(password) || password.length != $.trim(password).length) {

        return false;
    } else if (!/[0-9]{1,}/.test(password) || !/[a-zA-Z]{1,}/.test(password)) {

        return false;
    } else if (password.length < 6 || password.length > 20) {

        return false;
    }
    return true;
}
isEmail = function (email) {
    return email && /^[0-9a-zA-Z_\-]+@[0-9a-zA-Z_\-]+\.\w{1,5}(\.\w{1,5})?$/.test(email);
}

isMobile = function (mobile) {
    return mobile && /^1[3-9]\d{9}$/.test(mobile);
},
//验证身份证
    checkCard = function (card) {
        //是否为空
        if (card === '') {
            return false;
        }
        //校验长度，类型
        if (isCardNo(card) === false) {
            return false;
        }

        //校验生日
        if (checkBirthday(card) === false) {
            return false;
        }
        //检验位的检测
        if (checkParity(card) === false) {
            return false;
        }
        return true;
    };


//检查号码是否符合规范，包括长度，类型
isCardNo = function (card) {
    //身份证号码为15位或者18位，15位时全为数字，18位前17位为数字，最后一位是校验位，可能为数字或字符X
    var reg = /(^\d{15}$)|(^\d{17}(\d|X)$)/;
    if (reg.test(card) === false) {
        return false;
    }
    return true;
};


//检查生日是否正确
checkBirthday = function (card) {
    var len = card.length;
    //身份证15位时，次序为省（3位）市（3位）年（2位）月（2位）日（2位）校验位（3位），皆为数字
    if (len == '15') {
        var re_fifteen = /^(\d{6})(\d{2})(\d{2})(\d{2})(\d{3})$/;
        var arr_data = card.match(re_fifteen);
        var year = arr_data[2];
        var month = arr_data[3];
        var day = arr_data[4];
        var birthday = new Date('19' + year + '/' + month + '/' + day);
        return verifyBirthday('19' + year, month, day, birthday);
    }
    //身份证18位时，次序为省（3位）市（3位）年（4位）月（2位）日（2位）校验位（4位），校验位末尾可能为X
    if (len == '18') {
        var re_eighteen = /^(\d{6})(\d{4})(\d{2})(\d{2})(\d{3})([0-9]|X)$/;
        var arr_data = card.match(re_eighteen);
        var year = arr_data[2];
        var month = arr_data[3];
        var day = arr_data[4];
        var birthday = new Date(year + '/' + month + '/' + day);
        return verifyBirthday(year, month, day, birthday);
    }
    return false;
};
function clearCount() {
    emailflag = true;
    flag = true;
    clearTimeout(timeid);
    clearTimeout(emailtimeid);
}

//15位转18位身份证号
changeFivteenToEighteen = function (card) {
    if (card.length == '15') {
        var arrInt = new Array(7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2);
        var arrCh = new Array('1', '0', 'X', '9', '8', '7', '6', '5', '4', '3', '2');
        var cardTemp = 0, i;
        card = card.substr(0, 6) + '19' + card.substr(6, card.length - 6);
        for (i = 0; i < 17; i++) {
            cardTemp += card.substr(i, 1) * arrInt[i];
        }
        card += arrCh[cardTemp % 11];
        return card;
    }
    return card;
};