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
                    <form id="forgotForm" action="javascript:;" method="POST">@csrf
                        <div class="login-form">
                            <h4 class="login-title">Forgot Password</h4>
                            <p id="forgot-error"></p>
                            <p id="forgot-success"></p>
                            <div class="row">
                                <div class="col-md-12 col-12 mb-20">
                                    <label for="email">Email Address*</label>
                                    <input id="users-email" class="mb-0" type="email" name="email" placeholder="Email Address">
                                    <p id="forgot-email"></p>
                                </div>
                                <div class="col-md-8">
                                    <div class="check-box d-inline-block ml-0 ml-md-2 mt-10">
                                        
                                    </div>
                                </div>
                                <div class="col-md-4 mt-10 mb-20 text-left text-md-right">
                                    <a href="{{ url('user/login-register') }}"> Back to Login?</a>
                                </div>
                                <div class="col-md-12">
                                    <button class="register-button mt-0">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-6 col-xs-12">
                    
                    <form id="registerForm" action="javascript:;" method="post">@csrf
                        <div class="login-form">
                            <h4 class="login-title">Register</h4>
                            <p id="register-success"></p>
                            <div class="row">
                                <div class="col-md-6 col-12 mb-20">
                                    <label for="user-name">User Name <span class="astk">*</span></label>
                                    <input id="user-name" class="mb-0" type="text" name="name" placeholder="Uaer Name">
                                    <p id="register-name"></p>
                                </div>
                                <div class="col-md-6 col-12 mb-20">
                                    <label for="user-mobile">Phone Number<span class="astk">*</span></label>
                                    <input id="user-mobile" class="mb-0" type="text" name="mobile" placeholder="Phone Number">
                                    <p id="register-mobile"></p>
                                </div>
                                <div class="col-md-12 mb-20">
                                    <label for="user-email">Email Address *</label>
                                    <input id="user-email" class="mb-0" type="email" name="email" placeholder="Email Address">
                                    <p id="register-email"></p>
                                </div>
                                <div class="col-md-12 mb-20">
                                    <label for="user-password">Password *</label>
                                    <input id="user-password" class="mb-0" type="password" name="password" placeholder="Password">
                                    <p id="register-password"></p>
                                </div>
                                <div class="col-12">
                                    <button class="register-button mt-0">Register</button>
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