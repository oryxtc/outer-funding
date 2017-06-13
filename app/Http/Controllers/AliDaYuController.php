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
     * @return mixed
     */
    public static function sendSms($phone, $code)
    {
        $sms_param = json_encode(['code' => "$code", 'name' => 'Dearmadman']);

        $response = AliDaYu::driver('sms')->send([
            'extend' => '',
            'sms_type' => 'normal',
            'sms_free_sign_name' => '配资网',
            'sms_param' => $sms_param,
            'rec_num' => $phone ,
            'sms_template_code' => 'SMS_70555432'
        ]);

        $response_data=json_decode($response->getBody()->getContents(),true);
        //错误码  0为成功
        $error_code=$response_data['alibaba_aliqin_fc_sms_num_send_response']['result']['err_code'];

        return $error_code==0;
    }
}
