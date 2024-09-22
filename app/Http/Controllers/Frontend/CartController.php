<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addproduct(Request $request)
    {
        $product_id = $request->input('product_id');
        $product_qty = $request->input('product_qty');

        $prod = Product::where('id', $product_id)->first();

        if($prod){
            if(Cart::where('prod_id',$product_id)->where('user_id',Auth::id())->exists()){
               return response()->json(['status'=> $prod->name." Already Added to cart"]);

            }
            else{
            $cartItem = new Cart();

            $cartItem->user_id = Auth::id();
            $cartItem->prod_id = $product_id;
            $cartItem->prod_qty = $product_qty;
            $cartItem->save();

            return response()->json(['status'=> $prod->name." Added to cart"]);
            }
        }
    }
}
