<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use TCG\Voyager\Traits\VoyagerUser;

class Funding extends Authenticatable
{
    use VoyagerUser;

    /**
     * On save make sure to set the default avatar if image is not set.
     */
    public function save(array $options = [])
    {
        $this->administrator_id = \Auth::guard('admin')->id();

        parent::save();
    }

    public function user(){
        return $this->hasOne('App\User','id','user_id');
    }


    public function administrator(){
        return $this->hasOne('App\Administrator','id','administrator_id');
    }

}
