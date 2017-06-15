<?php

namespace App\Http\Controllers\Voyager;

use App\Http\Controllers\PublicController;
use Illuminate\Http\Request;

class VoyagerProfileController extends Controller
{
    /**
     * 重置密码
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function resetPass(Request $request)
    {
        $password = $request->get('password');
        if (mb_strlen($password) < 6) {
            return PublicController::apiJson([], 'failed', '密码长度最小6位!');
        }
        //密码加密
        $password = bcrypt($password);
        $id = auth('admin')->id();
        //更新数据库
        $update_result = \DB::table('administrators')
            ->where('id', $id)
            ->update(['password' => $password]);
        if ($update_result === false) {
            return PublicController::apiJson([], 'failed', '重置密码失败!');
        }
        return PublicController::apiJson([], 'success', '重置密码成功!');
    }
}