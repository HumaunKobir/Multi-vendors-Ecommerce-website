@extends('admin.layout.layout')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">Vendor Details</h3>
                        <h6 class="font-weight-normal mb-0"><a style=text-decoration:none; href="{{ url('admin/admins/vendor')}}">Go Back to Vendor</a></h3>
                    </div>
                    <div class="col-12 col-xl-4">
                        <div class="justify-content-end d-flex">
                            <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                                <button class="btn btn-sm btn-light bg-white dropdown-toggle" type="button" id="dropdownMenuDate2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                <i class="mdi mdi-calendar"></i> Today (10 Jan 2021)
                                </button>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuDate2">
                                    <a class="dropdown-item" href="#">January - March</a>
                                    <a class="dropdown-item" href="#">March - June</a>
                                    <a class="dropdown-item" href="#">June - August</a>
                                    <a class="dropdown-item" href="#">August - November</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Personal Information</h4>
                        <div class="form-group">
                        <label>Vendor Email/Username</label>
                        <input  class="form-control" @if(isset($vendorDetails['vendor_personal']['email'])) value="{{ $vendorDetails['vendor_personal']['email'] }}" @endif readonly="">
                        </div>
                        <div class="form-group">
                        <label for="vendor_name">Name</label>
                        <input type="text" class="form-control" id="vendor_name" @if(isset($vendorDetails['vendor_personal']['name'])) value="{{ $vendorDetails['vendor_personal']['name'] }}" @endif readonly="">
                        </div>
                        <div class="form-group">
                        <label for="vendor_address">Address</label>
                        <input type="text" class="form-control" id="vendor_address" @if(isset($vendorDetails['vendor_personal']['address'])) value="{{ $vendorDetails['vendor_personal']['address'] }}" @endif readonly="">
                        </div>
                        <div class="form-group">
                        <label for="vendor_city">City</label>
                        <input type="text" class="form-control" id="vendor_city" @if(isset($vendorDetails['vendor_personal']['city'])) value="{{ $vendorDetails['vendor_personal']['city'] }}" @endif readonly="">
                        </div>
                        <div class="form-group">
                        <label for="vendor_state">State</label>
                        <input type="text" class="form-control" id="vendor_state" @if(isset($vendorDetails['vendor_personal']['state'])) value="{{ $vendorDetails['vendor_personal']['state'] }}" @endif readonly="">
                        </div>
                        <div class="form-group">
                        <label for="vendor_country">Country</label>
                        <input type="text" class="form-control" id="vendor_country" @if(isset($vendorDetails['vendor_personal']['country'])) value="{{ $vendorDetails['vendor_personal']['country'] }}" @endif readonly="">
                        </div>
                        <div class="form-group">
                        <label for="vendor_mobile">Mobile Number</label>
                        <input type="mobile" class="form-control" id="vendor_mobile" @if(isset($vendorDetails['vendor_personal']['mobile'])) value="{{ $vendorDetails['vendor_personal']['mobile'] }}" @endif readonly="">
                        </div>
                        <div class="form-group">
                        <label for="vendor_pincode">Pincode</label>
                        <input type="text" class="form-control" id="vendor_pincode" @if(isset($vendorDetails['vendor_personal']['pincode'])) value="{{ $vendorDetails['vendor_personal']['pincode'] }}" @endif readonly="">
                        </div>
                    
                        <div class="form-group">
                        <label for="vendor_pincode">Image</label><br>
                        @if(isset($vendorDetails['vendor_personal']['image']))
                            <img style = width:200px; src="{{ url('admin/images/photos/'.$vendorDetails['image'])}}" alt="">
                        @else
                            <p>No address proof image available</p>
                        @endif
                        </div>
                  </div>
                </div>
            </div>
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Business Information</h4>
                        <div class="form-group">
                        <label>Vendor Email/Username</label>
                        <input  class="form-control" @if(isset($vendorDetails['vendor_business']['shop_email'])) value="{{ $vendorDetails['vendor_business']['shop_email'] }}" @endif readonly="">
                        </div>
                        <div class="form-group">
                        <label for="shop_name">Shop Name</label>
                        <input type="text" class="form-control" id="shop_name" @if(isset($vendorDetails['vendor_business']['shop_name']))  value="{{ $vendorDetails['vendor_business']['shop_name'] }}" @endif readonly="">
                        </div>
                        <div class="form-group">
                        <label for="shop_address">Shop Address</label>
                        <input type="text" class="form-control" id="shop_address" @if(isset($vendorDetails['vendor_business']['shop_address'])) value="{{ $vendorDetails['vendor_business']['shop_address'] }}" @endif readonly="">
                        </div>
                        <div class="form-group">
                        <label for="shop_city">Shop City</label>
                        <input type="text" class="form-control" id="shop_city" @if(isset($vendorDetails['vendor_business']['shop_city'])) value="{{ $vendorDetails['vendor_business']['shop_city'] }}" @endif readonly="">
                        </div>
                        <div class="form-group">
                        <label for="shop_state">Shop State</label>
                        <input type="text" class="form-control" id="shop_state" @if(isset($vendorDetails['vendor_business']['shop_state'])) value="{{ $vendorDetails['vendor_business']['shop_state'] }}" @endif readonly="">
                        </div>
                        <div class="form-group">
                        <label for="shop_country">Shop Country</label>
                        <input type="text" class="form-control" id="shop_country" @if(isset($vendorDetails['vendor_business']['shop_country'])) value="{{ $vendorDetails['vendor_business']['shop_country']}}" @endif readonly="">
                        </div>
                        <div class="form-group">
                        <label for="shop_pincode">Shop Pincode</label>
                        <input type="text" class="form-control" id="shop_pincode" @if(isset($vendorDetails['vendor_business']['shop_pincode'])) value="{{ $vendorDetails['vendor_business']['shop_pincode'] }}" @endif readonly="">
                        </div>
                        <div class="form-group">
                        <label for="shop_mobile">Shop Mobile Number</label>
                        <input type="mobile" class="form-control" id="shop_mobile"@if(isset($vendorDetails['vendor_business']['shop_mobile'])) value="{{ $vendorDetails['vendor_business']['shop_mobile'] }}" @endif readonly="">
                        </div>
                        <div class="form-group">
                        <label for="shop_website">Shop Website</label>
                        <input type="text" class="form-control" id="shop_website"@if(isset($vendorDetails['vendor_business']['shop_website'])) value="{{ $vendorDetails['vendor_business']['shop_website'] }}" @endif readonly="">
                        </div>
                        
                        <div class="form-group">
                        <label for="address_proof">Business License Number</label>
                        <input type="text" class="form-control" id="address_proof"@if(isset($vendorDetails['vendor_business']['address_proof'])) value="{{ $vendorDetails['vendor_business']['address_proof'] }}" @endif readonly="">
                        </div>
                    
                        <div class="form-group">
                        <label for="address_proof_image">Address Proof Image</label><br>
                        @if(isset($vendorDetails['vendor_business']['address_proof_image']))
                            <img style="width:200px;" src="{{ url('admin/images/proofs/'.$vendorDetails['vendor_business']['address_proof_image']) }}">
                        @else
                            <p>No address proof image available</p>
                        @endif
                        </div>
                        <div class="form-group">
                        <label for="bussines_license_number">Business License Number</label>
                        <input type="text" class="form-control" id="bussines_license_number" @if(isset($vendorDetails['vendor_business']['bussines_license_number'])) value="{{ $vendorDetails['vendor_business']['bussines_license_number'] }}" @endif readonly="">
                        </div>
                    </div>
                </div>
            </div> 
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                   <div class="card-body">
                    <h4 class="card-title">Bank Information</h4>
                        <div class="form-group">
                            <label for="account_holder_name">Account Holder Name</label>
                            <input type="text" class="form-control" id="account_holder_name" @if(isset($vendorDetails['vendor_bank']['account_holder_name'])) value="{{ $vendorDetails['vendor_bank']['account_holder_name'] }}" @endif readonly="">
                        </div>
                        <div class="form-group">
                        <label for="bank_name">Bank Name</label>
                        <input type="text" class="form-control" id="bank_name" @if(isset($vendorDetails['vendor_bank']['bank_name'])) value="{{ $vendorDetails['vendor_bank']['bank_name'] }}" @endif readonly="">
                       </div>
                        <div class="form-group">
                        <label for="account_number">Bank Account Number</label>
                        <input type="text" class="form-control" id="account_number" @if(isset($vendorDetails['vendor_bank']['account_number'])) value="{{ $vendorDetails['vendor_bank']['account_number'] }}" @endif readonly="">
                        </div>
                        <div class="form-group">
                        <label for="bank_ifsc_code">Bank IFSC Code</label>
                        <input type="text" class="form-control" id="bank_ifsc_code" @if(isset($vendorDetails['vendor_bank']['bank_ifsc_code'])) value="{{ $vendorDetails['vendor_bank']['bank_ifsc_code'] }}" @endif readonly="">
                    </div>
                </div>
            </div>
            </div>
        </div>
    <!-- content-wrapper ends -->
    <!-- partial:partials/_footer.html -->
    @include('admin.layout.footer')
    <!-- partial -->
</div>
@endsection