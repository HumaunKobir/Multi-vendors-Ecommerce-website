<?php 
    use App\Models\Product;
    use App\Models\ProductsFilter;
    $getDiscountPrice = Product::getDiscountPrice($productDetails['id']);
    $productFilters = ProductsFilter::productFilters();
    //dd($productFilters);
?>
@extends('front.layouts.layout')
@section('content')
<style>
    *{
        margin: 0;
        padding: 0;
    }
    .rate {
        float: left;
        height: 46px;
        padding: 0 10px;
    }
    .rate:not(:checked) > input {
        position:inherit;
        top:-9999px;
    }
    .rate:not(:checked) > label {
        float:right;
        width:1em;
        overflow:hidden;
        white-space:nowrap;
        cursor:pointer;
        font-size:30px;
        color:#ccc;
    }
    .rate:not(:checked) > label:before {
        content: '★ ';
    }
    .rate > input:checked ~ label {
        color: #ffc700;    
    }
    .rate:not(:checked) > label:hover,
    .rate:not(:checked) > label:hover ~ label {
        color: #deb217;  
    }
    .rate > input:checked + label:hover,
    .rate > input:checked + label:hover ~ label,
    .rate > input:checked ~ label:hover,
    .rate > input:checked ~ label:hover ~ label,
    .rate > label:hover ~ input:checked ~ label {
        color: #c59b08;
    }
</style>
<!-- Begin Li's Breadcrumb Area -->
<div class="breadcrumb-area">
    <div class="container">
        <div class="breadcrumb-content">
            <ul>
                <li><a href="{{url('/')}}">Home</a></li>
                <?php echo $categoryDetails['breadcrumbs']?>
            </ul>
        </div>
    </div>
</div>
<!-- Li's Breadcrumb Area End Here -->
<!-- content-wraper start -->
<div class="content-wraper">
    <div class="container">
        <div class="row single-product-area">
            <div class="col-lg-5 col-md-6">
                <!-- Product Details Left -->
                <div class="product-details-left">
                    <div class="product-details-images slider-navigation-1">
                        <div class="lg-image zoom-container">
                            <a class="popup-img venobox vbox-item" href="{{asset('front/images/product_image/'.$productDetails['product_image'])}}" data-gall="myGallery">
                            <?php $product_image_path = 'front/images/product_image/'.$productDetails['product_image']?>
                                @if(!empty($productDetails['product_image']) && file_exists($product_image_path))
                                <img src="{{url($product_image_path)}}" alt="Li's Product Image">
                                @else
                                <img src="{{url('front/images/product_image/no_image.png')}}" alt="Li's Product Image">
                                @endif
                            </a>
                        </div>
                        @foreach($productDetails['images'] as $image)
                            <div class="lg-image zoom-container">
                                <a class="popup-img venobox vbox-item" href="{{asset('front/images/product_image/'.$image['image'])}}" data-gall="myGallery">
                                <?php $product_image_path = 'front/images/product_image/'.$image['image']?>
                                    @if(!empty($image['image']) && file_exists($product_image_path))
                                    <img src="{{url($product_image_path)}}" alt="Li's Product Image">
                                    @else
                                    <img src="{{url('front/images/product_image/no_image.png')}}" alt="Li's Product Image">
                                    @endif
                                </a>
                            </div>
                        @endforeach
                    </div>
                    <div class="product-details-thumbs slider-thumbs-1"> 
                        @foreach($productDetails['images'] as $image)
                        <?php $product_image_path = 'front/images/product_image/'.$image['image']?>
                            @if(!empty($image['image']) && file_exists($product_image_path))
                            <img src="{{url($product_image_path)}}" alt="Li's Product Image">
                            @else
                            <img src="{{url('front/images/product_image/no_image.png')}}" alt="Li's Product Image">
                            @endif
                        @endforeach
                    </div>
                </div>
                <!--// Product Details Left -->
            </div>

            <div class="col-lg-7 col-md-6">
                @if(Session::has('error_message'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Error::</strong><?php echo Session::get('error_message') ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @if(Session::has('success_message'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success::</strong><?php echo Session::get('success_message')?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="product-details-view-content pt-60">
                    <div class="product-info">
                        <h2>{{$productDetails['product_name']}}</h2>
                        <span class="product-details-ref">
                            <div class="breadcrumb-content">
                                <ul>
                                    <li><a href="{{url('/')}}">Home</a></li>
                                    <li><a href="javascript:;">{{$productDetails['section']['name']}}</a></li>
                                    <?php echo $categoryDetails['breadcrumbs']?>
                                </ul>
                            </div>
                        </span>
                        <div class="rating-box pt-20">
                            <ul class="rating rating-with-review-item">
                                <li> <span>
                                    <?php 
                                        $star=1;
                                        while($star<=$avgStarRating){ 
                                    ?>
                                    <span style="color:gold;">&#9733;</span>
                                    <?php $star++; }?>
                                </span></li>
                                <li><span>({{$avgRating}})</span></li>
                                <li class="review-item"><a href="#">Read Review</a></li>
                                <li class="review-item"><a href="#">Write Review</a></li>
                            </ul>
                        </div>
                        <span class="getAttributePrice">
                            @if($getDiscountPrice > 0)
                                <div class="price-box pt-20">
                                    <span class="new-price new-price-2">{{$getDiscountPrice}} tk</span>
                                </div>
                                <div class="price-box pt-20">
                                    <span>Original Price : </span>
                                    <span class="old-price"> {{$productDetails['product_price']}} tk</span>
                                </div>
                            @else
                                <div class="price-box pt-20">
                                    <span class="new-price new-price-2">{{$productDetails['product_price']}} tk</span>
                                </div> 
                            @endif
                        </span>
                        <div class="product-desc">
                            <label>Description</label>
                            <p>
                                <span>{{$productDetails['product_description']}}
                                </span>
                            </p>
                        </div>
                        <label>SKU Information:-</label><br>
                        <label>Product Code:&nbsp; {{$productDetails['product_code']}}</label><br>
                        <label>Product Color:&nbsp; {{$productDetails['product_color']}}</label><br>
                        <label>Availability:&nbsp;
                            @if($totalStock>0)
                            <span style="color:green;">in Stock</span>
                            @else
                            <span style="color:red;">Out of Stock</span>
                            @endif
                        </label><br>
                        @if($totalStock>0)
                        <label>Only:&nbsp; {{ $totalStock}} left</label>
                        @endif
                        @if(isset($productDetails['vendor']))
                            <label style="font-size:20px;">Sold by: <a style="font-size:20px;" href="/products/{{$productDetails['vendor']['id']}}"> {{ $productDetails['vendor']['vendorsbusinessdetails']['shop_name']}}</a></label>
                        @endif
                        <form action="{{ url('cart/add') }}" method="post" class="">@csrf
                        <input type="hidden" name="product_id" value="{{ $productDetails['id']}}">
                            <div class="product-variants">
                                <div class="produt-variants-size">
                                    <label>Available Size</label>
                                    <select name="size" id="getPrice" product-id="{{ $productDetails['id']}}" class="nice-select" required>
                                        <option value="">Select Size</option>
                                        @foreach($productDetails['attributes'] as $attribute)
                                            <option value="{{ $attribute['size']}}">{{ $attribute['size']}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="single-add-to-cart cart-quantity">
                                <div class="quantity">
                                    <label>Quantity</label>
                                    <div class="cart-plus-minus">
                                        <input class="cart-plus-minus-box" name="quantity" value="1" type="text">
                                        <div class="dec qtybutton"><i class="fa fa-angle-down"></i></div>
                                        <div class="inc qtybutton"><i class="fa fa-angle-up"></i></div>
                                    </div>
                                </div>
                                <button class="add-to-cart" type="submit">Add to cart</button>
                            </div>
                        </form>
                        <div class="product-additional-info pt-25">
                            <a class="wishlist-btn" href="wishlist.html"><i class="fa fa-heart-o"></i>Add to wishlist</a>
                            <div class="product-social-sharing pt-25">
                                <ul>
                                    <li class="facebook"><a href="#"><i class="fa fa-facebook"></i>Facebook</a></li>
                                    <li class="twitter"><a href="#"><i class="fa fa-twitter"></i>Twitter</a></li>
                                    <li class="google-plus"><a href="#"><i class="fa fa-google-plus"></i>Google +</a></li>
                                    <li class="instagram"><a href="#"><i class="fa fa-instagram"></i>Instagram</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="block-reassurance">
                            <ul>
                                <li>
                                    <div class="reassurance-item">
                                        <div class="reassurance-icon">
                                            <i class="fa fa-check-square-o"></i>
                                        </div>
                                        <p>Security policy (edit with Customer reassurance module)</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="reassurance-item">
                                        <div class="reassurance-icon">
                                            <i class="fa fa-truck"></i>
                                        </div>
                                        <p>Delivery policy (edit with Customer reassurance module)</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="reassurance-item">
                                        <div class="reassurance-icon">
                                            <i class="fa fa-exchange"></i>
                                        </div>
                                        <p> Return policy (edit with Customer reassurance module)</p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
    </div>
</div>
<!-- content-wraper end -->
<!-- Begin Product Area -->
<div class="product-area pt-35">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="li-product-tab">
                    <ul class="nav li-product-menu">
                        <li><a class="active" data-toggle="tab" href="#video"><span>Product Video</span></a></li>
                        <li><a data-toggle="tab" href="#product-details"><span>Product Details</span></a></li>
                        <li><a data-toggle="tab" href="#reviews"><span>Reviews ({{count($ratings)}})</span></a></li>
                    </ul>               
                </div>
                <!-- Begin Li's Tab Menu Content Area -->
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-sm-2"></div>
                <div class="col-sm-8">
                    <div class="tab-content">
                        <div id="video" class="tab-pane active show" role="tabpanel">
                            <div class="product-description">
                                @if($productDetails['product_video'])
                                    <video width="320" height="240" controls>
                                        <source src="{{ url('front/videos/product_video/'.$productDetails['product_video'])}}" type="video/mp4">
                                    </video>
                                @else
                                Product Video Dose Not Exists...
                                @endif
                            </div>
                        </div>
                        <div id="product-details" class="tab-pane" role="tabpanel">
                            <div class="product-details-manufacturer text-center">
                                <table class="table table-bordered">
                                @foreach($productFilters as $filter)
                                    <?php 
                                        $filterAvailable = ProductsFilter::filterAvailable($filter['id'],$categoryDetails['categoryDetails']['id']);
                                    ?>
                                        @if($filterAvailable == "Yes")
                                        <tr>
                                                <td>{{ $filter['filter_name'] }}</td>
                                                <td>
                                                    @foreach($filter['filter_values'] as $value)
                                                        @if(!empty($productDetails[$filter['filter_column']]) && $value['filter_value'] == $productDetails[$filter['filter_column']])
                                                        {{ ucwords($value['filter_value'])}}
                                                        @endif
                                                    @endforeach
                                                </td>
                                        </tr>
                                        @endif
                                    @endforeach
                                </table>
                            </div>
                        </div>
                        <div id="reviews" class="tab-pane" role="tabpanel">
                            <div class="product-reviews">
                                <div class="product-details-comment-block">
                                    <div class="review-btn">
                                        <a class="review-links" href="#" data-toggle="modal" data-target="#mymodal">Write Your Review!</a><br>
                                    </div><br>
                                    <div class="text-center">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Reviews ({{count($ratings)}})</th>
                                                        <th>Rating</th>
                                                    </tr>
                                                </thead>
                                                @foreach($ratings as $rating)
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <p>{{$rating['user']['name']}}</p>
                                                            <p>{{date("d-m-y H:i:s",strtotime($rating['created_at']))}}</p>
                                                        </td>
                                                        <td>
                                                            <span>
                                                                <?php 
                                                                    $count=0;
                                                                    while($count<$rating['rating']){ 
                                                                ?>
                                                                <span style="color:gold;">&#9733;</span>
                                                                <?php $count++; }?>
                                                            </span>
                                                            <p>{{$rating['review']}}</p>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                                @endforeach
                                            </table>
                                        </div>
                                    <!-- Begin Quick View | Modal Area -->
                                    <div class="modal fade modal-wrapper" id="mymodal" >
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <h3 class="review-page-title">Write Your Review</h3>
                                                    
                                                    <div class="modal-inner-area row">
                                                        <div class="col-lg-6">
                                                            <div class="li-review-product">
                                                            <?php $product_image_path = 'front/images/product_image/'.$productDetails['product_image']?>
                                                                <a href="javascript:;">
                                                                    @if(!empty($productDetails['product_image']) && file_exists($product_image_path))
                                                                    <img src="{{url($product_image_path)}}" alt="Li's Product Image">
                                                                    @else
                                                                    <img src="{{url('front/images/product_image/no_image.png')}}" alt="Li's Product Image">
                                                                    @endif
                                                                </a>
                                                                <div class="li-review-product-desc">
                                                                    <p class="li-product-name">{{$productDetails['product_name']}}</p>
                                                                    <p>
                                                                        <span>{{ $productDetails['product_description']}} </span>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="li-review-content">
                                                                <!-- Begin Feedback Area -->
                                                                <div class="feedback-area">
                                                                    <div class="feedback">
                                                                        <h3 class="feedback-title">Our Feedback</h3>
                                                                        <form action="{{ url('add-rating')}}" method="post" name="formRating" id="formRating">@csrf
                                                                        <input type="hidden" name="product_id" value="{{ $productDetails['id']}}">
                                                                            <p class="your-opinion">
                                                                                <label>Your Rating</label>
                                                                                <span>
                                                                                <div class="rate">
                                                                                    <input style="display:none;" type="radio" id="star5" name="rating" value="5" />
                                                                                    <label for="star5" title="text">5 stars</label>
                                                                                    <input style="display:none;" type="radio" id="star4" name="rating" value="4" />
                                                                                    <label for="star4" title="text">4 stars</label>
                                                                                    <input style="display:none;" type="radio" id="star3" name="rating" value="3" />
                                                                                    <label for="star3" title="text">3 stars</label>
                                                                                    <input style="display:none;" type="radio" id="star2" name="rating" value="2" />
                                                                                    <label for="star2" title="text">2 stars</label>
                                                                                    <input style="display:none;" type="radio" id="star1" name="rating" value="1" />
                                                                                    <label for="star1" title="text">1 star</label>
                                                                                </div>
                                                                                </span>
                                                                            </p><br>
                                                                            <p class="feedback-form">
                                                                                <label for="feedback">Your Review</label>
                                                                                <textarea id="feedback" name="review" cols="45" rows="8" aria-required="true" required=""></textarea>
                                                                            </p>
                                                                            <div class="feedback-input">
                                                                                <div class="feedback-btn pb-15">
                                                                                    <button class="btn btn-primary">Submit Review</button>
                                                                                </div>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                                <!-- Feedback Area End Here -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>   
                                    <!-- Quick View | Modal Area End Here -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-2"></div>
            </div>
        </div>
    </div>
</div>
<!-- Product Area End Here -->
<!-- Begin Li's Laptop Product Area -->
<section class="product-area li-laptop-product pt-30 pb-50">
    <div class="container">
        <div class="row">
            <!-- Begin Li's Section Area -->
            <div class="col-lg-12">
                <div class="li-section-title">
                    <h2>
                        <span>15 other products in the same category:</span>
                    </h2>
                </div>
                <div class="row">
                    @foreach($similerProducts as $product)
                    <div class="col-lg-3 col-md-3 col-sm-6 mt-40">
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
            <!-- Li's Section Area End Here -->
        </div>
    </div>
</section>
<!-- Li's Laptop Product Area End Here -->
@endsection