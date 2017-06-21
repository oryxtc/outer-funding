<?php

namespace App\Http\Controllers\Voyager;

use App\Http\Controllers\PublicController;
use Illuminate\Http\Request;

class VoyagerUsersController extends Controller
{

    /**
     * 实名认证
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function verified(Request $request)
    {
       $user_id=$request->get('userId');
        if(empty($user_id)){
            return PublicController::apiJson([],'failed');
        }
        $update_res=\DB::table('users')
            ->where('id',$user_id)
            ->update(['status'=>10]);
        if($update_res===false){
            return PublicController::apiJson([],'failed');
        }
        return PublicController::apiJson();
    }
}