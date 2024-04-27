@extends('admin.layout.layout')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">Catalouge Management</h3>
                        <h6 class="font-weight-normal mb-0">Attributes</h6>
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
          <div class="col-xl-1"></div>
          <div class="col-xl-10">
          <div class="grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Add Attributes</h4>
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
                  <form class="forms-sample" action="{{ url('admin/add-edit-attributes/'.$product['id']) }}"  method="post" enctype="multipart/form-data">@csrf
                    <div class="form-group">
                      <label for="product_name">Product Name :</label>
                      &nbsp; {{ $product['product_name'] }}
                    </div>
                    <div class="form-group">
                      <label for="product_code">Product Code :</label>
                      &nbsp; {{ $product['product_code'] }}
                    </div>
                    <div class="form-group">
                      <label for="product_color">Product Color :</label>
                      &nbsp; {{ $product['product_color'] }}
                    </div>
                    <div class="form-group">
                      <label for="product_price">Product Price :</label>
                      &nbsp; {{ $product['product_price'] }}
                    </div>
                    <div class="form-group">
                      <label for="product_image">Product Image</label>
                    @if(!empty($product['product_image']))
                      <img style="width:120px;" src="{{ url('front/images/product_image/'.$product['product_image']) }}">
                      @else
                      <img style="width:120px;" src="{{ url('front/images/product_image/no_image.png') }}">
                    @endif
                    </div>
                    <div class="form-group">
                      <div class="field_wrapper">
                          <div>
                              <input type="text" name="size[]" placeholder="Size" value="" required=""/>
                              <input type="text" name="sku[]" placeholder="SKU" value="" required=""/>
                              <input type="text" name="price[]" placeholder="Price" value="" required=""/>
                              <input type="text" name="stock[]" placeholder="Stock" value="" required=""/>
                              <a href="javascript:void(0);" class="add_button" title="Add field">
                              <i style="font-size:25px;" class="mdi mdi-plus-box"></i></a>
                          </div>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <button class="btn btn-light">Cancel</button>
                  </form>

                  <form action="{{  url('admin/edit-attribute/'.$product['id']) }}" method="post">@csrf
                   <table id="section" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Size</th>
                          <th>SKU</th>
                          <th>Price</th>
                          <th>Stock</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($product['attributes'] as $attribute)
                        <input style="display:none;" type="text" name="attributeId[]" value="{{$attribute['id']}}">
                            <tr>
                                <td>{{$attribute['id']}}</td>
                                <td>{{$attribute['size']}}</td>
                                <td>{{$attribute['sku']}}</td>
                                <td>
                                <input style="width:70px;" type="number" name="price[]" value="{{$attribute['price']}}" required="">
                                </td>
                                <td>
                                <input style="width:70px;" type="number" name="stock[]" value="{{$attribute['stock']}}" required="">
                                </td>
                                <td>
                                    @if($attribute['status']==1)
                                     <a class="updateAttributeStatus" id="attribute-{{$attribute['id']}}" attribute_id="{{ $attribute['id']}}" href="javascript:void(0)"><i style="font-size:25px;" class="mdi mdi-bookmark-check"status="Active"></i></a> 
                                    @else 
                                     <a class="updateAttributeStatus" id="attribute-{{$attribute['id']}}" attribute_id="{{ $attribute['id']}}" href="javascript:void(0)"><i style="font-size:25px;" class="mdi mdi-bookmark-outline" status="Inactive"></i></a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                      </tbody>
                    </table>
                      <button class="btn btn-primary" type="submit">Update Attribute</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-1"></div>
        </div>
        
    </div>
    <!-- content-wrapper ends -->
    <!-- partial:partials/_footer.html -->
    @include('admin.layout.footer')
    <!-- partial -->
</div>
@endsection