@extends('layouts.frontendapp')
@section('frontend_content')
    <!-- Page Info -->
    <div class="page-info-section page-info">
        <div class="container">
            <div class="site-breadcrumb">
                <a href="">Home</a> /
                <a href="">Sales</a> /
                <a href="">Bags</a> /
                <span>Cart</span>
            </div>
            <img src="img/page-info-art.png" alt="" class="page-info-art">
        </div>
    </div>
    <!-- Page Info end -->
    <!-- Page -->
    <div class="page-area cart-page spad">
        <div class="container">
            <div class="cart-table">
                <table>
                    <thead>
                    <tr>
                        <th class="product-th">Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th class="total-th">Total</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php
                        $sub_total = 0;        
                    @endphp
                    @forelse($cart_items as $cart_item)
                        <tr>
                            <td class="product-col">
                                <img src="{{asset('uploads/product_photos')}}/{{App\Product::find($cart_item->product_id)->product_image}}" width="50" alt="">
                                <div class="pc-title">
                                    <h4>{{App\Product::find($cart_item->product_id)->product_name}}</h4>

                                </div>
                            </td>
                            <td class="price-col">${{App\Product::find($cart_item->product_id)->product_price}}</td>
                            <td class="quy-col">
                                <div class="quy-input">
                                    <span>Qty</span>
                                    <input type="number" value="{{$cart_item->product_quantity}}">
                                </div>
                            </td>
                            <td class="total-col">$
                                {{(App\Product::find($cart_item->product_id)->product_price) * ($cart_item->product_quantity)}}
                                @php
                                     $sub_total += ((App\Product::find($cart_item->product_id)->product_price) * ($cart_item->product_quantity));
                                @endphp
                            </td>
                            <td>
                                <a href="{{url('delete/form/cart')}}/{{$cart_item->id}}" ><span class="fa fa-2x fa-trash"></span></a>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td class="text-center">No Data There</td>
                        </tr>
                    @endforelse

                    </tbody>
                </table>
            </div>
            <div class="row cart-buttons">
                <div class="col-lg-5 col-md-5">
                    <a href="{{url('/')}}"> <div class="site-btn btn-continue">Continue shooping</div></a>
                </div>
                <div class="col-lg-7 col-md-7 text-lg-right text-left">
                    <a href="{{url('clear/cart')}}"><div class="site-btn btn-clear">Clear cart</div></a>
                    <div class="site-btn btn-line btn-update">
                        Update Cart
                    </div>
                </div>
            </div>
        </div>
        <div class="card-warp">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="shipping-info">
                            <h4>Shipping method</h4>
                            <p>Select the one you want</p>
                            <div class="shipping-chooes">
                                <div class="sc-item">
                                    <input type="radio" name="sc" id="one">
                                    <label for="one" id="label_one">Next day delivery<span>$4.99</span></label>
                                </div>
                                <div class="sc-item">
                                    <input type="radio" name="sc" id="two">
                                    <label for="two" id="label_tow">Standard delivery<span>$1.99</span></label>
                                </div>
                                <div class="sc-item">
                                    <input type="radio" name="sc" id="three">
                                    <label for="three" id="label_three">Personal Pickup<span>Free</span></label>
                                </div>
                            </div>
                            <h4>Cupon code</h4>
                            <p>Enter your cupone code</p>
                            <div class="cupon-input">
                                <input type="text" id="user_inserted_coupon_name" value="{{$coupon_name}}">
                                <button class="site-btn" id="apply_coupon_btn">Apply</button>
                            </div>
                        </div>
                    </div>
                    <div class="offset-lg-2 col-lg-6">
                        <div class="cart-total-details">
                            <h4>Cart total</h4>
                            <p>Final Info</p>
                            <ul class="cart-total-card">
                                <li>Subtotal<span>${{ $sub_total}}</span></li>
                                <li>Discount Amount<span>{{$coupon_discount_amounts}} %</span></li>
                                <li>Shipping<span id="shipping_amount">Free</span></li>
                                <li class="total">Grand Total<span id="grand_total">{{ $sub_total - ($sub_total * ($coupon_discount_amounts/100))}}</span></li>
                            </ul>
                            <a class="site-btn btn-full" href="checkout.html">Proceed to checkout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page end --> 
@endsection
@section('frontend_footer_script')
    <script>
        $(document).ready(function () {
            $('#apply_coupon_btn').click(function () {

                var coupon_name = $('#user_inserted_coupon_name').val();
                window.location.href = "{{url('/cart')}}"+"/"+coupon_name;
            });
            $('#label_one').click(function() {
                var label_one_value = parseFloat(4.99);

                $('#shipping_amount').html(label_one_value);
                var  grand_total = parseFloat($('#grand_total').html());
                var final_grand_total = grand_total + label_one_value;
                $('#grand_total').html(final_grand_total);
            });
        });
    </script>
@endsection
