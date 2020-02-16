@extends('layouts/app');

@section('content')
<div class="container">
    <div class="row">
        
        <div class="col-6 offset-3">
            <div class="card">

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('home')}}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ url('add/product/view') }}">Product list</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $single_product_info->product_name }}</li>
                </ol>
            </nav>
                <div class="card-header bg-success">
                    Edit Product Form
                </div>
                <div class="card-body">

                    @if(session('updatestatus'))
                        <div class="alert alert-success">
                            {{ session('updatestatus') }} 
                        </div>
                    @endif

                    
                    <form action="{{ url('edit/product/insert')}}"  method="post" enctype="multipart/form-data">
                    @csrf

                        <div class="form-group">
                            <input type="hidden" name="product_id" value="{{$single_product_info->id}}">
                            <label>Product name</label>
                            <input type="text" class="form-control" placeholder="Enter Product name" name="product_name" value="{{$single_product_info->product_name}}">
                        </div>

                        <div class="form-group">
                            <label>Product Description</label>
                            <textarea name="product_description" class="form-control"  rows="3">{{$single_product_info->product_description}}</textarea>
                        </div>

                        <div class="form-group">
                            <label>Product Price</label>
                            <input type="text" class="form-control" placeholder="Enter Product price" name="product_price" value="{{$single_product_info->product_price}}">
                        </div>

                        <div class="form-group">
                            <label>Product Quantity</label>
                            <input type="text" class="form-control" placeholder="Enter Product quantity" name="product_quantity" value="{{$single_product_info->product_quantity}}">
                        </div>

                        <div class="form-group">
                            <label>Alert Quantity</label>
                            <input type="text" class="form-control" placeholder="Enter Product alert" name="alert_quantity" value="{{$single_product_info->alert_quantity}}">
                        </div>
                        
                        <div class="form-group">
                            <label>Product Image</label>
                            <input type="file" class="form-control"  name="product_image">
                            <img src="{{asset('uploads/product_photos')}}/{{$single_product_info->product_image}}" alt="Not found" width="50">
                        </div>
                        <button type="submit" class="btn btn-warning">Edit Product</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection()