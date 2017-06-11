<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\ValidatorController;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }


    /**
     * 重置密码
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function resetPassword(Request $request)
    {
        $request_data = $request->all();
        //验证数据
        $this->validator($request_data)->validate();
        //更新用户密码
        $update_result = \DB::table('users')
            ->where(['phone' => $request_data['phone']])
            ->update(['password' => bcrypt($request_data['password'])]);
        if ($update_result === false) {
            return PublicController::apiJson([], 'failed', '重置密码失败!');
        }

        return PublicController::apiJson([], 'success', '重置密码成功!');
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
            'phone.exists' => '用户不存在!',
            'password.confirmed' => '两次密码不一致!',
        ];

        //验证数据类型
        $validator = Validator::make($data, [
            'phone'      => 'required|numeric|exists:users,phone',
            'phone_code' => 'required|string',
            'password'   => 'required|string|min:6|max:16|confirmed',
        ], $message);

        //验证手机注册验证码
        $validator->after(function ($validator) use ($data) {
            $validator_code_result = ValidatorController::validatorCode($data['phone'], $data['phone_code'], 'reset_pass');
            if ($validator_code_result === false) {
                $validator->errors()->add('phone_code', '验证码错误!');
            }
        });
        return $validator;
    }
}
