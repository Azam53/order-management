<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use App\Product;
use Auth;

class ProductController extends Controller
{
    /**
          function to show product add form
     */
    public function create()
    {
        return view('product.add');
    }

     public function edit($id)
    {
        $product = Product::find($id);
        return view('product.edit',compact('product'));
    }

    
    /**
     * function to store articles.
     */
    public function store(Request $request)
    {
    	$this->validate($request, [
            'p_name' => 'required',
            'type' => 'required',
            'price' => 'required',
        ]);
        
    	$input = $request->all();

    	$product = Product::create($input);

        return back()->with('success','Product added successfully.');
    }

}
