@extends('admin.layout.layout')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">Catalouge Management</h3>
                        <h6 class="font-weight-normal mb-0">Products</h6>
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
          <div class="col-xl-3"></div>
          <div class="col-xl-6">
          <div class="grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">{{$title}}</h4>
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
                  <form class="forms-sample" @if(empty($product['id'])) action="{{ url('admin/add-edit-product')}}" @else action="{{ url('admin/add-edit-product/'.$product['id']) }}" @endif  method="post" enctype="multipart/form-data">@csrf
                  <div class="form-group">
                      <label for="category_id">Select Category</label>
                        <select name="category_id" id="category_id"class="form-control text-dark">
                            <option value="">Select Category</option>
                            @foreach($categories as $section)
                            <optgroup label="{{ $section['name']}}"></optgroup>
                              @foreach($section['categories'] as $category)
                              <option @if(!empty($product['category_id']== $category['id'])) selected="" @endif value="{{ $category['id']}}">&nbsp;&nbsp;&nbsp;&nbsp;--{{ $category['category_name']}}</option>
                                @foreach($category['subcategories'] as $subcategory)
                                <option  @if(!empty($product['category_id']== $subcategory['id'])) selected="" @endif value="{{ $subcategory['id']}}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--&nbsp;{{ $subcategory['category_name']}}&nbsp;--</option>
                                @endforeach
                              @endforeach
                            @endforeach
                        </select>
                    </div>
                    <div class="loadFilters">
                      @include('admin.filters.category_filters')
                    </div>
                    <div class="form-group">
                      <label for="brand_id">Select Brand</label>
                        <select name="brand_id" id="brand_id"class="form-control text-dark">
                            <option value="">Select Brand</option>
                            @foreach($brands as $brand)
                            <option @if(!empty($product['brand_id']== $brand['id'])) selected="" @endif value="{{ $brand['id']}}">{{ $brand['name']}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                      <label for="product_name">Product Name</label>
                      <input type="text" class="form-control" id="product_name" placeholder="Enter Product Name" name="product_name" @if(!empty($product['product_name'])) value="{{ $product['product_name'] }}"@else value="{{ old('product_name')}}" @endif required="">
                    </div>
                    <div class="form-group">
                      <label for="product_code">Product Code</label>
                      <input type="text" class="form-control" id="product_code" placeholder="Enter Product Code" name="product_code" @if(!empty($product['product_code'])) value="{{ $product['product_code'] }}"@else value="{{ old('product_code')}}" @endif required="">
                    </div>
                    <div class="form-group">
                      <label for="product_color">Product Color</label>
                      <input type="text" class="form-control" id="product_color" placeholder="Enter Product Color" name="product_color" @if(!empty($product['product_color'])) value="{{ $product['product_color'] }}"@else value="{{ old('product_color')}}" @endif required="">
                    </div>
                    <div class="form-group">
                      <label for="product_price">Product Price</label>
                      <input type="text" class="form-control" id="product_price" placeholder="Enter Product Price" name="product_price" @if(!empty($product['product_price'])) value="{{ $product['product_price'] }}"@else value="{{ old('product_price')}}" @endif required="">
                    </div>
                    <div class="form-group">
                      <label for="product_discount">Product Discount (%)</label>
                      <input type="text" class="form-control" id="product_discount" placeholder="Enter Product Discount (%)" name="product_discount" @if(!empty($product['product_discount'])) value="{{ $product['product_discount'] }}"@else value="{{ old('product_discount')}}" @endif>
                    </div>
                    <div class="form-group">
                      <label for="product_weight">Product Weight</label>
                      <input type="text" class="form-control" id="product_weight" placeholder="Enter Product Weight" name="product_weight" @if(!empty($product['product_weight'])) value="{{ $product['product_weight'] }}"@else value="{{ old('product_weight')}}" @endif>
                    </div>
                    <div class="form-group">
                      <label for="product_image">Upload Picture</label>
                      <input type="file" class="form-control" id="product_image" name="product_image" @if(!empty($product['product_image'])) value="{{ $product['product_image'] }}"@else value="{{ old('product_image')}}" @endif>
                      @if(!empty($product['product_image']))
                      <a target="_blank" href="{{ url('front/images/product_image/'.$product['product_image'])}}">View Image</a>&nbsp; |&nbsp;
                      <a href="javascript:void(0)" class="confirmDelete" module="product-image" moduleid="{{ $product['id']}}">Delete Image</a>
                      @endif
                    </div>
                    <div class="form-group">
                      <label for="product_video">Upload Video</label>
                      <input type="file" class="form-control" id="product_video" name="product_video" @if(!empty($product['product_video'])) value="{{ $product['product_video'] }}"@else value="{{ old('product_video')}}" @endif>
                    </div>
                    <div class="form-group">
                      <label for="product_description">Product Description</label>
                      <textarea rows="3" type="text" class="form-control" id="product_description" placeholder="Enter Product Description" name="product_description" @if(!empty($product['product_description'])) value="{{ $product['product_description'] }}"@else value="{{ old('product_description')}}" @endif>{{ $product['product_description'] }}</textarea>
                    </div>
                    <div class="form-group">
                      <label for="meta_title">Meta Title</label>
                      <input type="text" class="form-control" id="meta_title" placeholder="Enter Meta Title" name="meta_title" @if(!empty($product['meta_title'])) value="{{ $product['meta_title'] }}"@else value="{{ old('meta_title')}}" @endif>
                    </div>
                    <div class="form-group">
                      <label for="meta_description">Meta Description</label>
                      <input type="text" class="form-control" id="meta_description" placeholder="Enter Meta Description" name="meta_description" @if(!empty($product['meta_description'])) value="{{ $product['meta_description'] }}"@else value="{{ old('meta_description')}}" @endif>
                    </div>
                    <div class="form-group">
                      <label for="meta_keywords">Meta Keywords</label>
                      <input type="text" class="form-control" id="meta_keywords" placeholder="Enter Meta Keywords" name="meta_keywords" @if(!empty($product['meta_keywords'])) value="{{ $product['meta_keywords'] }}"@else value="{{ old('meta_keywords')}}" @endif>
                    </div>
                    <div class="form-group">
                      <label for="is_featured">Feture Item</label>
                      <input type="checkbox" id="is_featured" name="is_featured" value="Yes" @if(!empty($product['is_featured'])) && $product['is_featured']== "yes" checked="" @endif>
                    </div>
                    <div class="form-group">
                      <label for="is_bestseller">Best Seller Items</label>
                      <input type="checkbox" id="is_bestseller" name="is_bestseller" value="Yes" @if(!empty($product['is_bestseller'])) && $product['is_bestseller']== "yes" checked="" @endif>
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
        
    </div>
    <!-- content-wrapper ends -->
    <!-- partial:partials/_footer.html -->
    @include('admin.layout.footer')
    <!-- partial -->
</div>
@endsection