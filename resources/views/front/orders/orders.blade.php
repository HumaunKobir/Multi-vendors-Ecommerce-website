@extends('front.layouts.layout')
@section('content')
<!-- Begin Li's Breadcrumb Area -->
<div class="breadcrumb-area">
    <div class="container">
        <div class="breadcrumb-content">
            <ul>
                <li><a href="#">Home</a></li>
                <li class="active">My Orders</li>
            </ul>
        </div>
    </div>
</div>
<div class="page-section mb-60">
    <div class="container">
        <div class="row">
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
                        <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Ordered Products</th>
                            <th>Payment Method</th>
                            <th>Total Amount</th>
                            <th>Created on</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td><a href="{{ url('user/orders/'.$order['id']) }}">{{$order['id']}}</a></td>
                                <td>
                                    @foreach($order['orders_products'] as $product)
                                    {{ $product['product_code']}},
                                    @endforeach
                                </td>
                                <td>{{$order['payment_method']}}</td>
                                <td>{{$order['total']}}</td>
                                <td>{{date('d-m-Y h:i:s',strtotime($order['created_at']));}}</td>
                                <td><a target="_blank" href="{{ url('orders/invoice/'.$order['id']) }}">
                                <i style="font-size:25px;" class="mdi mdi-printer"></i>Print Invoice</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
    
@endsection