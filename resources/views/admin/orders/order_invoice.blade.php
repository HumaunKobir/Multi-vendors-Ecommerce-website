<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Multi Vendors Ecommerce</title>
    <style>
        body{
            background-color: #F6F6F6; 
            margin: 0;
            padding: 0;
        }
        h1,h2,h3,h4,h5,h6{
            margin: 0;
            padding: 0;
        }
        p{
            margin: 0;
            padding: 0;
        }
        .container{
            width: 80%;
            margin-right: auto;
            margin-left: auto;
        }
        .brand-section{
           background-color: #0d1033;
           padding: 10px 40px;
        }
        .logo{
            width: 50%;
        }

        .row{
            display: flex;
            flex-wrap: wrap;
        }
        .col-4{
            width: 33%;
            flex: 0 0 auto;
        }
        .text-white{
            color: #fff;
        }
        .company-details{
            float: right;
            text-align: right;
        }
        .body-section{
            padding: 16px;
            border: 1px solid gray;
        }
        .heading{
            font-size: 20px;
            margin-bottom: 08px;
        }
        .sub-heading{
            color: #262626;
            margin-bottom: 05px;
        }
        table{
            background-color: #fff;
            width: 100%;
            border-collapse: collapse;
        }
        table thead tr{
            border: 1px solid #111;
            background-color: #f2f2f2;
        }
        table td {
            vertical-align: middle !important;
            text-align: center;
        }
        table th, table td {
            padding-top: 08px;
            padding-bottom: 08px;
        }
        .table-bordered{
            box-shadow: 0px 0px 5px 0.5px gray;
        }
        .table-bordered td, .table-bordered th {
            border: 1px solid #dee2e6;
        }
        .text-right{
            text-align: end;
        }
        .w-20{
            width: 20%;
        }
        .float-right{
            float: right;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="brand-section">
            <div class="row">
                <div class="col-12">
                    <h1 class="text-white">Multi Vendors Ecommerce Website</h1>
                </div>
            </div>
        </div>

        <div class="body-section">
            <div class="row">
                <div class="col-4">
                    <h2 class="heading">Invoice No.: {{$orderDetail['id']}}
                    <?php echo DNS1D::getBarcodeHTML($orderDetail['id'], 'C39'); ?>
                    </h2>
                    <p class="sub-heading">Order Date: {{date('d-m-Y h:i:s',strtotime($orderDetail['created_at']));}} </p>
                    <p class="sub-heading">Email Address: {{ $orderDetail['email']}} </p>
                </div>
                <div class="col-4">
                    <p class="sub-heading">Full Name: {{ $orderDetail['name']}} </p>
                    <p class="sub-heading">Address: {{$orderDetail['address']}} </p>
                    <p class="sub-heading">Phone Number: {{ $orderDetail['mobile']}} </p>
                    <p class="sub-heading">City,State,Pincode:{{ $orderDetail['city']}}, {{ $orderDetail['state']}}, {{ $orderDetail['pincode']}}  </p>
                </div>
                <div class="col-4">
                    <p class="sub-heading">Full Name: {{ $userDetails['name']}} </p>
                    <p class="sub-heading">Address: {{$userDetails['address']}} </p>
                    <p class="sub-heading">Phone Number: {{ $userDetails['mobile']}} </p>
                    <p class="sub-heading">City,State,Pincode:{{ $userDetails['city']}}, {{ $userDetails['state']}}, {{ $userDetails['pincode']}}  </p>
                </div>
            </div>
        </div>

        <div class="body-section">
            <h3 class="heading">Ordered Items</h3>
            <br>
            <table class="table-bordered">
                <thead>
                    <tr>
                        <th class="w-15">Name</th>
                        <th class="w-15">Size</th>
                        <th class="w-15">Color</th>
                        <th class="w-15">Price</th>
                        <th class="w-15">Quantity</th>
                        <th class="w-15">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @php $subTotal = 0 @endphp
                    @foreach($orderDetail['orders_products'] as $product)
                    <tr>
                        <td>{{$product['product_name']}}
                        <?php echo DNS1D::getBarcodeHTML($product['id'], 'C39'); ?>
                        </td>
                        <td>{{$product['product_size']}}</td>
                        <td>{{$product['product_color']}}</td>
                        <td>{{$product['product_price']}}</td>
                        <td>{{$product['product_qty']}}</td>
                        <td>{{$product['product_price'] * $product['product_qty']}}</td>
                    </tr>
                    @php $subTotal = $subTotal + ($product['product_price'] * $product['product_qty']) @endphp
                    @endforeach
                    <tr>
                        <td colspan="5" class="text-right">Sub Total</td>
                        <td>{{ $subTotal}} tk</td>
                    </tr>
                    <tr>
                        <td colspan="5" class="text-right">Grand Total</td>
                        <td> {{ $orderDetail['total']}} tk</td>
                    </tr>
                </tbody>
            </table>
            <br>
            <h3 class="heading">Payment Status: {{$orderDetail['order_status']}}</h3>
            <h3 class="heading">Payment Mode: {{$orderDetail['payment_method']}}</h3>
        </div>

        <div class="body-section">
            <p>&copy; Copyright 2024 - HK. All rights reserved. 
                <a href="https://www.humaunkobir.com/" class="float-right">www.humaunkobir.com</a>
            </p>
        </div>      
    </div>      

</body>
</html>