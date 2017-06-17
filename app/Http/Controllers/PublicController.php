<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PublicController extends Controller
{
    /*
     * 格式化返回
     */
    public static function apiJson($data=[],$status='success',$message=''){
        $response_data['data']=$data;
        $response_data['status']=$status;
        $response_data['message']=$message;
        return response()->json($response_data);
    }

    public function getNewList(){

    }
}
