@extends('front.layouts.layout')
@section('content')
 <!-- Begin Li's Breadcrumb Area -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="breadcrumb-content">
                <ul>
                    <li><a href="index.html">Home</a></li>
                    <li class="active">Login Register</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Li's Breadcrumb Area End Here -->
    <!-- Begin Login Content Area -->
    <div class="page-section mb-60">
        <div class="container">
            <div class="row">
            <div class="col-sm-12 col-md-12 col-xs-12 col-lg-12 mb-30">
            @if(Session::has('error_message'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Error::</strong> {{Session::get('error_message')}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                    @if(Session::has('success_message'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success::</strong> {{Session::get('success_message')}}
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
            </div>
                <div class="col-sm-12 col-md-12 col-xs-12 col-lg-6 mb-30">
                    <!-- Login Form s-->
                    <form id="accountForm" action="javascript:;" method="post">@csrf
                        <div class="login-form">
                            <h4 class="login-title">Contact Details</h4>
                            <p id="account-error"></p>
                            <p id="account-success"></p>
                            <div class="row">
                                <div class="col-md-12 col-12 mb-20">
                                    <label for="email">Email Address*</label>
                                    <input id="user-email" class="mb-0" type="email" name="email" value="{{Auth::user()->email}}" readonly="" style="background-color:#e9e9e9;">
                                    <p id="account-email"></p>
                                </div>
                                <div class="col-md-12 col-12 mb-20">
                                    <label for="user-name">User Name</label>
                                    <input id="user-name" class="mb-0" type="text" name="name" value="{{Auth::user()->name}}">
                                    <p id="account-user-name"></p>
                                </div>
                                <div class="col-md-12 col-12 mb-20">
                                    <label for="user-address">User Address</label>
                                    <input id="user-address" class="mb-0" type="text" name="address" value="{{Auth::user()->address}}">
                                    <p id="account-user-address"></p>
                                </div>
                                <div class="col-md-12 col-12 mb-20">
                                    <label for="user-city">User City</label>
                                    <input id="user-city" class="mb-0" type="text" name="city" value="{{Auth::user()->city}}">
                                    <p id="account-user-city"></p>
                                </div>
                                <div class="col-md-12 col-12 mb-20">
                                    <label for="user-state">User State</label>
                                    <input id="user-state" class="mb-0" type="text" name="state" value="{{Auth::user()->state}}">
                                    <p id="account-user-state"></p>
                                </div>
                                <div class="col-md-12 col-12 mb-20">
                                    <label for="user-country">User Country</label>
                                    <select class="form-control" name="country" id="user-country" style="color:#495057;">
                                        <option value="">Select Country</option>
                                        @foreach($countries as $country)
                                        <option value="{{ $country['country_name']}}" @if(isset(Auth::user()->country) && $country['country_name'] == Auth::user()->country) selected @endif>{{ $country['country_name']}}</option>
                                        @endforeach
                                    </select>
                                    <p id="account-user-country"></p>
                                </div>
                                <div class="col-md-12 col-12 mb-20">
                                    <label for="user-pincode">User Pincode</label>
                                    <input id="user-pincode" class="mb-0" type="text" name="pincode" value="{{Auth::user()->pincode}}">
                                    <p id="account-user-pincode"></p>
                                </div>
                                <div class="col-md-12 col-12 mb-20">
                                    <label for="user-mobile">User Mobile</label>
                                    <input id="user-mobile" class="mb-0" type="text" name="mobile" value="{{Auth::user()->mobile}}">
                                    <p id="account-user-mobile"></p>
                                </div>
                                <div class="col-md-12">
                                    <button class="register-button mt-0">Update Details</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-6 col-xs-12">
                    <form id="passwordForm" action="javascript:;" method="post">@csrf
                        <div class="login-form">
                            <h4 class="login-title">Update Password</h4>
                            <p id="password-error"></p>
                            <p id="password-success"></p>
                            <div class="row">
                                <div class="col-md-12 col-12 mb-20">
                                    <label for="current-password">Current Password <span class="astk">*</span></label>
                                    <input id="current-password" class="mb-0" type="password" name="current_password">
                                    <p id="password-current_password"></p>
                                </div>
                                <div class="col-md-12 col-12 mb-20">
                                    <label for="new-password">New Password <span class="astk">*</span></label>
                                    <input id="new-password" class="mb-0" type="password" name="new_password">
                                    <p id="password-new_password"></p>
                                </div>
                                <div class="col-md-12 mb-20">
                                    <label for="confirm-password">Confirm Password <span class="astk">*</span></label>
                                    <input id="confirm-password" class="mb-0" type="password" name="confirm_password">
                                    <p id="password-confirm_password"></p>
                                </div>
                                <div class="col-12">
                                    <button class="register-button mt-0">Update</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Login Content Area End Here -->
@endsection