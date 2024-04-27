<?php use App\Models\ProductsFilter; 
$productFilters = ProductsFilter::productFilters();
?>
<div class="sidebar-categores-box mt-sm-30 mt-xs-30">
    <div class="sidebar-title">
        <h2>Laptop</h2>
    </div>
    <!-- category-sub-menu start -->
    <div class="category-sub-menu">
        <ul>
            <li class="has-sub"><a href="# ">Prime Video</a>
                <ul>
                    <li><a href="#">All Videos</a></li>
                    <li><a href="#">Blouses</a></li>
                    <li><a href="#">Evening Dresses</a></li>
                    <li><a href="#">Summer Dresses</a></li>
                    <li><a href="#">T-Rent or Buy</a></li>
                    <li><a href="#">Your Watchlist</a></li>
                    <li><a href="#">Watch Anywhere</a></li>
                    <li><a href="#">Getting Started</a></li>  
                </ul>
            </li>
            <li class="has-sub"><a href="#">Computer</a>
                <ul>
                    <li><a href="#">TV & Video</a></li>
                    <li><a href="#">Audio & Theater</a></li>
                    <li><a href="#">Camera, Photo</a></li>
                    <li><a href="#">Cell Phones</a></li>
                    <li><a href="#">Headphones</a></li>
                    <li><a href="#">Video Games</a></li>
                    <li><a href="#">Wireless Speakers</a></li> 
                </ul>
            </li>
            <li class="has-sub"><a href="#">Electronics</a>
                <ul>
                    <li><a href="#">Amazon Home</a></li>
                    <li><a href="#">Kitchen & Dining</a></li>
                    <li><a href="#">Bed & Bath</a></li>
                    <li><a href="#">Appliances</a></li>    
                </ul>
            </li>
        </ul>
    </div>
    <!-- category-sub-menu end -->
</div>
<!--sidebar-categores-box end  -->
<!--sidebar-categores-box start  -->
<div class="sidebar-categores-box">
    <div class="sidebar-title">
        <h2>Filter By</h2>
    </div>
    <!-- btn-clear-all start -->
    <button class="btn-clear-all mb-sm-30 mb-xs-30">Clear all</button>
    <!-- btn-clear-all end -->
    <!-- filter-sub-area start -->
    @foreach($productFilters as $filter)
    <?php 
        $filterAvailable = ProductsFilter::filterAvailable($filter['id'],$categoryDetails['categoryDetails']['id']);
    ?>
        @if($filterAvailable == "Yes")
            @if(count($filter['filter_values'])>0)
                <div class="filter-sub-area">
                    <h5 class="filter-sub-titel">{{ $filter['filter_name'] }}</h5>
                    <div class="categori-checkbox">
                        <form action="#">
                            <ul>
                                @foreach($filter['filter_values'] as $value)
                                <li><input class="{{$filter['filter_column']}}" id="{{ $value['filter_value']}} " type="checkbox" name="{{$filter['filter_column']}}[]" value="{{$value['filter_value']}}">  <label for="{{$value['filter_value']}}">&nbsp;&nbsp;&nbsp;{{ ucwords($value['filter_value']) }}</label></li>
                                @endforeach
                            </ul>
                        </form>
                    </div>
                </div>
            @endif
        @endif
    @endforeach
    <!-- filter-sub-area end -->
    <!-- filter-sub-area start -->
    <div class="filter-sub-area pt-sm-10 pt-xs-10">
        <h5 class="filter-sub-titel">Categories</h5>
        <div class="categori-checkbox">
            <form action="#">
                <ul>
                    <li><input type="checkbox" name="product-categori"><a href="#">Graphic Corner (10)</a></li>
                    <li><input type="checkbox" name="product-categori"><a href="#"> Studio Design (6)</a></li>
                </ul>
            </form>
        </div>
        </div>
    <!-- filter-sub-area end -->
    <!-- filter-sub-area start -->
    <div class="filter-sub-area pt-sm-10 pt-xs-10">
        <h5 class="filter-sub-titel">Size</h5>
        <div class="size-checkbox">
            <form action="#">
                <ul>
                    <li><input type="checkbox" name="product-size"><a href="#">S (3)</a></li>
                    <li><input type="checkbox" name="product-size"><a href="#">M (3)</a></li>
                    <li><input type="checkbox" name="product-size"><a href="#">L (3)</a></li>
                    <li><input type="checkbox" name="product-size"><a href="#">XL (3)</a></li>
                </ul>
            </form>
        </div>
    </div>
    <!-- filter-sub-area end -->
    <!-- filter-sub-area start -->
    <div class="filter-sub-area pt-sm-10 pt-xs-10">
        <h5 class="filter-sub-titel">Color</h5>
        <div class="color-categoriy">
            <form action="#">
                <ul>
                    <li><span class="white"></span><a href="#">White (1)</a></li>
                    <li><span class="black"></span><a href="#">Black (1)</a></li>
                    <li><span class="Orange"></span><a href="#">Orange (3) </a></li>
                    <li><span class="Blue"></span><a href="#">Blue  (2) </a></li>
                </ul>
            </form>
        </div>
    </div>
    <!-- filter-sub-area end -->
    <!-- filter-sub-area start -->
    <div class="filter-sub-area pt-sm-10 pb-sm-15 pb-xs-15">
        <h5 class="filter-sub-titel">Dimension</h5>
        <div class="categori-checkbox">
            <form action="#">
                <ul>
                    <li><input type="checkbox" name="product-categori"><a href="#">40x60cm (6)</a></li>
                    <li><input type="checkbox" name="product-categori"><a href="#">60x90cm (6)</a></li>
                    <li><input type="checkbox" name="product-categori"><a href="#">80x120cm (6)</a></li>
                </ul>
            </form>
        </div>
        </div>
    <!-- filter-sub-area end -->
</div>
<!--sidebar-categores-box end  -->
<!-- category-sub-menu start -->
<div class="sidebar-categores-box mb-sm-0">
    <div class="sidebar-title">
        <h2>Laptop</h2>
    </div>
    <div class="category-tags">
        <ul>
            <li><a href="# ">Devita</a></li>
            <li><a href="# ">Cameras</a></li>
            <li><a href="# ">Sony</a></li>
            <li><a href="# ">Computer</a></li>
            <li><a href="# ">Big Sale</a></li>
            <li><a href="# ">Accessories</a></li>
        </ul>
    </div>
    <!-- category-sub-menu end -->
</div>