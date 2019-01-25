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

    public function deleteItem($id, Request $request) {
        $item = Item::find($id);
        $item->delete();

        Session::flash("success_message", "Item successfully deleted");
        return redirect('/catalog');
    }

    public function showEditForm($id){
        $item = Item::find($id);
        $categories = Category::all();

        return view('items.edit_form', compact('item', 'categories'));
    }

    public function editItem($id, Request $request) {
        $item = Item::find($id);

        //validations
        $rules = array(
            'name'=>'required',
            'description'=>'required',
            'price'=>"required|numeric",
            'image'=>"image|mimes:jpeg,png,jpg,gif,svg|max:2048"
        );

        $this->validate($request,$rules);
        $item->name = $request->name;
        $item->description=$request->description;
        $item->price=$request->price;
        $item->category_id=$request->category;

        if($request->file('image')!=null) { //if i uploaded an image
            $image=$request->file('image');
            $image_name=time().".".$image->getClientOriginalExtension();
            $destination="images/";
            $image->move($destination,$image_name);
            $item->image_path=$destination.$image_name;
        }

        $item->save();
        Session::flash("edit_message","Item Edited successfully");
        return redirect("/catalog");
    }

    public function addToCart($id, Request $request) {
        //if there is an existing cart, get it. if none, initialize it
        if(Session::has('cart')) {
            $cart = Session::get('cart');
        } else {
            $cart = [];
        }

        //if item in cart already has quantity, add to it. if none, assign to quantity
        if(isset($cart[$id])) {
            $cart[$id] += $request->quantity;
        } else {
            $cart[$id] = $request->quantity;
        }

        //put the cart in a session
        Session::put('cart', $cart); //this is the traditional session

        // dd(Session::get('cart'));
        $item = Item::find($id);
        Session::flash("success_cart", "$request->quantity of $item->name has been successfully added to your cart");
        
        return redirect("/catalog");
        return array_sum(Session::get('cart'));

    }

    public function showCart() {
        $item_cart = [];
        // Session::forget('cart');
        $total = 0;
        if(Session::has('cart')) {
            $cart = Session::get('cart');
            foreach($cart as $id=>$quantity) {
                $item = Item::find($id);

                $item->quantity=$quantity;
                $item->subtotal = $item->price * $quantity;

                $total += $item->subtotal;
                $item_cart[] = $item;
                // we push $item array (array pushing)
            }
            // dd($item);
        }
        return view('items.cart_content', compact('item_cart', 'total'));
    }

    public function deleteCart($id) {
        // we want to remove the specific id in the session 'cart'
        Session::forget("cart.$id"); //this is the same as cart('$id')
        return redirect('/menu/mycart');
    }

    public function clearCart() {
        Session::forget('cart');
        return redirect('/menu/mycart');
    }

    public function updateCart($id, Request $request) {
        $cart = Session::get('cart');
        $cart[$id] = $request->new_qty;
        Session::put('cart', $cart);

        return redirect('/menu/mycart');
    }

}
