<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use AliDaYu;

class AliDaYuController extends Controller
{

    /**
     * 发送普通短信
     * @param $phone
     * @param $code
     * @param $type
     * @return mixed
     */
    public static function sendSms($phone, $code, $type)
    {
        $sms_param = json_encode(['code' => "$code"]);
        $sms_free_sign_name = '微亿网';    //签名
        $response_result=false;

        if ($type === 'register') {
            $sms_template_code = 'SMS_10195570';   //注册模板
        } elseif ($type === 'reset_pass') {
            $sms_template_code = 'SMS_14255752';  //找回密码模板
        } else {
            return false;
        }

        $response = AliDaYu::driver('sms')->send([
            'extend' => '',
            'sms_type' => 'normal',
            'sms_free_sign_name' => $sms_free_sign_name,
            'sms_param' => $sms_param,
            'rec_num' => $phone,
            'sms_template_code' => $sms_template_code
        ]);

        $response_data = json_decode($response->getBody()->getContents(), true);
        if(isset($response_data['alibaba_aliqin_fc_sms_num_send_response']) && $response_data['alibaba_aliqin_fc_sms_num_send_response']['result']['err_code']==0){
            $response_result=true;
        }

        return $response_result;
    }
}
