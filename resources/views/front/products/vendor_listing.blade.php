@extends('front.layouts.layout')
@section('content')
<!-- Begin Li's Breadcrumb Area -->
<div class="breadcrumb-area">
    <div class="container">
        <div class="breadcrumb-content">
            <ul>
                <li><a href="{{url('/')}}">Home</a></li>
                <li><a href="javascript:;">{{$getVendorShop}} </a></li>
            </ul>
        </div>
    </div>
</div>
<!-- Li's Breadcrumb Area End Here -->
<!-- Begin Li's Content Wraper Area -->
<div class="content-wraper pt-60 pb-60">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 order-1 order-lg-2">
                <!-- Begin Li's Banner Area -->
                <div class="single-banner shop-page-banner">
                    <a class="text-center" style="font-size:40px;" href="#">
                        {{ $getVendorShop }}
                    </a>
                </div>
                <!-- Li's Banner Area End Here -->
                <!-- shop-top-bar start -->
                <div class="shop-top-bar mt-30">
                    <div class="shop-bar-inner">
                        <div class="product-view-mode">
                            <!-- shop-item-filter-list start -->
                            <ul class="nav shop-item-filter-list" role="tablist">
                                <li class="active" role="presentation"><a data-toggle="tab" role="tab" aria-controls="grid-view" href="#grid-view"><i class="fa fa-th"></i></a></li>
                                <li  role="presentation"><a aria-selected="true" class="active show" data-toggle="tab" role="tab" aria-controls="list-view" href="#list-view"><i class="fa fa-th-list"></i></a></li>
                            </ul>
                            <!-- shop-item-filter-list end -->
                        </div>
                        <div class="toolbar-amount">
                            <span>Showing: {{count($vendorProducts)}}</span>
                        </div>
                    </div>
                    <!-- product-select-box start -->
                    <?php /*<form name="sortProducts" id="sortProducts">
                        <input type="hidden" name="url" id="url" value="{{ $url }}">
                            <div class="product-select-box">
                                <div class="product-short">
                                    <p>Sort By:</p>
                                    <select id="sort" name="sort" class="nice-select">
                                        <option selected value="">Select</option>
                                        <option value="product_latest" @if(isset($_GET['sort']) && $_GET['sort'] == "product_latest") selected="" @endif>Latest Products</option>
                                        <option value="name_a_z" @if(isset($_GET['sort']) && $_GET['sort'] == "name_a_z") selected="" @endif>Name (A - Z)</option>
                                        <option value="name_z_a" @if(isset($_GET['sort']) && $_GET['sort'] == "name_z_a") selected="" @endif>Name (Z - A)</option>
                                        <option value="product_highest" @if(isset($_GET['sort']) && $_GET['sort'] == "product_highest") selected="" @endif>Highest Price</option>
                                        <option value="product_lowest" @if(isset($_GET['sort']) && $_GET['sort'] == "product_lowest") selected="" @endif>Lowest Price</option>
                                    </select>
                                </div>
                            </div>
                    </form> */ ?>
                    <!-- product-select-box end -->
                </div>
                <!-- shop-top-bar end -->
                <!-- shop-products-wrapper start -->
                <div class="filter_products">
                    @include('front.products.vendor_products_listing')
                </div>
                <!-- shop-products-wrapper end -->
            </div>
            <div class="col-lg-3 order-2 order-lg-1">
                <!--sidebar-categores-box start  -->
                <?php /* @include('front.products.filters') */ ?>
            </div>
        </div>
    </div>
</div>
<!-- Content Wraper Area End Here -->
@endsection