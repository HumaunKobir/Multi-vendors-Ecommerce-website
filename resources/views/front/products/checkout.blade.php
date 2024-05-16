<?php 
    use App\Models\Product;
    use App\Models\ProductsAttribute;
    //dd($productFilters);
    $totalCartItems = totalCartItems();
?>

@extends('front.layouts.layout')
@section('content')
     <!-- Begin Li's Breadcrumb Area -->
    <div class="breadcrumb-area">
                <div class="container">
                    <div class="breadcrumb-content">
                        <ul>
                            <li><a href="index.html">Home</a></li>
                            <li class="active">Checkout</li>
                        </ul>
                    </div>
                </div>
    </div>
    <!-- Li's Breadcrumb Area End Here -->
    <!--Checkout Area Strat-->
    <div class="checkout-area pt-60 pb-30">
        <div class="container">
            @if(Session::has('error_message'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Error::</strong> {{Session::get('error_message')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
            @endif
            <div class="row">
                <div class="col-lg-6 col-12" id="deliveryAddresses">
                    @include('front.products.delivery_address')
                </div>
                <div class="col-lg-6 col-12">
                    <form name="checkoutForm" id="checkoutForm" action="{{ url('/checkout') }}" method="post">@csrf
                            @if(count($deliveryAddresses)>0)
                            <h3>Delivery Address Details</h3>
                                @foreach($deliveryAddresses as $address)
                            <div class="row">
                                <div class="control-group" style="float:lef;margin-left:15px;"><input type="radio" id="address{{$address['id']}}" name="address_id"value="{{$address['id']}}"></div>
                                <div style="margin-top:10px;margin-left:5px;"><label  for="address{{$address['id']}}" class="control-label">{{$address['name']}}, {{$address['address']}}, {{$address['city']}}, {{$address['state']}}, {{$address['country']}} ( {{$address['mobile']}} )</label>
                                <a href="javascript:;" data-addressid="{{$address['id']}}" class="removeAddress"style="float:right;">&nbsp;&nbsp;Remove</a>
                                <a href="javascript:;" data-addressid="{{$address['id']}}" class="editAddress"style="float:right;">&nbsp;&nbsp;Edit</a>
                                </div>
                            </div>
                            @endforeach
                            @endif
                        <div class="your-order">
                            <h3>Your order</h3>
                            <div class="your-order-table table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="cart-product-name">Product</th>
                                            <th class="cart-product-total">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $total_price = 0 @endphp
                                        @foreach($getCartItems as $item)
                                        <?php 
                                            $getDiscountAttributePrice = Product::getDiscountAttributePrice($item['product_id'],$item['size']);
                                        ?>
                                        <tr class="cart_item">
                                            <td class="cart-product-name">
                                                <a href="{{ url('product/'.$item['product']['id'])}}">
                                                    <?php $product_image_path = 'front/images/product_image/'.$item['product']['product_image']?>
                                                    @if(!empty($item['product']['product_image']) && file_exists($product_image_path))
                                                    <img style="width:30px;" src="{{url($product_image_path)}}" alt="Li's Product Image">
                                                    @else
                                                    <img style="width:30px;" src="{{url('front/images/product_image/no_image.png')}}" alt="Li's Product Image">
                                                    @endif
                                                </a>
                                                {{ $item['product']['product_name']}} {{ $item['product']['product_color']}} - {{ $item['size']}}<strong class="product-quantity"> × {{ $item['quantity'] }}</strong></td>
                                            <td class="cart-product-total"><span class="amount">{{$getDiscountAttributePrice['final_price'] * $item['quantity']}} tk</span></td>  
                                        </tr>
                                        @php $total_price = $total_price + ($getDiscountAttributePrice['final_price'] * $item['quantity']) @endphp
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr class="cart-subtotal">
                                            <th>Cart Subtotal</th>
                                            <td><span class="amount">{{ $total_price }} tk</span></td>
                                        </tr>
                                        <tr class="order-total">
                                            <th>Order Total</th>
                                            <td><strong><span class="amount">{{ $total_price }} tk</span></strong></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="payment-method">
                                <div class="payment-accordion">
                                    <div id="accordion">
                                        <input style="width:18px; float:left; margin-right:5px;" type="radio" name="payment_gateway" id="cash-on-delivery" value="COD">
                                        <label for="cash-on-delivery" style="margin-top:9px; font-size:19px; color:#ffc107;" id="cash-on-delivery">Cash on Delivery</label>
                                    </div>
                                    <div id="accordion">
                                        <input style="width:18px; float:left; margin-right:5px;" id="Paypal" value="Paypal" type="radio" name="payment_gateway">
                                        <label for="Paypal" id="Paypal" style="margin-top:9px; font-size:19px; color:#ffc107;">Paypal</label>
                                    </div>
                                    <div class="order-button-payment">
                                        <input value="Place order" type="submit">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--Checkout Area End-->
@endsection