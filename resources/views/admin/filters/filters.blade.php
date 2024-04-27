<?php use App\Models\Category; ?>
@extends('admin.layout.layout')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
       
        <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Product Filters</h4>
                  <a style="max-width:150px;float:left;disply:inline-block;" class="btn btn-block btn-primary" href="{{ url('admin/add-edit-filter') }}">Add Filter</a>
                  <a style="max-width:160px;float:right;disply:inline-block;" class="btn btn-block btn-primary" href="{{ url('admin/filters-values') }}">View Filter Value</a>
                  @if(Session::has('success_message'))
                  <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success::</strong> {{Session::get('success_message')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  @endif
                  <div class="table-responsive pt-3">
                    <table id="section" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Filter Name</th>
                          <th>Filter Column</th>
                          <th>Categories Name</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($filters as $filter)
                        <tr>
                          <td>{{$filter['id']}}</td>
                          <td>{{$filter['filter_name']}}</td>
                          <td>{{$filter['filter_column']}}</td>
                          <td>
                            <?php 
                              $cat_ids = explode(",", $filter['cat_ids']);
                              foreach($cat_ids as $key => $cat_id){
                                $category_name = Category::getCategoryName($cat_id);
                                echo $category_name. " , ";
                              }
                            ?>
                          </td>
                          <td>
                            @if($filter['status']==1)
                           <a class="updateFilterStatus" id="filter-{{$filter['id']}}" filter_id="{{ $filter['id']}}" href="javascript:void(0)"><i style="font-size:25px;" class="mdi mdi-bookmark-check"status="Active"></i></a> 
                            @else 
                            <a class="updateFilterStatus" id="filter-{{$filter['id']}}" filter_id="{{ $filter['id']}}" href="javascript:void(0)"><i style="font-size:25px;" class="mdi mdi-bookmark-outline" status="Inactive"></i></a>
                            @endif
                          </td>
                          <td>
                            <a href="{{url('admin/add-edit-filter/'.$filter['id'])}}">
                            <i style="font-size:25px;" class="mdi mdi-pencil-box"></i></a>
                            <a href="javascript:void(0)" class="confirmDelete" module="filter" moduleid="{{ $filter['id']}}">
                            <i style="font-size:25px;" class="mdi mdi-file-excel-box"></i></a>
                            
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