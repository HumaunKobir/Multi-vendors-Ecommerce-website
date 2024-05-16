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
                <li><a href="index.html">Home</a></li>
                <li class="active">Shopping Cart</li>
            </ul>
        </div>
    </div>
</div>
<!-- Li's Breadcrumb Area End Here -->
<!--Shopping Cart Area Strat-->
<div class="Shopping-cart-area pt-60 pb-60">
    <div class="container">
        <div class="row">
            @if(Session::has('error_message'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Error::</strong> {{Session::get('error_message')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
            @endif
            <div class="col-12">
                <div id="appendCartItems">
                    @include('front.products.cart_items')
               </div>
            </div>
        </div>
    </div>
</div>
<!--Shopping Cart Area End-->
@endsection