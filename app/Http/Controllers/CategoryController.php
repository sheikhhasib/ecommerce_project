<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Category;
use Carbon\Carbon;


class CategoryController extends Controller
{
    //

    function addcategoryview()
    {   
        $categories = Category::all();
        return view('category/view',compact('categories'));
    }

    function addcategoryinsert(Request $request){

        $request->validate([
            'category_name' => 'required|unique:categories,category_name'
        ]);

        
        Category::insert([
            'category_name' => $request->category_name,
            'created_at' => Carbon::now(),
        ]);
        return back()->with('status','Category Added successfully');    
    }
}
