<?php 
    use App\Models\Product;
    use App\Models\ProductsAttribute;
    //dd($productFilters);
    $getCartItems = getCartItems();
    $totalCartItems = totalCartItems();
?>
<div class="hm-minicart-trigger">
@php $total_price = 0 @endphp
    <span class="item-icon"></span>
    @foreach($getCartItems as $item)
            <?php 
                $getDiscountAttributePrice = Product::getDiscountAttributePrice($item['product_id'],$item['size']);
            ?>
            @php $total_price = $total_price + ($getDiscountAttributePrice['final_price'] * $item['quantity']) @endphp
        @endforeach
    <span class="item-text">{{$total_price}}
        <span class="cart-item-count">{{ $totalCartItems}}</span>
    </span>
</div>
<span></span>
<div class="minicart">
    <ul class="minicart-product-list">
        @php $total_price = 0 @endphp
        @foreach($getCartItems as $item)
            <?php 
                $getDiscountAttributePrice = Product::getDiscountAttributePrice($item['product_id'],$item['size']);
            ?>
            <li>
                <a href="{{ url('product/'.$item['product']['id'])}}" class="minicart-product-image">
                <?php $product_image_path = 'front/images/product_image/'.$item['product']['product_image']?>
                    @if(!empty($item['product']['product_image']) && file_exists($product_image_path))
                    <img src="{{url($product_image_path)}}" alt="Li's Product Image">
                    @else
                    <img src="{{url('front/images/product_image/no_image.png')}}" alt="Li's Product Image">
                    @endif
                </a>
                <div class="minicart-product-details">
                    <h6><a href="{{ url('product/'.$item['product']['id'])}}">
                    {{ $item['product']['product_name']}}</h6>
                    <span>{{$getDiscountAttributePrice['final_price']}} x {{$item['quantity']}} tk</span>
                </div>
                <button class="close deleteCartItem" data-cartid="{{ $item['id']}}" title="Remove">
                    <i class="fa fa-close"></i>
                </button>
            </li>
            @php $total_price = $total_price + ($getDiscountAttributePrice['final_price'] * $item['quantity']) @endphp
        @endforeach
    </ul>
    <p class="minicart-total">SUBTOTAL: <span>{{$total_price}}</span></p>
    <div class="minicart-button">
        <a href="{{url('cart')}}" class="li-button li-button-fullwidth li-button-dark">
            <span>View Full Cart</span>
        </a>
        <a href="{{url('checkout')}}" class="li-button li-button-fullwidth">
            <span>Checkout</span>
        </a>
    </div>
</div>