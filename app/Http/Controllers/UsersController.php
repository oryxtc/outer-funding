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
     * 计算配资
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function computeFunding(Request $request)
    {
        $A = $request->input('caution_money'); //保证金 即A
        $B = $request->input('multiple'); //倍数 即B
        $Y = $request->input('duration', 0); //持续时间 即Y

        //计算数据
        $response_data['quota']       = floatval($A * $B); //配额
        $response_data['funds']       = floatval($A * $B + $A); //总操盘资金
        $response_data['loss_cordon'] = floatval($A * $B * 1.15); //亏损警戒线
        $response_data['loss_money']  = floatval($A * $B * 1.10); //亏损平仓线
        $response_data['end_time']    = date("Y-m-d", strtotime("+" . $Y . "month"));; //结束时间
        $response_data['monthly_interest'] = $Y > 0 ? floatval($A * $B * 0.02) : 0; //月利息
        $response_data['management_fee']   = $Y > 0 ? floatval($A * $B * 0.01) : 0; //管理费
        $response_data['total_costs']      = $Y > 0 ? floatval($A * $B * 0.02 * $Y + $A * $B * 0.01 * $Y) : 0; //总费用

        return PublicController::apiJson($response_data);
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
