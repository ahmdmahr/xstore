<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index(){
        $old_cartItems = Cart::where('user_id',Auth::id())->get();
        // remove all out-of-stock items from carts
        foreach($old_cartItems as $item){
            if(!Product::where('id',$item->prod_id)->where('qty','>=',$item->prod_qty)->exists()){
                   $item->delete();
            }
        }
        $cartItems = Cart::where('user_id',Auth::id())->get();
        return view('frontend.checkout',compact('cartItems'));
    }

    public function placeorder(Request $request){
        $order = new Order();
        $cartItems = Cart::where('user_id',Auth::id())->get();

        $order->user_id = Auth::id();
        $tot = 0;
        foreach($cartItems as $item){
            $tot += $item->products->selling_price * $item->prod_qty;
        }
        $order->total_price = $tot;
        $order->fname = $request->input('fname');
        $order->lname = $request->input('lname');
        $order->email = $request->input('email');
        $order->phone = $request->input('phone');
        $order->address1 = $request->input('address1');
        $order->address2 = $request->input('address2');
        $order->city = $request->input('city');
        $order->state = $request->input('state');
        $order->country = $request->input('country');
        $order->pin_code = $request->input('pin_code');
        $order->tracking_no = $order->fname . rand(1111,9999);
        $order->payment_mode = $request->input('payment_mode');
        $order->payment_id = $request->input('payment_id');
        

        $order->save();

        foreach($cartItems as $item){
            OrderItem::create([
                'order_id' => $order->id,
                'prod_id' => $item->prod_id,
                'qty' => $item->prod_qty,
                'price' => $item->products->selling_price
            ]);
            // update products qty after ordering.
            $prod = Product::where('id',$item->prod_id)->first();
            $prod->qty -= $item->prod_qty;
            $prod->update();
        }

        // check if this the 1st purchasing of this user to fill checkout info inside it's record.

        $user = User::where('id',Auth::id())->first();
        $user->fname = $request->input('fname');
        $user->lname = $request->input('lname');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->address1 = $request->input('address1');
        $user->address2 = $request->input('address2');
        $user->city = $request->input('city');
        $user->state = $request->input('state');
        $user->country = $request->input('country');
        $user->pin_code = $request->input('pin_code');
        $user->update();

        Cart::destroy($cartItems);

        if($request->input('payment_mode') == "Paid by Paypal"){
           return response()->json([
            'status' => "Order placed successfully"
           ]);
        }
        else{
            return redirect('/')->with('status',"Order placed successfully");
        }
    }

}