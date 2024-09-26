<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Order;
use App\Models\Rating;
use App\Models\Review;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function show($product_id){
        $product = Product::find($product_id);
        if($product){
            $review = Review::where('user_id',Auth::id())->where('prod_id',$product->id)->first();
            if($review){
               return view('frontend.reviews.edit',compact('review'));
            }
            else{
            $verified_purchase = Order::where('user_id',Auth::id())
            ->join('order_items','orders.id','=','order_items.order_id')->where('order_items.prod_id',$product_id)->get();

            return view('frontend.reviews.index',compact('product','verified_purchase'));
            }
        }
        else{
            return redirect()->back()->with('status','The link was broken');
        }
    }

    public function create(Request $request){
        $product_id = $request->input('product_id');
        $product = Product::find($product_id);
        if($product){
            $review = $request->input('user_review');
            Review::create([
                'user_id' => Auth::id(),
                'prod_id' => $product_id,
                'review' => $review
            ]);
            return redirect()->route('view-product',$product->id)->with('status',"Thank you for writing the review");
        }
        else{
            return redirect()->back()->with('status','The link was broken');
        }
    }

    public function edit($id){
        $review = Review::find($id);
        $product = $review->product;
        if($product){
            return view('frontend.reviews.edit',compact('review'));
        }
        else{
            return redirect()->back()->with('status','The link was broken');
        }
    }

    public function update(Request $request){
        $user_review = $request->input('user_review');
        if($user_review != ''){
            $review_id = $request->input('review_id');
            $review = Review::where('id',$review_id)->where('user_id',Auth::id())->first();
            if($review){
                $review->review = $user_review;
                $review->update();
                return redirect()->route('view-product',$review->prod_id)->with('status',"Review updated successfully");
            }
          }
          else{
            return redirect()->back()->with('status','You cannot submit an empty review');
           }
        }
        
}
