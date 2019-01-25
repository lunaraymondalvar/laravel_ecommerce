<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function status() {
    	return $this->belongsTo("App\Status");
    }


    function items() {
    	return $this->belongsToMany("\App\Item")->withPivot('quantity')->withTimestamps();
    	//return $this->belongsToMany ('items'), tablename where they meet 

    }

    // belongsToMany links it(the order) to the items table via the item_order table
    // this is the reason why naming convention is important specially in frameworks
    // if you didn't follow the naming convention, we need to state the table name later
    // withPivot contains ALL the columns that are not foreign keys and are not ids and timestamps in the pivot table
	// If you have more that one column for pivot, comma separate them ->withPivot('column1','column')
	// withTimeStamps->automatically populates the timestamps as son as an entry for the item_order table is created

}
