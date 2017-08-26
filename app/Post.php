<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	// Access to category model
    public function category() {
    	return $this->belongsTo('App\Category');
    }

    // Access to Tags Model
    public function tags() {
    	return $this->belongsToMany('App\Tag');
    }

}

