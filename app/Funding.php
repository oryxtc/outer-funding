<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use TCG\Voyager\Traits\VoyagerUser;

class Funding extends Authenticatable
{
    use VoyagerUser;


    public function user(){
        return $this->hasOne('App\User','id','user_id');
    }


    public function administrator(){
        return $this->hasOne('App\Administrator','id','administrator_id');
    }

}
