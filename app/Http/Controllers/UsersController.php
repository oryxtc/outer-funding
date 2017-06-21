<?php

namespace App\Http\Controllers;

use cszchen\citizenid\Parser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class UsersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except(['showFunding','computeFunding','verifiedUser']);
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
        $validator = $this->validator($request_data);
        if ($validator->fails()) {
            return PublicController::apiJson($validator->errors()->all(),'failed');
        }
        //准备数据
        $id = \Auth::id();
        $actual_name = $request_data['actual_name'];
        $id_card = $request_data['id_card'];
        //更新数据
        $update_result = \DB::table('users')
            ->where([['id', $id]])
            ->update(['actual_name' => $actual_name, 'id_card' => $id_card]);
        if ($update_result === false) {
            return PublicController::apiJson([],'failed','认证失败!');
        }
        return PublicController::apiJson();
    }

    /**
     * 计算配资
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function computeFunding(Request $request)
    {
        $A = $request->input('caution_money'); //保证金 即A
        $B = $request->input('multiple', 1); //倍数 即B
        $Y = $request->input('duration', 0); //持续时间 即Y

        $data = $this->fundingConfig($A, $B, $Y);

        return PublicController::apiJson($data);
    }

    /**
     * 认证用户
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function securityInfo()
    {

        $actual_name = auth()->user()->actual_name;
        $id_card = auth()->user()->id_card;
        $haveVerified = true;
        if (empty($actual_name) || empty($id_card)) {
            $haveVerified = false;
        }
        return view('home.securityInfo', ['haveVerified' => $haveVerified]);
    }

    public function showFunding(Request $request)
    {
        return view('home.yyyouyu');
    }

    /**
     * 配资申请
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function fundingApplication(Request $request)
    {
        $A = $request->input('caution_money'); //保证金 即A
        $B = $request->input('multiple', 1); //倍数 即B
        $Y = $request->input('duration', 0); //持续时间 即Y
        //验证数据
        $validator = $this->validatorFunding($request->all());
            if ($validator->fails()) {
            return redirect('/yyyouyu');
        }
        //验证是否实名认证
        $user_info = \DB::table('users')
            ->select('actual_name', 'id_card', 'phone')
            ->where('id', \Auth::id())
            ->first();
        if (empty($user_info->actual_name) || empty($user_info->id_card)) {
            return redirect('/securityInfo');
        }
        $date = date('Y-m-d H:i:s', time());
        //准备数据
        $data = $this->fundingConfig($A, $B, $Y);
        $data['user_id'] = \Auth::id();
        $data['phone'] = $user_info->phone;
        $data['id_card'] = $user_info->id_card;
        $data['actual_name'] = $user_info->actual_name;
        $data['caution_money'] = $A;
        $data['multiple'] = $B;
        $data['duration'] = $Y;
        $data['duration'] = $Y;
        $data['created_at'] = $date;
        $data['updated_at'] = $date;
        //存入数据库
        $save_result = \DB::table('fundings')
            ->insert($data);
        if ($save_result === false) {
            return redirect('/yyyouyu');
        }
        return redirect('/')
            ->withErrors(['success'=>'您的操盘方案已经提交成功，等待审核!']);
    }

    /**
     * 验证配资提交信息
     * @param array $data
     * @return mixed
     */
    protected function validatorFunding(array $data)
    {
        //自定义错误信息
        $message = [
            'caution_money.required' => '保证金不能为空!',
            'caution_money.min' => '保证金至少大于1!',
            'multiple.required' => '倍数不能为空!',
            'multiple.min' => '倍数至少一倍!',
            'duration.required' => '持续时间不能为空!',
            'duration.min' => '操盘最少一个月!',
        ];
        //验证数据类型
        $validator = Validator::make($data, [
            'caution_money' => 'required|numeric|min:1',
            'multiple' => 'required|numeric|min:1',
            'duration' => 'required|numeric|min:1',
        ], $message);
        return $validator;
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
            'actual_name.string' => '请输入正确的姓名!',
            'id_card.required' => '身份证号不能为空!',
            'id_card.regex' => '身份证号格式错误!',
        ];
        //验证数据类型
        $validator = \Validator::make($data, [
            'actual_name' => 'required|string',
            'id_card' => 'required',
            'id_card' => ['regex:/^\d[{14}|{17}](\d|x)$/i'],
        ], $message);

        //如果验证失败
        return $validator;
    }

    /**
     * 配资配置计算
     * @param $A 保证金
     * @param $B 倍数
     * @param $Y 持续时间(月)
     * @return mixed
     */
    private function fundingConfig($A, $B, $Y)
    {
        //计算数据
        $data['quota'] = floatval($A * $B); //配额
        $data['funds'] = floatval($A * $B + $A); //总操盘资金
        $data['loss_cordon'] = floatval($A * $B * 1.15); //亏损警戒线
        $data['loss_money'] = floatval($A * $B * 1.10); //亏损平仓线
        $data['end_time'] = date("Y-m-d", strtotime("+" . $Y . "month +1day"));; //结束时间
        $data['monthly_interest'] = $Y > 0 ? floatval($A * $B * 0.02) : 0; //月利息
        $data['management_fee'] = $Y > 0 ? floatval($A * $B * 0.01) : 0; //管理费
        $data['total_costs'] = $Y > 0 ? floatval($A * $B * 0.02 * $Y + $A * $B * 0.01 * $Y) : 0; //总费用

        return $data;
    }

}
