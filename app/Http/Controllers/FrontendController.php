<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;




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
}
