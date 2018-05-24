<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    //protected $table = '';
    //protected $primaryKey = '';
    //protected $timestamps = true;
    public function BannerViewHistory(){
    	return $this->hasMany('App\Models\BannerViewHistory','banner_id','id');
    }
}
