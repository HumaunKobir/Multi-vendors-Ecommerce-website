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
                <li class="active">Proceed to Payment</li>
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
                <h3>PLEASE MAKE PAYMENT FOR YOUR ORDER!</h3>
                <form action="{{ route('payment')}}" method="post">@csrf
                    <input type="hidden" name="amount" value="{{ round(Session::get('total')/110,2)}}">
                    <input style="width:300px; margin-top:50px;" type="image" src="https://www.paypalobjects.com/webstatic/mktg/logo/bdg_secured_by_pp_2line.png" border="0" alt="Secured by PayPal">
                </form>
            </div>
        </div>
    </div>
</div>
<!--Shopping Cart Area End-->
@endsection