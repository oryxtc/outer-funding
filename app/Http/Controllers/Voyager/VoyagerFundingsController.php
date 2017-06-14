<?php

namespace App\Http\Controllers\Voyager;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VoyagerFundingsController extends Controller
{
    /**
     * 审核配资
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function funding(Request $request, $id)
    {
        //当前管理员id
        $administrator_id = auth('admin')->id();
        if (empty($administrator_id)) {
            return redirect()
                ->route("voyager.fundings.index")
                ->with([
                    'message' => "审核失败!",
                    'alert-type' => 'error',
                ]);
        }
        //修改表数据
        $update_result = \DB::table('fundings')
            ->where([['id', $id]])
            ->update(['administrator_id' => $administrator_id, 'comply_at' => date('Y-m-d H:i:s', time()), 'status' => 1]);
        if ($update_result === false) {
            return redirect()
                ->route("voyager.fundings.index")
                ->with([
                    'message' => "审核失败!",
                    'alert-type' => 'error',
                ]);
        }
        return redirect()
            ->route("voyager.fundings.index")
            ->with([
                'message' => "审核成功!",
                'alert-type' => 'success',
            ]);
    }
}