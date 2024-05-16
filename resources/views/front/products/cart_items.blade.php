<?php 
    use App\Models\Product;
    use App\Models\ProductsAttribute;
    //dd($productFilters);
    $totalCartItems = totalCartItems();
?>

<div class="table-content table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>remove</th>
                <th class="li-product-thumbnail">images</th>
                <th class="cart-product-name">Product</th>
                <th class="li-product-price">Unit Price</th>
                <th class="li-product-quantity">Quantity</th>
                <th class="li-product-subtotal">Total</th>
            </tr>
        </thead>
        <tbody>
            @php $total_price = 0 @endphp
            @foreach($getCartItems as $item)
            <?php 
                $getDiscountAttributePrice = Product::getDiscountAttributePrice($item['product_id'],$item['size']);
            ?>
            <tr>
                <td><button class="close deleteCartItem" data-cartid="{{ $item['id']}}" style="margin-right:40px;" title="Remove">
                    <i class="fa fa-close"></i>
                </button></td>
                <td class="li-product-thumbnail">
                    <a href="{{ url('product/'.$item['product']['id'])}}">
                        <?php $product_image_path = 'front/images/product_image/'.$item['product']['product_image']?>
                        @if(!empty($item['product']['product_image']) && file_exists($product_image_path))
                        <img src="{{url($product_image_path)}}" alt="Li's Product Image">
                        @else
                        <img src="{{url('front/images/product_image/no_image.png')}}" alt="Li's Product Image">
                        @endif
                    </a>
                </td>
                <td class="li-product-name"><a href="{{ url('product/'.$item['product']['id'])}}">
                    {{ $item['product']['product_name']}} ({{$item['product']['product_code']}}) - {{ $item['size']}} <br>
                    Color: {{ $item['product']['product_color']}}
                </a></td>
                <td class="li-product-price"><span class="amount">
                    @if($getDiscountAttributePrice['discount'] > 0)
                        <div class="price-box pt-20">
                            <span class="new-price new-price-2">{{$getDiscountAttributePrice['final_price']}} tk</span>
                        </div>
                    @else
                        <div class="price-box pt-20">
                            <span class="new-price new-price-2">{{$getDiscountAttributePrice['final_price']}} tk</span>
                        </div> 
                    @endif
                </span></td>
                <td class="quantity">
                    <label>Quantity</label>
                    <div class="cart-plus-minus">
                        <div class="quantity">
                            <input class="cart-plus-minus-box" value="{{ $item['quantity'] }}" type="text" min="1">
                            <a class="dec qtybutton plus-a updateCartItem" id="updateCartItem" data-cartid="{{ $item['id']}}" data-qty="{{ $item['quantity'] }}"><i class="fa fa-angle-down"></i></a>
                            <a class="inc qtybutton minus-a updateCartItem" data-cartid="{{ $item['id']}}" data-qty="{{ $item['quantity'] }}" ><i class="fa fa-angle-up"></i></a>
                        </div>
                    </div>
                </td>
                <td class="product-subtotal"><span class="amount">{{$getDiscountAttributePrice['final_price'] * $item['quantity']}} tk</span></td>
            </tr>
            @php $total_price = $total_price + ($getDiscountAttributePrice['final_price'] * $item['quantity']) @endphp
            @endforeach
        </tbody>
    </table>
</div>
<div class="row">
    <div class="col-12">
        <div class="coupon-all">
            <div class="coupon">
                <input id="coupon_code" class="input-text" name="coupon_code" value="" placeholder="Coupon code" type="text">
                <input class="button" name="apply_coupon" value="Apply coupon" type="submit">
            </div>
            <div class="coupon2">
                <input class="button" name="update_cart" value="Update cart" type="submit">
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-5 ml-auto">
        <div class="cart-page-total">
            <h2>Cart totals</h2>
            <ul>
                <li>Subtotal <span>{{ $total_price }} tk</span></li>
                <li>Coupon Discount <span>0 tk</span></li>
                <li>Total <span>{{$total_price}} tk</span></li>
            </ul>
            <a href="{{url('checkout')}}">Proceed to checkout</a>
        </div>
    </div>
</div>
