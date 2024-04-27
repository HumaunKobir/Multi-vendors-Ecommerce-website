<?php use App\Models\Product; ?>

<div class="shop-products-wrapper">
    <div class="tab-content">
        <div id="grid-view" class="tab-pane fade" role="tabpanel">
            <div class="product-area shop-product-area">
                <div class="row">
                    @foreach($categoryProducts as $product)
                    <div class="col-lg-4 col-md-4 col-sm-6 mt-40">
                        <!-- single-product-wrap start -->
                        <div class="single-product-wrap">
                            <div class="product-image">
                                <a href="{{ url('product/'.$product['id'])}}">
                                    <?php $product_image_path = 'front/images/product_image/'.$product['product_image']?>
                                    @if(!empty($product['product_image']) && file_exists($product_image_path))
                                    <img src="{{url($product_image_path)}}" alt="Li's Product Image">
                                    @else
                                    <img src="{{url('front/images/product_image/no_image.png')}}" alt="Li's Product Image">
                                    @endif
                                </a>
                                <?php $isProductNew = Product::isProductNew($product['id']); ?>
                                @if($isProductNew =="Yes")
                                <span class="sticker">New</span>
                                @endif
                            </div>
                            <div class="product_desc">
                                <div class="product_desc_info">
                                    <div class="product-review">
                                        <h5 class="manufacturer">
                                            <a href="product-details.html">{{ $product['product_code'] }} / </a>
                                            <a href="product-details.html">{{ $product['product_color'] }} / </a>
                                            <a href="product-details.html">{{ $product['brand']['name'] }}</a>
                                        </h5>
                                        <div class="rating-box">
                                            <ul class="rating">
                                                <li><i class="fa fa-star-o"></i></li>
                                                <li><i class="fa fa-star-o"></i></li>
                                                <li><i class="fa fa-star-o"></i></li>
                                                <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                <li class="no-star"><i class="fa fa-star-o"></i></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <h4><a class="product_name" href="{{ url('product/'.$product['id'])}}">{{$product['product_name']}}</a></h4>
                                    <div class="price-box">
                                        <?php $getDiscountPrice = Product::getDiscountPrice($product['id']); ?>
                                        @if($getDiscountPrice>0)
                                        <div class="price-box">
                                            <span class="new-price new-price-2">{{$getDiscountPrice}} tk</span>
                                            <span class="old-price">{{$product['product_price']}} tk</span>
                                            <span class="discount-percentage">-{{$product['product_discount']}}%</span>
                                        </div>
                                        @else
                                        <span class="new-price new-price-2">{{$product['product_price']}} tk</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="add-actions">
                                    <ul class="add-actions-link">
                                        <li class="add-cart active"><a href="shopping-cart.html">Add to cart</a></li>
                                        <li><a href="#" title="quick view" class="quick-view-btn" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-eye"></i></a></li>
                                        <li><a class="links-details" href="wishlist.html"><i class="fa fa-heart-o"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- single-product-wrap end -->
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div id="list-view" class="tab-pane fade product-list-view active show" role="tabpanel">
            <div class="row">
                <div class="col">
                    @foreach($categoryProducts as $product)
                    <div class="row product-layout-list">
                        <div class="col-lg-3 col-md-5 ">
                            <div class="product-image">
                                <a href="{{ url('product/'.$product['id'])}}">
                                <?php $product_image_path = 'front/images/product_image/'.$product['product_image']?>
                                    @if(!empty($product['product_image']) && file_exists($product_image_path))
                                    <img src="{{url($product_image_path)}}" alt="Li's Product Image">
                                    @else
                                    <img src="{{url('front/images/product_image/no_image.png')}}" alt="Li's Product Image">
                                    @endif
                                </a>
                                <?php $isProductNew = Product::isProductNew($product['id']); ?>
                                @if($isProductNew == "Yes")
                                <span class="sticker">New</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-5 col-md-7">
                            <div class="product_desc">
                                <div class="product_desc_info">
                                    <div class="product-review">
                                        <h5 class="manufacturer">
                                            <a href="javascript:;">{{ $product['product_code'] }} / </a>
                                            <a href="javascript:;">{{ $product['product_color'] }} / </a>
                                            <a href="javascript:;">{{ $product['brand']['name'] }}</a>
                                        </h5>
                                        <div class="rating-box">
                                            <ul class="rating">
                                                <li><i class="fa fa-star-o"></i></li>
                                                <li><i class="fa fa-star-o"></i></li>
                                                <li><i class="fa fa-star-o"></i></li>
                                                <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                <li class="no-star"><i class="fa fa-star-o"></i></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <h4><a class="product_name" href="{{ url('product/'.$product['id'])}}">{{$product['product_name']}}</a></h4>
                                    <div class="price-box">
                                        <?php $getDiscountPrice = Product::getDiscountPrice($product['id']); ?>
                                        @if($getDiscountPrice>0)
                                        <div class="price-box">
                                            <span class="new-price new-price-2">{{$getDiscountPrice}} tk</span>
                                            <span class="old-price">{{$product['product_price']}} tk</span>
                                            <span class="discount-percentage">-{{$product['product_discount']}}%</span>
                                        </div>
                                        @else
                                        <span class="new-price new-price-2">{{$product['product_price']}} tk</span>
                                        @endif
                                    </div><br><br>
                                    <p>{{ $product['product_description'] }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="shop-add-action mb-xs-30">
                                <ul class="add-actions-link">
                                    <li class="add-cart active"><a href="shopping-cart.html">Add to cart</a></li>
                                    <li><a href="#" title="quick view" class="quick-view-btn" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-eye"></i></a></li>
                                    <li><a title="Add to Wishlist" style="margin-right:200px;" class="links-details" href="wishlist.html"><i class="fa fa-heart-o"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="paginatoin-area">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <p>Showing 1-12 of {{ count($categoryProducts) }} item(s)</p>
                </div>
                @if(isset($_GET['sort']))
                <div class="col-lg-6 col-md-6">
                    <ul class="pagination-box">
                    {{ $categoryProducts->appends(['sort'=>$_GET['sort']])->links()}}
                    </ul>
                </div>
                @else
                <div class="col-lg-6 col-md-6">
                    <ul class="pagination-box">
                    {{ $categoryProducts->links()}}
                    </ul>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>