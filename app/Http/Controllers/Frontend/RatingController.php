<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Order;
use App\Models\Rating;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    public function add(Request $request){
        $stars = $request->input('product_rating');
        $product_id = $request->input('product_id');

        $product_check = Product::where('id',$product_id)->first();
        if($product_check){
            $verified_purchase = Order::where('user_id',Auth::id())
            ->join('order_items','orders.id','=','order_items.order_id')->where('order_items.prod_id',$product_id)->get();
            if($verified_purchase->count() > 0){
                $existing_rating = Rating::where('user_id',Auth::id())->where('prod_id',$product_id)->first();
                 if($existing_rating){
                    $existing_rating->stars = $stars;
                    $existing_rating->update();
                }
                else{
                Rating::create([
                    'user_id'=>Auth::id(),
                    'prod_id'=>$product_id,
                    'stars'=>$stars
                ]);
                }
                return redirect()->back()->with('status',"Thank you for rating this product");
            }
            else{
                return redirect()->back()->with('status',"You can not rate a product without purchase");
            }
        }
        else{
            return redirect()->back()->with('status',"The link was broken");
        }
    }
}
