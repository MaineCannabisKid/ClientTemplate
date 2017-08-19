<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // Tell the Model which table to use
    protected $table = 'categories';

    public function posts() {
    	return $this->hasMany('App\Post');
    }
}
