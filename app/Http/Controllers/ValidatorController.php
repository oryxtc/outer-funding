<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ValidatorController extends Controller
{
    /**
     * 验证 验证码
     * @param $phone
     * @param $phone_code
     * @param $type
     * @return bool
     */
    public static function validatorCode($phone, $phone_code, $type)
    {
        $result = \DB::table('validator_code')
            ->select('code')
            ->where([['phone', $phone], ['type', $type], ['updated_at', '>=', date('Y-m-d H:i:s', time() - 300)]])
            ->orderBy('created_at', 'desc')
            ->first();
        $code = $result['code'];
        return $code == $phone_code;
    }

    /**
     * 发送验证码
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendValidatorCode(Request $request)
    {
        $request_data = $request->all();
        //准备数据
        $phone = $request_data['phone'];
        $type = $request_data['type'];
        $data=date('Y-m-d H:i:s', time());
        $code=rand(1000,9999);
        //发送阿里大鱼 TODO

        //如果发送成功 记录
        $save_result = \DB::table('validator_code')
            ->insert(['phone'=>$phone,'type'=>$type,'code'=>$code,'created_at'=>$data,'updated_at'=>$data]);
        if($save_result===false){
            return PublicController::apiJson([],'failed','发送验证码失败!');
        }
        return PublicController::apiJson();
    }
}
