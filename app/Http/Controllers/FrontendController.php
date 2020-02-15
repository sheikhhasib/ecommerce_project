<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;


class FrontendController extends Controller
{
    function contact(){
        return view('contact'); 
    }

    function about(){
        return view('about');
    }
    function index(){
        $products = Product::all();
        return view('welcome',compact('products'));
        
    }

    function productdetails($product_id)
     {
        
        $single_product_info = Product::find($product_id);
        $releted_products = Product::where('id','!=',$product_id)->get();
        return view('frontend/productdetails',compact('single_product_info','releted_products'));
         
     }

     function restoreproduct(){

     }
}
