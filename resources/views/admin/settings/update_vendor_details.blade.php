@extends('admin.layout.layout')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">Update Vendor Details</h3>
                        
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
        @if($slug=="personal")
        <div class="row">
          <div class="col-xl-3"></div>
          <div class="col-xl-6">
          <div class="grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Update Personal Information</h4>
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
                  <form class="forms-sample" action="{{ url('admin/update-vendor-details/personal') }}" method="post" enctype="multipart/form-data">@csrf
                    <div class="form-group">
                      <label>Vendor Email/Username</label>
                      <input  class="form-control" value="{{ Auth::guard('admin')->user()->email }}"readonly="">
                    </div>
                    <div class="form-group">
                      <label for="vendor_name">Name</label>
                      <input type="text" class="form-control" id="vendor_name" placeholder="Admin Name" name="vendor_name" required="" value="{{ Auth::guard('admin')->user()->name }}">
                    </div>
                    <div class="form-group">
                      <label for="vendor_address">Address</label>
                      <input type="text" class="form-control" id="vendor_address" name="vendor_address" required="" value="{{ $vendorDetails['address'] }}">
                    </div>
                    <div class="form-group">
                      <label for="vendor_city">City</label>
                      <input type="text" class="form-control" id="vendor_city" name="vendor_city" required="" value="{{ $vendorDetails['city'] }}">
                    </div>
                    <div class="form-group">
                      <label for="vendor_state">State</label>
                      <input type="text" class="form-control" id="vendor_state" name="vendor_state" required="" value="{{ $vendorDetails['state'] }}">
                    </div>
                    <div class="form-group">
                      <label for="vendor_country">Country</label>
                      <!-- <input type="text" class="form-control" id="vendor_country" name="vendor_country" required="" value="{{ $vendorDetails['country']}}"> -->
                      <select class="form-control" name="vendor_country" id="vendor_country" style="color:#495057;">
                        <option value="">Select Country</option>
                        @foreach($countries as $country)
                        <option value="{{ $country['country_name']}}" @if($country['country_name']== $vendorDetails['country']) selected @endif>{{ $country['country_name']}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="vendor_mobile">Mobile Number</label>
                      <input type="mobile" class="form-control" id="vendor_mobile" placeholder=" Mobile Number" name="vendor_mobile" required="" value="{{ $vendorDetails['mobile'] }}">
                    </div>
                    <div class="form-group">
                      <label for="vendor_pincode">Pincode</label>
                      <input type="text" class="form-control" id="vendor_pincode" name="vendor_pincode" required="" value="{{ $vendorDetails['pincode'] }}">
                    </div>
                   
                    <div class="form-group">
                      <label for="vendor_image">Upload Picture</label>
                      <input type="file" class="form-control" id="vendor_image" name="vendor_image">
                      @if(!empty(Auth::guard('admin')->user()->image))
                        <input type="hidden" name="current_vendor_image" value="{{ Auth::guard('admin')->user()->image }}">
                      @endif
                    </div>
                   
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <button class="btn btn-light">Cancel</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-3"></div>
        </div>
        @elseif($slug=="business")
        <div class="row">
          <div class="col-xl-3"></div>
          <div class="col-xl-6">
          <div class="grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Update Business Information</h4>
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
                  <form class="forms-sample" action="{{ url('admin/update-vendor-details/business') }}" method="post" enctype="multipart/form-data">@csrf
                    <div class="form-group">
                      <label>Vendor Email/Username</label>
                      <input  class="form-control" value="{{ Auth::guard('admin')->user()->email }}"readonly="">
                    </div>
                    <div class="form-group">
                      <label for="shop_name">Shop Name</label>
                      <input type="text" class="form-control" id="shop_name" placeholder="Admin Name" name="shop_name" required="" value="{{ $vendorDetails['shop_name'] }}">
                    </div>
                    <div class="form-group">
                      <label for="shop_address">Shop Address</label>
                      <input type="text" class="form-control" id="shop_address" name="shop_address" required="" value="{{ $vendorDetails['shop_address'] }}">
                    </div>
                    <div class="form-group">
                      <label for="shop_city">Shop City</label>
                      <input type="text" class="form-control" id="shop_city" name="shop_city" required="" value="{{ $vendorDetails['shop_city'] }}">
                    </div>
                    <div class="form-group">
                      <label for="shop_state">Shop State</label>
                      <input type="text" class="form-control" id="shop_state" name="shop_state" required="" value="{{ $vendorDetails['shop_state'] }}">
                    </div>
                    <div class="form-group">
                      <label for="shop_country">Shop Country</label>
                      <!-- <input type="text" class="form-control" id="shop_country" name="shop_country" required="" value="{{ $vendorDetails['shop_country']}}"> -->
                      <select class="form-control" name="shop_country" id="shop_country" style="color:#495057;">
                        <option value="">Select Country</option>
                        @foreach($countries as $country)
                        <option value="{{ $country['country_name']}}" @if($country['country_name']== $vendorDetails['shop_country']) selected @endif>{{ $country['country_name']}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="shop_pincode">Shop Pincode</label>
                      <input type="text" class="form-control" id="shop_pincode" name="shop_pincode" required="" value="{{ $vendorDetails['shop_pincode'] }}">
                    </div>
                     <div class="form-group">
                      <label for="shop_mobile">Shop Mobile Number</label>
                      <input type="mobile" class="form-control" id="shop_mobile" placeholder=" Mobile Number" name="shop_mobile" required="" value="{{ $vendorDetails['shop_mobile'] }}">
                    </div>
                    <div class="form-group">
                      <label for="shop_website">Shop Website</label>
                      <input type="text" class="form-control" id="shop_website" name="shop_website" required="" value="{{ $vendorDetails['shop_website'] }}">
                    </div>
                    
                    <div class="form-group">
                      <label for="address_proof">Shop Address Proof</label>
                      <select class="form-control" name="address_proof" id="address_proof">
                        <option value="Passport" @if($vendorDetails['address_proof']=="Passport") selected @endif>Passport</option>
                        <option value="NIDcard"@if($vendorDetails['address_proof']=="NIDcard") selected @endif>NIDcard</option>
                        <option value="DrivignLicense"@if($vendorDetails['address_proof']=="DrivingLicense") selected @endif>DrivingLicense</option>
                        <option value="PAN"@if($vendorDetails['address_proof']=="PAN") selected @endif>PAN</option>
                      </select>
                    </div>
                   
                    <div class="form-group">
                      <label for="address_proof_image">Address Proof Image</label>
                      <input type="file" class="form-control" id="address_proof_image" name="address_proof_image">
                      @if(!empty(Auth::guard('admin')->user()->image))
                        <input type="hidden" name="current_shop_image" value="{{ Auth::guard('admin')->user()->image }}">
                      @endif
                    </div>
                    <div class="form-group">
                      <label for="bussines_license_number">Business License Number</label>
                      <input type="text" class="form-control" id="bussines_license_number" name="bussines_license_number" required="" value="{{ $vendorDetails['bussines_license_number'] }}">
                    </div>
                   
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <button class="btn btn-light">Cancel</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-3"></div>
        </div>
        @elseif($slug=="bank")
        <div class="row">
          <div class="col-xl-3"></div>
          <div class="col-xl-6">
          <div class="grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Update Bank Information</h4>
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
                  <form class="forms-sample" action="{{ url('admin/update-vendor-details/bank') }}" method="post" enctype="multipart/form-data">@csrf
                    <div class="form-group">
                      <label>Vendor Email/Username</label>
                      <input  class="form-control" value="{{ Auth::guard('admin')->user()->email }}"readonly="">
                    </div>
                    <div class="form-group">
                      <label for="account_holder_name">Account Holder Name</label>
                      <input type="text" class="form-control" id="account_holder_name" placeholder="Admin Name" name="account_holder_name" required="" value="{{ $vendorDetails['account_holder_name'] }}">
                    </div>
                    <div class="form-group">
                      <label for="bank_name">Bank Name</label>
                      <input type="text" class="form-control" id="bank_name" name="bank_name" required="" value="{{ $vendorDetails['bank_name'] }}">
                    </div>
                    <div class="form-group">
                      <label for="account_number">Bank Account Number</label>
                      <input type="text" class="form-control" id="account_number" name="account_number" required="" value="{{ $vendorDetails['account_number'] }}">
                    </div>
                    <div class="form-group">
                      <label for="bank_ifsc_code">Bank IFSC Code</label>
                      <input type="text" class="form-control" id="bank_ifsc_code" name="bank_ifsc_code" required="" value="{{ $vendorDetails['bank_ifsc_code'] }}">
                    </div>
                    
                   
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <button class="btn btn-light">Cancel</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-3"></div>
        </div>
        @endif
    </div>
    <!-- content-wrapper ends -->
    <!-- partial:partials/_footer.html -->
    @include('admin.layout.footer')
    <!-- partial -->
</div>
@endsection