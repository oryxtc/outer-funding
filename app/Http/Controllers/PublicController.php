<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PublicController extends Controller
{
    /*
     * 格式化返回
     */
    public static function apiJson($data=[],$status='success',$message=''){
        $data['data']=$data;
        $data['status']=$status;
        $data['message']=$message;
        return response()->json($data);
    }
}
