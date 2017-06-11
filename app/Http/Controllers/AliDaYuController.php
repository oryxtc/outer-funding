<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use AliDaYu;

class AliDaYuController extends Controller
{
    public static function sendSms($phone, $code, $sms_param)
    {
        $sms_param = json_encode(['code' => $code, 'name' => 'Dearmadman']);

        $response = AliDaYu::driver('sms')->send([
            'extend' => '',
            'sms_type' => 'normal',
            'sms_free_sign_name' => 'test',
            'sms_param' => $sms_param,
            'rec_num' => $phone ,
            'sms_template_code' => 'SMS_70555432'
        ]);

        return $response->getBody()->getContents();
    }
}
