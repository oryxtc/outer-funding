<?php

namespace App\Http\Controllers\Voyager;

use App\Http\Controllers\PublicController;
use Illuminate\Http\Request;

class VoyagerAdministratorsController extends Controller
{
    /**
     * 重置密码
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function resetPass(Request $request,$id)
    {

        //检查有没有权限
        if(\Voyager::can('edit_administrators')===false){
            return PublicController::apiJson([], 'failed', '你有没操作权限!');
        }
        $password = $request->get('password');
        if (mb_strlen($password) < 6) {
            return PublicController::apiJson([], 'failed', '密码长度最小6位!');
        }
        //密码加密
        $password = bcrypt($password);
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