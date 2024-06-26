 <?php
    use App\Models\Section;
    $sections = Section::sections();
    //echo "<pre>"; print_r($sections); die;
    $totalCartItems = totalCartItems();
 ?>
 <!-- Begin Header Area -->
 <header>
    <!-- Begin Header Top Area -->
    <div class="header-top">
        <div class="container">
            <div class="row">
                <!-- Begin Header Top Left Area -->
                <div class="col-lg-3 col-md-4">
                    <div class="header-top-left">
                        <ul class="phone-wrap">
                            <li><span>Telephone Enquiry:</span><a href="#">(+880) 1971018613</a></li>
                        </ul>
                    </div>
                </div>
                <!-- Header Top Left Area End Here -->
                <!-- Begin Header Top Right Area -->
                <div class="col-lg-9 col-md-8">
                    <div class="header-top-right">
                        <ul class="ht-menu">
                            <!-- Begin Setting Area -->
                            <li>
                                <div class="ht-setting-trigger"><span>@if(Auth::check()) My Account @else Loing/Register @endif</span></div>
                                <div class="setting ht-setting">
                                    <ul class="ht-setting-list">
                                        <li><a href="{{ url('cart')}}">My Cart</a></li>
                                        @if(Auth::check())
                                        <li><a href="{{url('checkout')}}">Checkout</a></li>
                                        <li><a href="{{url('user/account') }}">My Account</a></li>
                                        <li><a href="{{url('user/orders') }}">My Orders</a></li>
                                        <li><a href="{{ url('user/logout') }}">Logout</a></li>
                                        @else
                                        <li><a href="{{url('user/login-register') }}">Customer Login</a></li>
                                        <li><a href="{{ url('vendor/login-register') }}">Vendor Login</a></li>
                                        <li><a href="{{ url('deliveryboy/login-register') }}">DeliveryBoy Login</a></li>
                                        @endif
                                    </ul>
                                </div>
                            </li>
                            <!-- Setting Area End Here -->
                            <!-- Begin Currency Area -->
                            <li>
                                <span class="currency-selector-wrapper">Currency :</span>
                                <div class="ht-currency-trigger"><span>USD $</span></div>
                                <div class="currency ht-currency">
                                    <ul class="ht-setting-list">
                                        <li><a href="#">BDT</a></li>
                                        <li class="active"><a href="#">USD $</a></li>
                                    </ul>
                                </div>
                            </li>
                            <!-- Currency Area End Here -->
                            <!-- Begin Language Area -->
                            <li>
                                <span class="language-selector-wrapper">Language :</span>
                                <div class="ht-language-trigger"><span>English</span></div>
                                <div class="language ht-language">
                                    <ul class="ht-setting-list">
                                        <li class="active"><a href="#"><img src="{{url('front/images/menu/flag-icon/1.jpg')}}" alt="">English</a></li>
                                        <li><a href="#"><img style="width:20px; height:auto;" src="{{url('front/images/menu/flag-icon/4.jpg')}}" alt="">Bangla</a></li>
                                    </ul>
                                </div>
                            </li>
                            <!-- Language Area End Here -->
                        </ul>
                    </div>
                </div>
                <!-- Header Top Right Area End Here -->
            </div>
        </div>
    </div>
    <!-- Header Top Area End Here -->
    <!-- Begin Header Middle Area -->
    <div class="header-middle pl-sm-0 pr-sm-0 pl-xs-0 pr-xs-0">
        <div class="container">
            <div class="row">
                <!-- Begin Header Logo Area -->
                <div class="col-lg-3">
                    <div class="logo pb-sm-30 pb-xs-30">
                        <a href="{{url('/')}}">
                           <h2>Multi Vendors Ecommerce Site</h2> 
                        </a>
                    </div>
                </div>
                <!-- Header Logo Area End Here -->
                <!-- Begin Header Middle Right Area -->
                <div class="col-lg-9 pl-0 ml-sm-15 ml-xs-15">
                    <!-- Begin Header Middle Searchbox Area -->
                    <form action="#" class="hm-searchbox">
                        <select class="nice-select select-search-category">
                            <option value="">All</option>
                            @foreach($sections as $section) 
                            @if(count($section['categories'])>0)                        
                            <option value="">{{ $section['name'] }}</option>
                            @endif
                            @endforeach
                        </select>
                        <input type="text" placeholder="Enter your search key ...">
                        <button class="li-btn" type="submit"><i class="fa fa-search"></i></button>
                    </form>
                    <!-- Header Middle Searchbox Area End Here -->
                    <!-- Begin Header Middle Right Area -->
                    <div class="header-middle-right">
                        <ul class="hm-menu">
                            <!-- Begin Header Middle Wishlist Area -->
                            <li class="hm-wishlist">
                                <a href="wishlist.html">
                                    <span class="cart-item-count wishlist-item-count">0</span>
                                    <i class="fa fa-heart-o"></i>
                                </a>
                            </li>
                            <!-- Header Middle Wishlist Area End Here -->
                            <!-- Begin Header Mini Cart Area -->
                            <li class="hm-minicart">
                                <div id="appendHeaderCartItems">
                                    @include('front.layouts.header_cart_items')
                                </div>
                            </li>
                            <!-- Header Mini Cart Area End Here -->
                        </ul>
                    </div>
                    <!-- Header Middle Right Area End Here -->
                </div>
                <!-- Header Middle Right Area End Here -->
            </div>
        </div>
    </div>
    <!-- Header Middle Area End Here -->
    <!-- Begin Header Bottom Area -->
    <div class="header-bottom header-sticky d-none d-lg-block d-xl-block">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Begin Header Bottom Menu Area -->
                    <div class="hb-menu">
                        <nav>
                            <ul>
                                @foreach($sections as $section)
                                @if(count($section['categories'])>0)
                                <li class="megamenu-static-holder"><a href="javascript:;">{{ $section['name'] }}</a>
                                    <ul class="megamenu hb-megamenu">
                                        @foreach($section['categories'] as $category)
                                        <li><a href="{{ url($category['url']) }}">{{ $category['category_name']}}</a>
                                            <ul>
                                                @foreach($category['subcategories'] as $subcategory)
                                                <li><a href="{{ url($subcategory['url']) }}">{{$subcategory['category_name']}}</a></li>
                                                @endforeach
                                            </ul>
                                        </li>
                                      @endforeach
                                    </ul>
                                </li>
                                @endif
                                @endforeach 
                            </ul>
                        </nav>
                    </div>
                    <!-- Header Bottom Menu Area End Here -->
                </div>
            </div>
        </div>
    </div>
    <!-- Header Bottom Area End Here -->
    <!-- Begin Mobile Menu Area -->
    <div class="mobile-menu-area d-lg-none d-xl-none col-12">
        <div class="container"> 
            <div class="row">
                <div class="mobile-menu">
                </div>
            </div>
        </div>
    </div>
    <!-- Mobile Menu Area End Here -->
</header>
<!-- Header Area End Here -->