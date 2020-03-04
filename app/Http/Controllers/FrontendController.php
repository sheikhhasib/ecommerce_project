<?php

namespace App\Http\Controllers;

use App\Mail\ContactMessage;
use Illuminate\Http\Request;
use App\Product;
use App\Cart;
use App\User;
use App\Coupon;
use Carbon\Carbon;
use App\Category;
use App\Contact;
use Mail;





class FrontendController extends Controller
{
    function contact(){
        return view('contact');
    }
    function contactinsert(Request $request)
    {
        Contact::insert($request->except('_token'));
        //sent mail to the company
        $message = $request->message;
        Mail::to('hasib2130@gmail.com')->send(new ContactMessage($message));
        return back()->withstatus('Message sent successfully');
    }

    function about(){
        return view('about');
    }
    function index(){
        $products = Product::all();
        $categories = Category::all();
        return view('welcome',compact('products','categories'));

    }

    function productdetails($product_id)
     {

        $single_product_info = Product::find($product_id);
        $releted_products = Product::where('id','!=',$product_id)->where('category_id',$single_product_info->category_id) ->get();
        return view('frontend/productdetails',compact('single_product_info','releted_products'));

     }

     function restoreproduct(){

     }

     function categorywiseproduct($category_id){
        $products = Product::where('category_id',$category_id)->get();
        return view('frontend/categorywiseproduct',compact('products'));
     }
     function addtocart($product_id){

        $ip_address = $_SERVER['REMOTE_ADDR'];
        if (Cart::where('customer_ip',$ip_address)->where('product_id',$product_id)->exists()){
            Cart::where('customer_ip',$ip_address)->where('product_id',$product_id)->increment('product_quantity',1);
        }else{
                Cart::insert([
                'customer_ip' => $ip_address,
                'product_id' => $product_id,
                'created_at' => Carbon::now()
            ]);
        }
        return back();

     }
     function cart($coupon_name = "")
     {
        if ($coupon_name == ""){
            $cart_items = Cart::where('customer_ip', $_SERVER['REMOTE_ADDR'])->get();
            $coupon_discount_amounts = 0;
            return view('frontend.cart',compact('cart_items','coupon_discount_amounts','coupon_name'));

        }else{
            if (Coupon::where('coupon_name', $coupon_name)->exists()){
                if (Carbon::now()->format('Y-m-d') <=Coupon::where('coupon_name', $coupon_name)->first()->valid_till ){
                    $cart_items = Cart::where('customer_ip', $_SERVER['REMOTE_ADDR'])->get();
                    $coupon_discount_amounts = Coupon::where('coupon_name', $coupon_name)->first()->discount_amount;

                    return view('frontend.cart',compact('cart_items','coupon_discount_amounts','coupon_name'));



                }else{
                    echo "invalid coupon";
                }
            }else{
                return back();
            }
        }

     }

     function deleteformcart($cart_id)
     {
        Cart::find($cart_id)->delete();
        return back();
     }
     function clearcart(){
         Cart::where('customer_ip', $_SERVER['REMOTE_ADDR'])->delete();
         return back();
     }
     function updatecart(Request $request){
        $ip_address = $_SERVER['REMOTE_ADDR'];
        foreach ($request->product_id as $key_of_product_id => $value_of_product_id) {
            if( Product::find($value_of_product_id)->product_quantity >= $request->user_quantity[$key_of_product_id])
            {
                Cart::where('customer_ip',$ip_address)->where('product_id',$value_of_product_id)->update([
                    'product_quantity' => $request->user_quantity[$key_of_product_id]
                ]);
            }
        }
        return back();
     }
     public function customerlogin(){
        return view('customerregister');
     }
     public function customerlogininsert(Request $request){
         User::insert([
             'name' => $request->name,
             'email' => $request->email,
             'password' => bcrypt($request->password),
             'role' => 2,
             'created_at' => Carbon::now(),
         ]);
         return back();
     }
}
