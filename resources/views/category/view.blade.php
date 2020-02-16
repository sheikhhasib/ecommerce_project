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
                     
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                            <th>Sl. No.</th>
                            <th>Category name</th>
                            <th>Menu Status</th>
                            <th>Created at</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($categories as $categorie)
                                <tr>
                                    <td>{{$loop->index +1}}</td>
                                    <td>{{ $categorie->category_name}}</td>
                                    <td>{{ $categorie->category_name}}</td>

                                    <td>
                                        {{$categorie->created_at->format('d-M-Y g:i A')}}
                                        <br>    
                                        {{$categorie->created_at->diffForHumans()}}
                                    </td>
                                    
                                </tr>
                            @empty 
                            <tr class="text-center text-danger">
                                <td colspan="3">No data Available</td>
                            </tr>
                            @endforelse
                            
                        </tbody>
                    </table>
                    {{-- {{$products->links()}} --}}
                </div>
            </div>
        </div>



        <div class="col-4">
            <div class="card">
                <div class="card-header bg-success text-center">
                    Add Category Form
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
                    
                    
                    <form action="{{ url('add/category/insert')}}"  method="post">
                    @csrf
                    
                    
                        <div class="form-group">
                            <label>Category name</label>
                            <input type="text" class="form-control" placeholder="Enter Category name" name="category_name" value="{{ old('category_name') }}">
                        </div>

                        <div class="form-group">
                            <input type="checkbox" name="menu_status" value="1" id="menu"><label for="menu">Use as Menu</label>
                        </div>
                        <button type="submit" class="btn btn-primary">Add Category</button>
                    </form>
                </div>
            </div>
        </div>


        
      
    </div>
</div> 



@endsection()