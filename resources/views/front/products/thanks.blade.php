<?php 
    use App\Models\Product;
    use App\Models\ProductsAttribute;
    //dd($productFilters);
?>
@extends('front.layouts.layout')
@section('content')
<!-- Begin Li's Breadcrumb Area -->
<div class="breadcrumb-area">
    <div class="container">
        <div class="breadcrumb-content">
            <ul>
                <li><a href="3">Home</a></li>
                <li class="active">Thanks</li>
            </ul>
        </div>
    </div>
</div>
<!-- Li's Breadcrumb Area End Here -->
<!--Shopping Cart Area Strat-->
<div class="Shopping-cart-area pt-60 pb-60">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h3>YOUR ORDER HAS BEEN PLACED SUCCESSFULLY!</h3>
                <P>Your order number is {{Session::get('order_id')}} and total amount in BDT {{ Session::get('total')}}</P>
            </div>
        </div>
    </div>
</div>
<!--Shopping Cart Area End-->
@endsection