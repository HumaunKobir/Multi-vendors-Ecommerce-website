@extends('admin.layout.layout')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
       
        <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Orders</h4>
                  <p class="card-description">
                  </p>
                  <div class="table-responsive pt-3">
                  <table id="section" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Order ID</th>
                          <th>Order Date</th>
                          <th>Customer Name</th>
                          <th>Customer Email</th>
                          <th>Ordered Products</th>
                          <th>Order Amount</th>
                          <th>Order Status</th>
                          <th>Payment Method</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($orders as $order)
                        @if($order['orders_products'])
                        <tr>
                          <td>{{$order['id']}}</td>
                          <td>{{date('d-m-Y h:i:s',strtotime($order['created_at']));}}</td>
                          <td>{{$order['name']}}</td>
                          <td>{{$order['email']}}</td>
                          <td>
                          @foreach($order['orders_products'] as $product)
                            {{ $product['product_code']}} x {{ $product['product_qty']}} <br>
                          @endforeach
                          </td>
                          <td>{{$order['total']}}</td>
                          <td>{{$order['order_status']}}</td>
                          <td>{{$order['payment_method']}}</td>
                          <td>
                            <a href="{{ url('admin/orders/'.$order['id']) }}">
                            <i style="font-size:25px;" class="mdi mdi-file-document"></i></a>
                            <a target="_blank" href="{{ url('admin/orders/invoice/'.$order['id']) }}">
                            <i style="font-size:25px;" class="mdi mdi-printer"></i></a>
                          </td>
                        </tr>
                        @endif
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