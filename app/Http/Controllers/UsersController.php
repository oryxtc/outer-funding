<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class UsersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * 实名认证
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function verifiedUser(Request $request)
    {
        $request_data = $request->all();
        //验证数据
        $validator_result = $this->validator($request_data);
        if ($validator_result['status'] === false) {
            return PublicController::apiJson($validator_result['data'], 'failed');
        }
        //准备数据
        $id          = \Auth::id();
        $actual_name = $request_data['actual_name'];
        $id_card     = $request_data['id_card'];
        //更新数据
        $update_result = \DB::table('users')
            ->where([['id', $id]])
            ->update(['actual_name' => $actual_name, 'id_card' => $id_card]);
        if ($update_result === false) {
            return PublicController::apiJson([], 'failed', '实名认证失败!');
        }
        return PublicController::apiJson([], 'success', '实名认证成功!');
    }

    /**
     * 验证验证码
     * @param array $data
     * @return mixed
     */
    protected function validator(array $data)
    {
        //自定义错误信息
        $message = [
            'actual_name.required' => '真实姓名不能为空!',
            'id_card.required' => '身份证号不能为空!',
        ];
        //验证数据类型
        $validator = Validator::make($data, [
            'actual_name' => 'required|string',
            'id_card' => 'required|string',
        ], $message);
        //如果验证失败
        if ($validator->fails() === true) {
            return ['status' => false, 'data' => $validator->errors()->all()];
        }
        return ['status' => true];
    }
}
