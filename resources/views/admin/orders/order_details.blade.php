<?php use App\Models\Product; use App\Models\OrdersLog; ?>
@extends('admin.layout.layout')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">Order Details</h3>
                        <h6 class="font-weight-normal mb-0"><a style=text-decoration:none; href="{{ url('admin/orders')}}">Go Back to Order</a></h3>
                        @if(Session::has('success_message'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Success::</strong> {{Session::get('success_message')}}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                    </div>
                    <div class="col-12 col-xl-4">
                        <div class="justify-content-end d-flex">
                            <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                                <button class="btn btn-sm btn-light bg-white dropdown-toggle" type="button" id="dropdownMenuDate2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                <i class="mdi mdi-calendar"></i> Today (10 Jan 2021)
                                </button>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuDate2">
                                    <a class="dropdown-item" href="#">January - March</a>
                                    <a class="dropdown-item" href="#">March - June</a>
                                    <a class="dropdown-item" href="#">June - August</a>
                                    <a class="dropdown-item" href="#">August - November</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Delivery Details</h4>
                        <div class="form-group" style="height:15px;">
                            <label style="font-weight:550;">Order ID: </label>
                            <label> #{{$orderDetails['id']}} </label>
                        </div>
                        <div class="form-group" style="height:15px;">
                            <label style="font-weight:550;">Order Date: </label>
                            <label> {{date('d-m-Y h:i:s',strtotime($orderDetails['created_at']));}} </label>
                        </div>
                        <div class="form-group" style="height:15px;">
                            <label style="font-weight:550;">Order Status: </label>
                            <label> {{$orderDetails['order_status']}} </label>
                        </div>
                        <div class="form-group" style="height:15px;">
                            <label style="font-weight:550;">Shipping Charges: </label>
                            <label> {{$orderDetails['shpping_charges']}} </label>
                        </div>
                        @if(!empty($orderDetails['coupon_code']))
                            <div class="form-group" style="height:15px;">
                                <label style="font-weight:550;">Coupon Code: </label>
                                <label> {{$orderDetails['coupon_code']}} </label>
                            </div>
                            <div class="form-group" style="height:15px;">
                                <label style="font-weight:550;">Coupon Amount: </label>
                                <label> {{$orderDetails['coupon_amount']}} </label>
                            </div>
                        @endif
                        <div class="form-group" style="height:15px;">
                            <label style="font-weight:550;">Payment Method: </label>
                            <label> {{$orderDetails['payment_method']}} </label>
                        </div>
                        <div class="form-group" style="height:15px;">
                            <label style="font-weight:550;">Total Amount: </label>
                            <label> {{$orderDetails['total']}} tk </label>
                        </div>
                  </div>
                </div>
            </div>
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Customer Details</h4>
                        <div class="form-group" style="height:15px;">
                            <label style="font-weight:550;">Name: </label>
                            <label> {{$userDetails['name']}} </label>
                        </div>
                        @if(!empty($orderDetails['address']))
                            <div class="form-group" style="height:15px;">
                                <label style="font-weight:550;">Address: </label>
                                <label> {{$userDetails['address']}} </label>
                            </div>
                        @endif
                        @if(!empty($orderDetails['city']))
                            <div class="form-group" style="height:15px;">
                                <label style="font-weight:550;">City: </label>
                                <label> {{$userDetails['city']}} </label>
                            </div>
                        @endif
                        @if(!empty($orderDetails['state']))
                            <div class="form-group" style="height:15px;">
                                <label style="font-weight:550;">State: </label>
                                <label> {{$userDetails['state']}} </label>
                            </div>
                        @endif
                        @if(!empty($orderDetails['country']))
                            <div class="form-group" style="height:15px;">
                                <label style="font-weight:550;">Country: </label>
                                <label> {{$userDetails['country']}} </label>
                            </div>
                        @endif
                        @if(!empty($orderDetails['pincode']))
                            <div class="form-group" style="height:15px;">
                                <label style="font-weight:550;">Pincode: </label>
                                <label> {{$userDetails['pincode']}} </label>
                            </div>
                        @endif
                        <div class="form-group" style="height:15px;">
                            <label style="font-weight:550;">Mobile: </label>
                            <label> {{$userDetails['mobile']}} </label>
                        </div>
                        <div class="form-group" style="height:15px;">
                            <label style="font-weight:550;">Email: </label>
                            <label> {{$userDetails['email']}} </label>
                        </div>
                    </div>
                </div>
            </div> 
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                   <div class="card-body">
                     <h4 class="card-title">Delivery Address</h4>
                        <div class="form-group" style="height:15px;">
                            <label style="font-weight:550;">Name: </label>
                            <label> {{$orderDetails['name']}} </label>
                        </div>
                        <div class="form-group" style="height:15px;">
                            <label style="font-weight:550;">Address: </label>
                            <label> {{$orderDetails['address']}} </label>
                        </div>
                        <div class="form-group" style="height:15px;">
                            <label style="font-weight:550;">City: </label>
                            <label> {{$orderDetails['city']}} </label>
                        </div>
                        <div class="form-group" style="height:15px;">
                            <label style="font-weight:550;">State: </label>
                            <label> {{$orderDetails['state']}} </label>
                        </div>
                        <div class="form-group" style="height:15px;">
                            <label style="font-weight:550;">Country: </label>
                            <label> {{$orderDetails['country']}} </label>
                        </div>
                        <div class="form-group" style="height:15px;">
                            <label style="font-weight:550;">Pincode: </label>
                            <label> {{$orderDetails['pincode']}} </label>
                        </div>
                        <div class="form-group" style="height:15px;">
                            <label style="font-weight:550;">Mobile: </label>
                            <label> {{$orderDetails['mobile']}} </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                   <div class="card-body">
                     <h4 class="card-title">Update Order Status</h4>
                     
                     @if(Auth::guard('admin')->user()->type != "deliveryboy")
                     @if(Auth::guard('admin')->user()->type != "vendor")
                       <form action="{{url('admin/update-order-status')}}" method="post">@csrf
                            <input type="hidden" name="order_id" value="{{ $orderDetails['id']}}">
                            <select style="width:200px;" class="form-control" name="order_status" id="order_status" required="">
                                <option value="">Select</option>
                                @foreach($orderStatuses as $status)
                                    <option value="{{$status['name']}}" @if(!empty($orderDetails['order_status']) && $orderDetails['order_status'] == $status['name']) Selected="" @endif>{{ $status['name'] }}</option>
                                @endforeach
                            </select>&nbsp;
                                <select style="width:200px;" class="form-control" name="delivery_boy_name" id="delivery_boy_name" required="">
                                    <option value="">Select DeliveryBoy</option>
                                    @foreach($deliveryBoyStatus as $status)
                                        <option value="{{$status['name']}}" @if(!empty($product['delivery_boy_name']) && $product['delivery_boy_name'] == $status['name']) Selected="" @endif>{{ $status['name'] }}</option>
                                    @endforeach
                                </select><br>
                            <input class="form-control" type="text" name="courier_name" id="courier_name" placeholder="Courier Name">&nbsp;
                            <input class="form-control" type="text" name="tracking_number" id="tracking_number" placeholder="Tracking Number"><br><br>
                            <button class="btn btn-primary" type="submit">Update Status</button>
                       </form><br>
                        @foreach($orderLogs as $key=>$log)
                            <strong>{{ $log['order_status']}}</strong>
                            @if(isset($log['order_item_id']) && $log['order_item_id']>0)
                            @php $getItemDetails = OrdersLog::getItemDetails($log['order_item_id']) @endphp
                            - for item {{$getItemDetails['product_code']}}
                                @if(!empty($getItemDetails['courier_name']))
                                    <br><span>Courier Name: {{ $getItemDetails['courier_name']}}</span>
                                @endif
                                @if(!empty($getItemDetails['tracking_number']))
                                    <br><span>Tracking Number: {{ $getItemDetails['tracking_number']}}</span>
                                @endif
                                @if(!empty($getItemDetails['delivery_boy_name']))
                                    <br><span>Delivery Boy: {{ $getItemDetails['delivery_boy_name']}}</span>
                                @endif
                            @endif
                            <br>{{date('d-m-Y h:i:s',strtotime($log['created_at']));}} <br><br>
                        @endforeach
                       @else
                       This Featured is Restricted
                       @endif
                       @else
                       This Featured is Restricted
                       @endif
                    </div>
                </div>
            </div>
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                   <div class="card-body">
                     <h4 class="card-title">Ordered Product</h4>
                        <div class="table-responsive pt-3">
                            <table id="section" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Product Image</th>
                                        <th>Product Code</th>
                                        <th>Product Name</th>
                                        <th>Product Size</th>
                                        <th>Product Color</th>
                                        <th>Product Qty</th>
                                        <th>Item Status</th>
                                    </tr>
                                </thead>
                                <tbody>
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
                                        <td>
                                            <form action="{{url('admin/update-order-item_status')}}" method="post">@csrf
                                                <input type="hidden" name="order_item_id" value="{{ $product['id']}}">    
                                                <select style="width:200px;" name="order_item_status" id="order_item_status" required="">
                                                    <option value="">Select</option>
                                                    @foreach($orderItemStatuses as $status)
                                                        <option value="{{ $status['name'] }}" @if(!empty($product['item_status']) && $product['item_status'] == $status['name']) selected @endif>{{ $status['name'] }}</option>
                                                    @endforeach
                                                </select>
                                                <select style="width:200px;" name="delivery_boy_name" id="delivery_boy_name" required="">
                                                    <option value="">Select DeliveryBoy</option>
                                                    @foreach($deliveryBoyStatus as $status)
                                                        <option value="{{ $status['name'] }}" @if(!empty($product['delivery_boy_name']) && $product['delivery_boy_name'] == $status['name']) selected @endif>{{ $status['name'] }}</option>
                                                    @endforeach
                                                </select>
                                                <input style="width:100px;" type="text" name="item_courier_name" id="item_courier_name" placeholder="Courier Name" @if(!empty($product['courier_name'])) value="{{ $product['courier_name'] }}" @endif>&nbsp;
                                                <input style="width:100px;" type="text" name="item_tracking_number" id="item_tracking_number" placeholder="Tracking Number" @if(!empty($product['tracking_number'])) value="{{ $product['tracking_number'] }}" @endif>
                                                <button class="btn btn-primary" type="submit">Update Status</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
    <!-- partial:partials/_footer.html -->
    @include('admin.layout.footer')
    <!-- partial -->
</div>
@endsection