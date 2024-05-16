@extends('admin.layout.layout')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
       
        <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">{{$title}}</h4>
                  <p class="card-description">
                  </p>
                  <div class="table-responsive pt-3">
                  <table id="section" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Admin ID</th>
                          <th>Name</th>
                          <th>Type</th>
                          <th>Mobile</th>
                          <th>E-mail</th>
                          <th>Image</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($admins as $admin)
                        <tr>
                          <td>{{$admin['id']}}</td>
                          <td>{{$admin['name']}}</td>
                          <td>{{$admin['type']}}</td>
                          <td>{{$admin['mobile']}}</td>
                          <td>{{$admin['email']}}</td>
                          <td>
                            @if($admin['image'] !="")
                            <img src="{{ asset('admin/images/photos/'.$admin['image']) }}">
                            @else
                            <img src="{{ asset('admin/images/photos/profile-dami.png') }}">
                            @endif
                          </td>
                          <td>
                            @if($admin['status']==1)
                              <a class="updateAdminStatus" id="admin-{{$admin['id']}}" admin_id="{{ $admin['id']}}" href="javascript:void(0)"><i style="font-size:25px;" class="mdi mdi-bookmark-check"status="Active"></i></a> 
                            @else 
                              <a class="updateAdminStatus" id="admin-{{$admin['id']}}" admin_id="{{ $admin['id']}}" href="javascript:void(0)"><i style="font-size:25px;" class="mdi mdi-bookmark-outline" status="Inactive"></i></a>
                            @endif
                          </td>
                          <td>
                            @if($admin['type']=="vendor")
                              <a href="{{url('admin/view-vendor-details/'.$admin['id'])}}">
                              <i style="font-size:25px;" class="mdi mdi-file-document"></i></a>
                            @endif
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
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