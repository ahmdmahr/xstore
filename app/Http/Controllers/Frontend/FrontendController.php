<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;

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
}
