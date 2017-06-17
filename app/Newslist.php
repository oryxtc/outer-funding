<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;
use TCG\Voyager\Traits\VoyagerUser;

class Newslist extends Authenticatable
{
    use VoyagerUser;

    const TYPE_LIST=[
        'stock'=>'股票',
        'futures'=>'期货',
    ];


    public function setCreatedAtAttribute($value)
    {
        $this->attributes['created_at'] = Carbon::parse($value)->format('Y-m-d H:i:s');
    }


}
