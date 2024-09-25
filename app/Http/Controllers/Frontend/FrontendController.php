<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Rating;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{
    public function index(){
        $featured_products = Product::where('trending',1)->take(15)->get();
        $popular_categories = Category::where('popular',1)->take(8)->get();
        return view('frontend.index',compact('featured_products','popular_categories'));
    }

    public function categories(){
        $category =  Category::where('status',0)->get();
        return view('frontend.categories',compact('category'));
    }

    public function viewcategory($id){
        $category = Category::find($id);
        $products = Product::where('cat_id',$id)->get();
        // dd($products);
        return view('frontend.products.index',compact('category','products'));
    }

    public function viewproduct($id){
        $product = Product::find($id);
        $ratings = Rating::where('prod_id',$product->id)->get();
        $rating_sum = Rating::where('prod_id',$product->id)->sum('stars');
        $user_rating = Rating::where('prod_id',$product->id)->where('user_id',Auth::id())->first();
        $avg_rating = 0;
        if($ratings->count() > 0){
           $avg_rating = ceil($rating_sum/$ratings->count());
        }
        return view('frontend.products.view',compact('product','ratings','avg_rating','user_rating'));
    }
}
