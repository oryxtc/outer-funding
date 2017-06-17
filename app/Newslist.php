<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;
use TCG\Voyager\Traits\VoyagerUser;

class Newslist extends Authenticatable
{
    use VoyagerUser;

    const TYPE_LIST=[
        'stock'=>'股票资讯',
        'futures'=>'期货资讯',
        'skill'=>'配资技巧',
        'company'=>'公司优势',
        'discuss'=>'机构评论',
    ];


    public function setCreatedAtAttribute($value)
    {
        $this->attributes['created_at'] = Carbon::parse($value)->format('Y-m-d H:i:s');
    }


}