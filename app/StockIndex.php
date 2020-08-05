<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StockIndex extends Model
{
    protected  $fillable = ['index','index_slug'];

   public function user()
   {
       return $this->belongsToMany('App\User')->withTimestamps();
   }
}
