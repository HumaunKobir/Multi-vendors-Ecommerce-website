<?php use App\Models\ProductsFilter; ?>
@extends('admin.layout.layout')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
       
        <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Filter Values</h4>
                  <a style="max-width:150px;float:left;disply:inline-block;" class="btn btn-block btn-primary" href="{{ url('admin/filters') }}">View Filters</a>
                  <a style="max-width:150px;float:right;disply:inline-block;" class="btn btn-block btn-primary" href="{{ url('admin/add-edit-filter-value') }}">Add Filter Value</a>
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
                          <th>Filter ID</th>
                          <th>Filter Name</th>
                          <th>Filter Values</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($filters_values as $filter_value)
                        <tr>
                          <td>{{$filter_value['id']}}</td>
                          <td>{{$filter_value['filter_id']}}</td>
                          <td>
                            <?php
                            echo $getFilterName = ProductsFilter::getFilterName($filter_value['filter_id']);
                            ?>
                          </td>
                          <td>{{$filter_value['filter_value']}}</td>
                          <td>
                            @if($filter_value['status']==1)
                           <a class="updateFiltersValueStatus" id="filter_value-{{$filter_value['id']}}" filter_value_id="{{ $filter_value['id']}}" href="javascript:void(0)"><i style="font-size:25px;" class="mdi mdi-bookmark-check"status="Active"></i></a> 
                            @else 
                            <a class="updateFiltersValueStatus" id="filter_value-{{$filter_value['id']}}" filter_value_id="{{ $filter_value['id']}}" href="javascript:void(0)"><i style="font-size:25px;" class="mdi mdi-bookmark-outline" status="Inactive"></i></a>
                            @endif
                          </td>
                          <td>
                            <a href="{{url('admin/add-edit-filter-value/'.$filter_value['id'])}}">
                            <i style="font-size:25px;" class="mdi mdi-pencil-box"></i></a>
                            <a href="javascript:void(0)" class="confirmDelete" module="filter_value" moduleid="{{ $filter_value['id']}}">
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