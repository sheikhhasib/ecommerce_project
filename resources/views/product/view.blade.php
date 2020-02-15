@extends('layouts/app');

@section('content')
<div class="container">
    <div class="row">

        

        <div class="col-8">
            <div class="card">
                <div class="card-header bg-success text-center">
                    Product List
                </div>
                <div class="card-body">
                    @if(session('deletestatus'))
                        <div class="alert alert-danger">
                            {{ session('deletestatus') }} 
                        </div>
                    @endif
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                            <th>Sl. No.</th>
                            <th>Product name</th>
                            <th>Product Description</th>
                            <th>Product price</th>
                            <th>Product Quantity</th>
                            <th>Alert Quantity</th>
                            <th>Product Image</th>
                            <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($products as $product)
                                <tr>
                                    <td>{{$loop->index +1}}</td>
                                    <td>{{ $product->product_name}}</td>
                                    <td>{{str_limit($product->product_description )}}</td>
                                    <td>{{ $product->product_price}}</td>
                                    <td>{{ $product->product_quantity}}</td>
                                    <td>{{ $product->alert_quantity}}</td>
                                    <td>
                                    <img src="{{ asset('uploads/product_photos')}}/{{ $product->product_image }}" alt="not found" width="50">
                                    </td>
                                    <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ url('delete/product') }}/ {{$product->id}}" class="btn btn-sm btn-danger">Delete</a>
                                        <a href="{{ url('edit/product') }}/ {{$product->id}}" class="btn btn-sm btn-warning">Edit</a>
                                    </div>
                                        
                                    </td>
                                </tr>
                            @empty 
                            <tr class="text-center text-danger">
                                <td colspan="7">No data Available</td>
                            </tr>
                            @endforelse
                            
                        </tbody>
                    </table>
                    {{$products->links()}}
                </div>
            </div>
        </div>



        <div class="col-4">
            <div class="card">
                <div class="card-header bg-success text-center">
                    Add Product Form
                </div>
                <div class="card-body">

                    @if(session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }} 
                        </div>
                    @endif

                    @if($errors->all())
                        <div class="alert alert-danger">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </div>
                    @endif
                    
                    
                    <form action="{{ url('add/product/insert')}}"  method="post" enctype="multipart/form-data">
                    @csrf

                        <div class="form-group">
                            <label>Product name</label>
                            <input type="text" class="form-control" placeholder="Enter Product name" name="product_name" value="{{ old('product_name') }}">
                        </div>

                        <div class="form-group">
                            <label>Product Description</label>
                            <textarea name="product_description" class="form-control"  rows="3">{{ old('product_description') }}</textarea>
                        </div>

                        <div class="form-group">
                            <label>Product Price</label>
                            <input type="text" class="form-control" placeholder="Enter Product price" name="product_price" value="{{ old('product_price') }}">
                        </div>

                        <div class="form-group">
                            <label>Product Quantity</label>
                            <input type="text" class="form-control" placeholder="Enter Product quantity" name="product_quantity" value="{{ old('product_quantity') }}">
                        </div>

                        <div class="form-group">
                            <label>Alert Quantity</label>
                            <input type="text" class="form-control" placeholder="Enter Product alert" name="alert_quantity" value="{{ old('alert_quantity') }}">
                        </div>
                        <div class="form-group">
                            <label>Product Image</label>
                            <input type="file" class="form-control"  name="product_image">
                        </div>

                        <button type="submit" class="btn btn-primary">Add Product</button>
                    </form>
                </div>
            </div>
        </div>


        
        <div class="col-8">
            <div class="card">
                <div class="card-header bg-success text-center">
                    Deleted Product List
                </div>
                <div class="card-body">
                    @if(session('restore'))
                        <div class="alert alert-danger">
                            {{ session('restore') }} 
                        </div>
                    @endif
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                            <th>Sl. No.</th>
                            <th>Product name</th>
                            <th>Product Description</th>
                            <th>Product price</th>
                            <th>Product Quantity</th>
                            <th>Alert Quantity</th>
                            <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($deletedproducts as $deletedproduct)
                                <tr>
                                    <td>{{$loop->index +1}}</td>
                                    <td>{{ $deletedproduct->product_name}}</td>
                                    <td>{{str_limit($deletedproduct->product_description )}}</td>
                                    <td>{{ $deletedproduct->product_price}}</td>
                                    <td>{{ $deletedproduct->product_quantity}}</td>
                                    <td>{{ $deletedproduct->alert_quantity}}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ url('restore/product') }}/ {{$deletedproduct->id}}" class="btn btn-sm btn-success">Restore</a>
                                            <a href="{{ url('force/delete/product') }}/ {{$deletedproduct->id}}" class="btn btn-sm btn-danger">Permanent delete</a>
                                        </div>
                                    </td>
                                </tr>
                            @empty 
                            <tr class="text-center text-danger">
                                <td colspan="7">No data Available</td>
                            </tr>
                            @endforelse
                            
                        </tbody>
                    </table>
                    {{$products->links()}}
                </div>
            </div>
        </div>



    </div>
</div> 



@endsection()