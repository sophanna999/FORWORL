<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    //protected $table = '';
    //protected $primaryKey = '';
    //protected $timestamps = true;

    public function User(){
    	return $this->hasOne('App\Models\User','id','user_id');
    }

    public function ArticleViewHistory(){
    	return $this->hasMany('App\Models\ArticleViewHistory','article_id','id');
    }
}
