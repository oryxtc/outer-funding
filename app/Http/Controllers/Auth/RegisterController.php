<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\PublicController;
use App\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Http\Controllers\ValidatorController;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware('guest');
    }


    /**
     * 注册用户
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        //验证数据
        $validator_result = $this->validator($request->all());
        if ($validator_result['status'] === false) {
            return PublicController::apiJson($validator_result['data'], 'failed');
        }
        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);

        return $this->registered($request, $user)
            ?: PublicController::apiJson([], 'success', '注册成功!');
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'phone' => $data['phone'],
            'password' => bcrypt($data['password']),
            'created_at' => time(),
        ]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        //自定义错误信息
        $message = [
            'phone.unique' => '手机号已存在!',
            'phone.required' => '请输入手机号!',
            'phone_code.required' => '请输入验证码!',
            'password.required' => '请输入密码!',
            'password.confirmed' => '两次密码不一致!',
            'password.min' => '请输入6-16位密码!',
            'password.max' => '请输入6-16位密码!',
        ];

        //验证数据类型
        $validator = Validator::make($data, [
            'phone' => 'required|numeric|unique:users',
            'phone_code' => 'required|string',
            'password' => 'required|string|min:6|max:16|confirmed',
        ], $message);
        //如果验证失败
        if ($validator->fails() === true) {
            return ['status' => false, 'data' => $validator->errors()->all()];
        }
        //验证手机注册验证码
        $validator->after(function ($validator) use ($data) {
            $validator_code_result = ValidatorController::validatorCode($data['phone'], $data['phone_code'], 'register');
            if ($validator_code_result === false) {
                $validator->errors()->add('phone_code', '验证码错误或已过期!');
            }
        });
        //如果验证失败
        if ($validator->fails() === true) {
            return ['status' => false, 'data' => $validator->errors()->all()];
        }
        return ['status' => true];
    }
}
