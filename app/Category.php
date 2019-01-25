<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function items() {
    	return $this->hasMany("App\Item");
    	// if we call the Items function, we'll be able to pull all the items for that category and all the properties that come with it

    	
    }
}
