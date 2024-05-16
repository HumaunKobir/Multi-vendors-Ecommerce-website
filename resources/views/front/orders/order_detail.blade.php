<?php use App\Models\Product; ?>
@extends('front.layouts.layout')
@section('content')
<!-- Begin Li's Breadcrumb Area -->
<div class="breadcrumb-area">
    <div class="container">
        <div class="breadcrumb-content">
            <ul>
                <li><a href="#">Home</a></li>
                <li class="active">Order Details</li>
            </ul>
        </div>
    </div>
</div>
<div class="page-section mb-60">
    <div class="container">
        <div class="row">
            <h3 class="text-center">Order #{{$orderDetails['id']}} Details</h3>
            <div class="col-sm-12 col-md-12 col-xs-12 col-lg-12 mb-30">
                @if(Session::has('success_message'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success::</strong> {{Session::get('success_message')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                @endif
                <div class="table-responsive pt-3">
                    <table id="section" class="table table-striped table-bordered">
                        <tr><td colspan="2"><strong>Order Details</strong></td></tr>
                        <tr><td>Order Date</td><td>{{date('d-m-Y h:i:s',strtotime($orderDetails['created_at']));}}</td></tr>
                        <tr><td>Order Status</td><td>{{ $orderDetails['order_status']}}</td></tr>
                        <tr><td>Order Total</td><td>{{ $orderDetails['total']}}</td></tr>
                        <tr><td>Shipping Charges</td><td>{{ $orderDetails['shpping_charges']}}</td></tr>
                        @if($orderDetails['coupon_code']!="")
                        <tr><td>Coupon Code</td><td>{{ $orderDetails['coupon_code']}}</td></tr>
                        <tr><td>Coupon Amount</td><td>{{ $orderDetails['coupon_amount']}}</td></tr>
                        @endif
                        @if($orderDetails['courier_name']!="")
                        <tr><td>Courier Name</td><td>{{ $orderDetails['courier_name']}}</td></tr>
                        <tr><td>Tracking Number</td><td>{{ $orderDetails['tracking_number']}}</td></tr>
                        @endif
                        <tr><td>Payment Method</td><td>{{ $orderDetails['payment_method']}}</td></tr>
                    </table>
                    <table id="section" class="table table-striped table-bordered">
                        <tr>
                            <th>Product Image</th>
                            <th>Product Code</th>
                            <th>Product Name</th>
                            <th>Product Size</th>
                            <th>Product Color</th>
                            <th>Product Qty</th>
                        </tr>
                        @foreach($orderDetails['orders_products'] as $product)
                        <tr>
                            <td><a href="{{ url('product/'.$product['product_id'])}}">
                                @php $getProductImage = Product::getProductImage($product['product_id']) @endphp
                                <img style="width:40px;" src="{{ asset('front/images/product_image/'.$getProductImage)}}" alt=""></a>
                            </td>
                            <td>{{ $product['product_code']}} </td>
                            <td>{{ $product['product_name']}} </td>
                            <td>{{ $product['product_size']}} </td>
                            <td>{{ $product['product_color']}} </td>
                            <td>{{ $product['product_qty']}} </td>
                        </tr>
                        @if($product['courier_name']!="")
                            <tr><td colspan="6">Courier Name: {{$product['courier_name']}}, Tracking Number: {{$product['tracking_number']}}</td></tr>
                        @endif
                        @endforeach
                    </table>
                    <table id="section" class="table table-striped table-bordered">
                        <tr><td colspan="2"><strong>Delivery Address</strong></td></tr>
                        <tr><td>Name</td><td>{{$orderDetails['name']}}</td></tr>
                        <tr><td>Address</td><td>{{ $orderDetails['address']}}</td></tr>
                        <tr><td>City</td><td>{{ $orderDetails['city']}}</td></tr>
                        <tr><td>State</td><td>{{ $orderDetails['state']}}</td></tr>
                        <tr><td>Country</td><td>{{ $orderDetails['country']}}</td></tr>
                        <tr><td>Pincode</td><td>{{ $orderDetails['pincode']}}</td></tr>
                        <tr><td>Mobile</td><td>{{ $orderDetails['mobile']}}</td></tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
    
@endsection