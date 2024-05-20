<?php use App\Models\Product; ?>
@extends('front.layouts.layout')
@section('content')
<!-- Begin Slider With Banner Area -->
<div class="slider-with-banner">
<div class="container">
    <div class="row">
        <!-- Begin Slider Area -->
        <div class="col-lg-8 col-md-8">
            <div class="slider-area">
                <div class="slider-active owl-carousel">
                    <!-- Begin Single Slide Area -->
                    @foreach($sliderbanners as $banner)
                    <div class="single-slide align-center-left animation-style-01 bg-3"style="background-image: url('{{ asset('front/images/banner_image/'.$banner['image']) }}');">
                        <div class="slider-progress"></div>
                        <div class="slider-content">
                            <h5>Sale Offer <span>Black Friday</span> This Week</h5>
                            <h2>Work Desk Surface Studio 2018</h2>
                            <h3>Starting at <span>$824.00</span></h3>
                            <div class="default-btn slide-btn">
                                <a class="links" @if(!empty($banner['link']))  href="{{ url($banner['link'])}}" @else href="javascript:;" @endif >Shopping Now</a>
                            </div>
                        </div> 
                    </div>
                    @endforeach
                    <!-- Single Slide Area End Here -->
                </div>
            </div>
        </div>
        <!-- Slider Area End Here -->
        <!-- Begin Li Banner Area -->
        @if(isset($fixbanners[0]['image']))
        <div class="col-lg-4 col-md-4 text-center pt-xs-30">
            <div class="li-banner">
            <a @if(!empty($fixbanners[0]['link']))  href="{{ url($fixbanners[0]['link'])}}" @else href="javascript:;" @endif >
                <img style="width:370px; height:230px;margin-bottom:5px;" src="{{asset('front/images/banner_image/'.$fixbanners[0]['image'])}}" alt="{{ $fixbanners[0]['alt']}}">
            </a>
            </div>
            <div class="li-banner">
            <a @if(!empty($fixbanners[1]['link']))  href="{{ url($fixbanners[1]['link'])}}" @else href="javascript:;" @endif >
                <img style="width:370px; height:230px;margin-bottom:5px;" src="{{asset('front/images/banner_image/'.$fixbanners[1]['image'])}}" alt="{{ $fixbanners[1]['alt']}}">
            </a>
            </div>
        </div>
        @endif
        <!-- Li Banner Area End Here -->
    </div>
</div>
</div>
<!-- Slider With Banner Area End Here -->
<!-- Begin Product Area -->
<div class="product-area pt-60 pb-50">
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="li-product-tab">
                <ul class="nav li-product-menu">
                    <li><a class="active" data-toggle="tab" href="#li-new-product"><span>New Arrival</span></a></li>
                    <li><a data-toggle="tab" href="#li-bestseller-product"><span>Bestseller</span></a></li>
                    <li><a data-toggle="tab" href="#li-discounted-product"><span>Discounted Products</span></a></li>
                    <li><a data-toggle="tab" href="#li-featured-product"><span>Featured Products</span></a></li>
                </ul>               
            </div>
            <!-- Begin Li's Tab Menu Content Area -->
        </div>
    </div>
    <div class="tab-content">
        <div id="li-new-product" class="tab-pane active show" role="tabpanel">
            <div class="row">
                <div class="product-active owl-carousel">
                    @foreach($newProducts as $product)
                    <?php $product_image_path = 'front/images/product_image/'.$product['product_image']?>
                    <div class="col-lg-12">
                        <!-- single-product-wrap start -->
                        <div class="single-product-wrap">
                            <div class="product-image">
                                <a href="{{url('product/'.$product['id'])}}">
                                    @if(!empty($product['product_image']) && file_exists($product_image_path))
                                    <img src="{{url($product_image_path)}}" alt="Li's Product Image">
                                    @else
                                    <img src="{{url('front/images/product_image/no_image.png')}}" alt="Li's Product Image">
                                    @endif
                                </a>
                                <span class="sticker">New</span>
                            </div>
                            <div class="product_desc">
                                <div class="product_desc_info">
                                    <div class="product-review">
                                        <h5 class="manufacturer">
                                            <a href="{{url('product/'.$product['id'])}}">{{ $product['product_code'] }}</a>
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
                                    <h4><a class="product_name" href="{{url('product/'.$product['id'])}}">{{$product['product_name']}}</a></h4>
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
                                <div class="add-actions">
                                    <ul class="add-actions-link">
                                        <li class="add-cart active"><a href="#">Add to cart</a></li>
                                        <li><a class="links-details" href="wishlist.html"><i class="fa fa-heart-o"></i></a></li>
                                        <li><a href="#" title="quick view" class="quick-view-btn" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-eye"></i></a></li>
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
        <div id="li-bestseller-product" class="tab-pane" role="tabpanel">
            <div class="row">
                <div class="product-active owl-carousel">
                    @foreach($bestSellers as $product)
                    <?php $product_image_path = 'front/images/product_image/'.$product['product_image']?>
                    <div class="col-lg-12">
                        <!-- single-product-wrap start -->
                        <div class="single-product-wrap">
                            <div class="product-image">
                                <a href="{{url('product/'.$product['id'])}}">
                                    @if(!empty($product['product_image']) && file_exists($product_image_path))
                                    <img src="{{url($product_image_path)}}" alt="Li's Product Image">
                                    @else
                                    <img src="{{url('front/images/product_image/no_image.png')}}" alt="Li's Product Image">
                                    @endif
                                </a>
                                <span class="sticker">New</span>
                            </div>
                            <div class="product_desc">
                                <div class="product_desc_info">
                                    <div class="product-review">
                                        <h5 class="manufacturer">
                                        <a href="{{url('product/'.$product['id'])}}">{{ $product['product_code'] }}</a>
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
                                    <h4><a class="product_name" href="{{url('product/'.$product['id'])}}">{{$product['product_name']}}</a></h4>
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
                                <div class="add-actions">
                                    <ul class="add-actions-link">
                                        <li class="add-cart active"><a href="#">Add to cart</a></li>
                                        <li><a class="links-details" href="wishlist.html"><i class="fa fa-heart-o"></i></a></li>
                                        <li><a href="#" title="quick view" class="quick-view-btn" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-eye"></i></a></li>
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
        <div id="li-discounted-product" class="tab-pane" role="tabpanel">
            <div class="row">
                <div class="product-active owl-carousel">
                    @foreach($proDiscounts as $product)
                    <?php $product_image_path = 'front/images/product_image/'.$product['product_image']?>
                        <div class="col-lg-12">
                            <!-- single-product-wrap start -->
                            <div class="single-product-wrap">
                                <div class="product-image">
                                    <a href="{{url('product/'.$product['id'])}}">
                                        @if(!empty($product['product_image']) && file_exists($product_image_path))
                                        <img src="{{url($product_image_path)}}" alt="Li's Product Image">
                                        @else
                                        <img src="{{url('front/images/product_image/no_image.png')}}" alt="Li's Product Image">
                                        @endif
                                    </a>
                                    <span class="sticker">New</span>
                                </div>
                                <div class="product_desc">
                                    <div class="product_desc_info">
                                        <div class="product-review">
                                            <h5 class="manufacturer">
                                            <a href="{{url('product/'.$product['id'])}}">{{ $product['product_code'] }}</a>
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
                                        <h4><a class="product_name" href="{{url('product/'.$product['id'])}}">{{$product['product_name']}}</a></h4>
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
                                    <div class="add-actions">
                                        <ul class="add-actions-link">
                                            <li class="add-cart active"><a href="#">Add to cart</a></li>
                                            <li><a class="links-details" href="wishlist.html"><i class="fa fa-heart-o"></i></a></li>
                                            <li><a href="#" title="quick view" class="quick-view-btn" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-eye"></i></a></li>
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
        <div id="li-featured-product" class="tab-pane" role="tabpanel">
            <div class="row">
                <div class="product-active owl-carousel">
                @foreach($proFeatured as $product)
                <?php $product_image_path = 'front/images/product_image/'.$product['product_image']?>
                    <div class="col-lg-12">
                        <!-- single-product-wrap start -->
                        <div class="single-product-wrap">
                            <div class="product-image">
                                <a href="{{url('product/'.$product['id'])}}">
                                    @if(!empty($product['product_image']) && file_exists($product_image_path))
                                    <img src="{{url($product_image_path)}}" alt="Li's Product Image">
                                    @else
                                    <img src="{{url('front/images/product_image/no_image.png')}}" alt="Li's Product Image">
                                    @endif
                                </a>
                                <span class="sticker">New</span>
                            </div>
                            <div class="product_desc">
                                <div class="product_desc_info">
                                    <div class="product-review">
                                        <h5 class="manufacturer">
                                        <a href="{{url('product/'.$product['id'])}}">{{ $product['product_code'] }}</a>
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
                                    <h4><a class="product_name" href="{{url('product/'.$product['id'])}}">{{$product['product_name']}}</a></h4>
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
                                <div class="add-actions">
                                    <ul class="add-actions-link">
                                        <li class="add-cart active"><a href="#">Add to cart</a></li>
                                        <li><a class="links-details" href="wishlist.html"><i class="fa fa-heart-o"></i></a></li>
                                        <li><a href="#" title="quick view" class="quick-view-btn" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-eye"></i></a></li>
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
    </div>
</div>
</div>
<!-- Product Area End Here -->
<!-- Begin Li's Static Banner Area -->
<div class="li-static-banner">
<div class="container">
    <div class="row">
        <!-- Begin Single Banner Area -->
        @if(isset($fixbanners[0]['image']))
        <div class="col-lg-4 col-md-4 text-center">
            <div class="single-banner">
                <a @if(!empty($fixbanners[0]['link']))  href="{{ url($fixbanners[0]['link'])}}" @else href="javascript:;" @endif >
                    <img style="width:370px; height:230px;margin-bottom:5px;" src="{{asset('front/images/banner_image/'.$fixbanners[0]['image'])}}" alt="{{ $fixbanners[0]['alt']}}">
                </a>
            </div>
        </div>
        @endif
        <!-- Single Banner Area End Here -->
        <!-- Begin Single Banner Area -->
        @if(isset($fixbanners[1]['image']))
        <div class="col-lg-4 col-md-4 text-center pt-xs-30">
            <div class="single-banner">
                <a @if(!empty($fixbanners[1]['link']))  href="{{ url($fixbanners[1]['link'])}}" @else href="javascript:;" @endif >
                    <img style="width:370px; height:230px;margin-bottom:5px;" src="{{asset('front/images/banner_image/'.$fixbanners[1]['image'])}}" alt="{{ $fixbanners[1]['alt']}}">
                </a>
            </div>
        </div>
        @endif
        <!-- Single Banner Area End Here -->
        <!-- Begin Single Banner Area -->
        @if(isset($fixbanners[2]['image']))
        <div class="col-lg-4 col-md-4 text-center pt-xs-30">
            <div class="single-banner">
                <a @if(!empty($fixbanners[2]['link']))  href="{{ url($fixbanners[2]['link'])}}" @else href="javascript:;" @endif >
                    <img style="width:370px; height:230px;margin-bottom:5px;" src="{{asset('front/images/banner_image/'.$fixbanners[2]['image'])}}" alt="{{ $fixbanners[2]['alt']}}">
                </a>
            </div>
        </div>
        @endif
        <!-- Single Banner Area End Here -->
    </div>
</div>
</div>
<!-- Li's Static Banner Area End Here -->
<!-- Begin Li's Laptop Product Area -->
<section class="product-area li-laptop-product pt-60 pb-45">
<div class="container">
    <div class="row">
        <!-- Begin Li's Section Area -->
        <div class="col-lg-12">
            <div class="li-section-title">
                <h2>
                    <span>Featured Products</span>
                </h2>
            </div>
            <div class="row">
                <div class="product-active owl-carousel">
                @foreach($proFeatured as $product)
                <?php $product_image_path = 'front/images/product_image/'.$product['product_image']?>
                    <div class="col-lg-12">
                        <!-- single-product-wrap start -->
                        <div class="single-product-wrap">
                            <div class="product-image">
                                <a href="{{url('product/'.$product['id'])}}">
                                    @if(!empty($product['product_image']) && file_exists($product_image_path))
                                    <img src="{{url($product_image_path)}}" alt="Li's Product Image">
                                    @else
                                    <img src="{{url('front/images/product_image/no_image.png')}}" alt="Li's Product Image">
                                    @endif
                                </a>
                                <span class="sticker">New</span>
                            </div>
                            <div class="product_desc">
                                <div class="product_desc_info">
                                    <div class="product-review">
                                        <h5 class="manufacturer">
                                        <a href="{{url('product/'.$product['id'])}}">{{ $product['product_code'] }}</a>
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
                                    <h4><a class="product_name" href="{{url('product/'.$product['id'])}}">{{$product['product_name']}}</a></h4>
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
                                <div class="add-actions">
                                    <ul class="add-actions-link">
                                        <li class="add-cart active"><a href="#">Add to cart</a></li>
                                        <li><a class="links-details" href="wishlist.html"><i class="fa fa-heart-o"></i></a></li>
                                        <li><a href="#" title="quick view" class="quick-view-btn" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-eye"></i></a></li>
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
        <!-- Li's Section Area End Here -->
    </div>
</div>
</section>
<!-- Li's Laptop Product Area End Here -->
<!-- Begin Li's TV & Audio Product Area -->
<section class="product-area li-laptop-product li-tv-audio-product pb-45">
<div class="container mb-4">
    <div class="row">
        <!-- Begin Li's Section Area -->
        <div class="col-lg-12">
            <div class="li-section-title">
                <h2>
                    <span>Discounted Products</span>
                </h2>
            </div>
            <div class="row">
                <div class="product-active owl-carousel">
                    @foreach($proDiscounts as $product)
                    <?php $product_image_path = 'front/images/product_image/'.$product['product_image']?>
                        <div class="col-lg-12">
                            <!-- single-product-wrap start -->
                            <div class="single-product-wrap">
                                <div class="product-image">
                                    <a href="{{url('product/'.$product['id'])}}">
                                        @if(!empty($product['product_image']) && file_exists($product_image_path))
                                        <img src="{{url($product_image_path)}}" alt="Li's Product Image">
                                        @else
                                        <img src="{{url('front/images/product_image/no_image.png')}}" alt="Li's Product Image">
                                        @endif
                                    </a>
                                    <span class="sticker">New</span>
                                </div>
                                <div class="product_desc">
                                    <div class="product_desc_info">
                                        <div class="product-review">
                                            <h5 class="manufacturer">
                                            <a href="{{url('product/'.$product['id'])}}">{{ $product['product_code'] }}</a>
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
                                        <h4><a class="product_name" href="{{url('product/'.$product['id'])}}">{{$product['product_name']}}</a></h4>
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
                                    <div class="add-actions">
                                        <ul class="add-actions-link">
                                            <li class="add-cart active"><a href="#">Add to cart</a></li>
                                            <li><a class="links-details" href="wishlist.html"><i class="fa fa-heart-o"></i></a></li>
                                            <li><a href="#" title="quick view" class="quick-view-btn" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-eye"></i></a></li>
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
        <!-- Li's Section Area End Here -->
    </div>
</div>
</section>
<!-- Li's TV & Audio Product Area End Here -->
<!-- Begin Li's Static Home Area -->

<div class="li-static-home mt-4">
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <!-- Begin Li's Static Home Image Area -->
            <div class="slider-active owl-carousel">
                <!-- Begin Single Slide Area -->
                @foreach($sliderbanners as $banner)
                <div class="single-slide align-center-left animation-style-01 bg-3"style="background-image: url('{{ asset('front/images/banner_image/'.$banner['image']) }}');">
                    <div class="slider-progress"></div>
                    <div class="slider-content">
                        <h5>Sale Offer <span>Black Friday</span> This Week</h5>
                        <h2>Work Desk Surface Studio 2018</h2>
                        <h3>Starting at <span>$824.00</span></h3>
                        <div class="default-btn slide-btn">
                        <a class="links" @if(!empty($banner['link']))  href="{{ url($banner['link'])}}" @else href="javascript:;" @endif >Shopping Now</a>
                        </div>
                    </div>
                </div>
                @endforeach
                <!-- Single Slide Area End Here -->
            </div>
            <!-- Li's Static Home Content Area End Here -->
        </div>
    </div>
</div>
</div>
<!-- Li's Static Home Area End Here -->
<!-- Begin Li's Trendding Products Area -->
<section class="product-area li-laptop-product li-trendding-products best-sellers pb-45">
<div class="container">
    <div class="row">
        <!-- Begin Li's Section Area -->
        <div class="col-lg-12">
            <div class="li-section-title">
                <h2>
                    <span>Bestsellers</span>
                </h2>
            </div>
            <div class="row">
                <div class="product-active owl-carousel">
                @foreach($bestSellers as $product)
                    <?php $product_image_path = 'front/images/product_image/'.$product['product_image']?>
                    <div class="col-lg-12">
                        <!-- single-product-wrap start -->
                        <div class="single-product-wrap">
                            <div class="product-image">
                                <a href="{{url('product/'.$product['id'])}}">
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
                                        <a href="{{url('product/'.$product['id'])}}">{{ $product['product_code'] }}</a>
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
                                    <h4><a class="product_name" href="{{url('product/'.$product['id'])}}">{{$product['product_name']}}</a></h4>
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
                                <div class="add-actions">
                                    <ul class="add-actions-link">
                                        <li class="add-cart active"><a href="#">Add to cart</a></li>
                                        <li><a class="links-details" href="wishlist.html"><i class="fa fa-heart-o"></i></a></li>
                                        <li><a href="#" title="quick view" class="quick-view-btn" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-eye"></i></a></li>
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
        <!-- Li's Section Area End Here -->
    </div>
</div>
</section>
<!-- Li's Trendding Products Area End Here -->
@endsection