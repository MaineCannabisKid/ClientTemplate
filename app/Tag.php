<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    // Access the Post Model
    public function posts() {
    	return $this->belongsToMany('App\Post');
    }
}
