<?php

namespace App\Http\Controllers;
use App\Item;
use App\Category;
use Session;

use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function showItems() {
   		$categories = Category::all();
   		$items = Item::all();
   	 	return view('items.catalog', compact(['categories', 'items']));
    }

    public function itemDetails($id) {
    	$item = Item::find($id);
    	return view('items.item_details', compact('item'));

    }

     public function showAddItemForm(){
     	$categories = Category::all();

    	return view('items.add_items', compact('categories'));
    }

     public function saveItems(Request $request){
     	// dd($request);
     	$rules = array(
     		"name"=> "required",
     		"description"=> "required",
     		"price"=> "required|numeric",
     		"image"=> "required|image|mimes:jpeg,jpg,gif,svg,png|max:2048"
     	);

     	// To Validate
     	$this->validate($request, $rules);

     	$item = new Item;
     	$item->name = $request->name;
     	$item->description = $request->description;
     	$item->price = $request->price;
     	$item->category_id = $request->category;

     	$image = $request->file('image');
     	$image_name = time().".". $image->getClientOriginalExtension();
     	$destination = "images/";
     	$image->move($destination, $image_name);

     	$item->image_path = $destination.$image_name;
     	$item->save();
     	Session::flash("success_message", "Item added successfully");
     	return redirect('/catalog');

    }
}
