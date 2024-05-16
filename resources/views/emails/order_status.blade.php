<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <!-- https://cdnjs.com/libraries/twitter-bootstrap/5.0.0-beta1 -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0-beta1/css/bootstrap.min.css"
    />

    <!-- Icons: https://getbootstrap.com/docs/5.0/extend/icons/ -->
    <!-- https://cdnjs.com/libraries/font-awesome -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"
    />

    <title>Multi Vendors Ecommerce</title>
  </head>
  <body class="">
    <div class="container">
        <div class="row">
            <div class="card">
                <div class="col-sm-12">
                  <table>
                    <tr><td>Dear {{$name}}! </td></tr></td></tr>
                    <tr><td>&nbsp;</td></tr>
                    <tr><td>Your Order  #{{$order_id}} status has been updated to {{ $order_status }}</td></tr>
                    <tr><td>&nbsp;</td></tr>
                    @if(!empty($courier_name) && !empty($tracking_number))
                    <tr><td>
                        Courier Name is {{$courier_name}} and Tracking number is {{$tracking_number}}
                    </td></tr>
                    @endif
                    <tr><td>&nbsp;</td></tr>
                    <tr><td>Your order details are as below:</td></tr>
                  </table>
                </div>
                <div class="col-sm-12 col-xl-12 col-lg-12">
                    <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Product Code</th>
                            <th>Product Size</th>
                            <th>Product Color</th>
                            <th>Product Quantity</th>
                            <th>Product Price</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orderDetails['orders_products'] as $order)
                            <tr>
                                <td>{{$order['product_name']}}</td>
                                <td>{{$order['product_code']}}</td>
                                <td>{{$order['product_size']}}</td>
                                <td>{{$order['product_color']}}</td>
                                <td>{{$order['product_qty']}}</td>
                                <td>{{$order['product_price']}}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="5"align="right">Shipping Charges</td>
                            <td>0</td>
                        </tr>
                        <tr>
                            <td colspan="5"align="right">Total Price</td>
                            <td>{{$orderDetails['total']}} tk</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-sm-12">
                    <table class="table table-striped table-bordered">
                        <tr><td><strong>Delivery Address:</strong></td></tr>
                        <tr><td>{{$orderDetails['name']}}</td></tr>
                        <tr><td>{{$orderDetails['address']}}</td></tr>
                        <tr><td>{{$orderDetails['city']}}</td></tr>
                        <tr><td>{{$orderDetails['state']}}</td></tr>
                        <tr><td>{{$orderDetails['country']}}</td></tr>
                        <tr><td>{{$orderDetails['pincode']}}</td></tr>
                        <tr><td>{{$orderDetails['mobile']}}</td></tr>
                    </table>
                    <tr><td>&nbsp;</td></tr>
                    <tr><td>For any quries, you can contact us at Multivendor Ecommerce website- <a href="mailto:hktiune6@gamil.com">hktiune6@gmail.com</a></tr></td>
                    <tr><td>&nbsp;</td></tr><br>
                    <tr><td>Regards,<br>Team Multivendors Ecommerce</td></tr>
                </div>
            </div>
        </div>
        
    </div>


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0-beta1/js/bootstrap.bundle.min.js"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->

    <!-- https://cdnjs.com/libraries/popper.js/2.5.4 -->
    <!-- <script
      src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.5.4/umd/popper.min.js"
    ></script>
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0-beta1/js/bootstrap.min.js"
    ></script> -->

    <!-- More: https://getbootstrap.com/docs/5.0/getting-started/introduction/ -->
  </body>
</html>
