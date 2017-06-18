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
        'funding'=>'期货配资',
        'famous'=>'名家观点',
        'investment'=>'投资学院',
        'download'=>'下载专区',
        'answer'=>'股票配资解答',
        'qhpzjd'=>'期货配资解答',
    ];


    public function setCreatedAtAttribute($value)
    {
        $this->attributes['created_at'] = Carbon::parse($value)->format('Y-m-d H:i:s');
    }


}
