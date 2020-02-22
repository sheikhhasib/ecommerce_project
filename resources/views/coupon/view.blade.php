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
                                <th>Coupon Name</th>
                                <th>Discount Amount(%)</th>
                                <th>Valid Till(Date)</th>
                                <th>Coupon status</th>
                            </tr>
                            </thead>
                            <tbody>
                                @forelse($coupons as $coupon)
                                    <tr>
                                        <td>{{$coupon->coupon_name}}</td>
                                        <td>{{$coupon->discount_amount}}</td>
                                        <td>{{$coupon->valid_till}}</td>
                                        <td>
                                            @if((Carbon\Carbon::now()->format('Y-m-d')) <= ($coupon->valid_till))
                                                valid
                                            @else
                                                invalid
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td col-3>No Coupon</td>
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
                        Add Coupon Form
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


                        <form action="{{ url('coupon/add/insert')}}"  method="post" enctype="multipart/form-data">
                            @csrf


                            <div class="form-group">
                                <label>Coupon Name</label>
                                <input type="text" class="form-control" placeholder="Enter Coupon Name" name="coupon_name" value="{{ old('category_name') }}">
                            </div>

                            <div class="form-group">
                                <label>Discount Amount(%)</label>
                                <input type="number" class="form-control" name="discount_amount" value="{{ old('category_name') }}">
                            </div>

                            <div class="form-group">
                                <label>Valid Till(Date)</label>
                                <input type="date" class="form-control" name="valid_till" value="{{ old('category_name') }}">
                            </div>
                            <button type="submit" class="btn btn-primary">Add Category</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection()
