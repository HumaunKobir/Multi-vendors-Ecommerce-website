@extends('admin.layout.layout')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">Catalouge Management</h3>
                        <h6 class="font-weight-normal mb-0">Banners</h6>
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
                  <form class="forms-sample" @if(empty($banner['id'])) action="{{ url('admin/add-edit-banners')}}" @else action="{{ url('admin/add-edit-banners/'.$banner['id']) }}" @endif  method="post" enctype="multipart/form-data">@csrf 
                  <div class="form-group">
                      <label for="type">Select Banner Type</label>
                      <select class="form-control" name="type" id="type" required="">
                        <option value="">Select</option>
                        <option @if(!empty($banner['type']) && $banner['type']=="Slider") Selected="" @endif value="Slider">Slider</option>
                        <option @if(!empty($banner['type']) && $banner['type']=="Fix") Selected="" @endif  value="Fix">Fix</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="banner_image">Upload Picture</label>
                      <input type="file" class="form-control" id="banner_image" name="banner_image">
                    </div>
                    <div class="form-group">
                      <label for="link">Link</label>
                      <input type="text" class="form-control" id="link" placeholder="Enter Link" name="link" @if(!empty($banner['link'])) value="{{ $banner['link'] }}"@else value="{{ old('link')}}" @endif>
                    </div>
                    <div class="form-group">
                      <label for="title">Tittle</label>
                      <input type="text" class="form-control" id="title" placeholder="Enter title" name="title" @if(!empty($banner['title'])) value="{{ $banner['title'] }}"@else value="{{ old('title')}}" @endif>
                    </div>
                    <div class="form-group">
                      <label for="alt">Alt</label>
                      <input type="text" class="form-control" id="alt" placeholder="Enter Alt" name="alt" @if(!empty($banner['alt'])) value="{{ $banner['alt'] }}"@else value="{{ old('alt')}}" @endif required="">
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