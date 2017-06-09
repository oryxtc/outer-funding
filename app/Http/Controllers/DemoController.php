<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DemoController extends Controller
{
    //
    public function index(){
        $users = \DB::table('demo')->get();
        dump($users) ;
    }
}
