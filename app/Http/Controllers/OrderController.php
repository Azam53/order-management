<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Product;
use App\User;
use App\Order;

class OrderController extends Controller
{
   /**
     * function to generate list of orders.
     */
    public function index()
    {
        $products = Product::lists('p_name', 'id');
    	$users    = User::lists('name','id');
        $orders   = Order::join('product', 'product.id', '=', 'order.product_id')
                         ->join('users', 'users.id', '=', 'order.user_id')
                         ->select('order.*','users.name','product.p_name','product.price')
                         ->paginate(3);
        
        return view('order.index',compact('products','users','orders'));
    }

     public function edit($id)
    {
        $order = Order::find($id);
        $products = Product::lists('p_name', 'id');
    	$users    = User::lists('name','id');
        return view('order.edit',compact('order','products','users'));
    }

    /**
     * function to store orders.
     */
    public function store(Request $request)
    {
    	$this->validate($request, [
            'user_id' => 'required',
            'product_id' => 'required',
            'quantity' => 'required',
        ]);
 
         // calculate total price for order created....
        $product_price = Product::find($request->product_id);
        $total_price = $request->quantity * $product_price->price;
	    
	 $discount_id = Product::where('p_name','Pepsi Cola')->get();    

         // Applying special discount of 20% on total price
        if($request->product_id == $discount_id[0]->id && $request->quantity >= 3 ){
           $total_price = $total_price - ($total_price * 0.2);
        }
        
    	$input = $request->all();
        $input['total_amount'] = $total_price;

    	$product = Order::create($input);

        return back()->with('success','Order created successfully.');
    }

      /**
     * function to update orders.
     */
    public function update(Request $request,$id)
    {
        $order = Order::find($id);   
    	$order->user_id = $request->user_id;
        $order->product_id = $request->product_id;
        $order->quantity   = $request->quantity;
        $order->total_amount = $request->total_amount;
        $order->save();
        
        return back()->with('success','Order updated successfully.');
    }

     /**
     * function to destroy orders.
     */

    public function destroy($id){
		 
                   $order = Order::find($id);
                   $order->delete();
                   
		return back()->with('success','Order deleted successfully.');
	}

    




}
