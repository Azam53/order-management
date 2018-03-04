<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Product;
use App\User;
use App\Order;

class SearchController extends Controller
{
   /**
     * function to search orders.
     */

    public function index(Request $request){
		 
        $products = Product::lists('p_name', 'id');
    	$users    = User::lists('name','id');
        $orders   = Order::join('product', 'product.id', '=', 'order.product_id')
                         ->join('users', 'users.id', '=', 'order.user_id');
        if(!empty($request->search_term)){
		$orders   = $orders->where('product.p_name','like','%' .$request->search_term. '%')
		                 ->orWhere('users.name','like','%' .$request->search_term. '%');
        }

        if(!empty($request->duration == 'all')){
		$orders   = $orders->where('order.created_at',$request->duration);
        }

        if(!empty($request->duration == 'last_day')){
                $date = date('Y-m-d');
                $last_seventh_day = date('Y-m-d',strtotime('-7 day'));
		$orders   = $orders->whereBetween('order.created_at', array($last_seventh_day,$date));
        }

         if(!empty($request->duration == 'today')){
                $date = date('Y-m-d');
		$orders   = $orders->where('order.created_at','like','%' .$date. '%');
        }

        $orders = $orders->select('order.*','users.name','product.p_name','product.price')->paginate(3);
                         //->get();
        
        return view('order.index',compact('products','users','orders'));
	}
}
