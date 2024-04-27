<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductsFilter;
use App\Models\ProductsFiltersValue;
use App\Models\Section;
use Session;
use DB;

class FilterController extends Controller
{
    //Filters
    public function filters(){
        Session::put('page','filters');
        $filters = ProductsFilter::get()->toArray();
        //dd($filters);
        return view('admin.filters.filters')->with(compact('filters'));
    }
    //Update Filter Status
    public function updateFilterStatus(Request $request){
        if($request->ajax()){
            $data = $request->all();
            if($data['status']=="Active"){
                $status = 0;
            }else{
                $status = 1;
            }
            ProductsFilter::where('id',$data['filter_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status,'filter_id'=>$data['filter_id']]);
        }
    }
    public function deleteFilter($id) {
        ProductsFilter::where('id',$id)->delete();
        $massege = "Filter Deleted Successfully!";
        return redirect()->back()->with('success_message',$massege);
    }
    //Add Edit Filters
    public function addEditFilter(Request $request,$id=null) {
        Session::put('page','filters');
        if($id==""){
            $title = "Add Filter";
            $filter = new ProductsFilter;
            $message = "Filter Added Successfully!";
        }else{
            $title = "Edit Filter";
            $filter = ProductsFilter::find($id);
            $message = "Filter Updated Successfully!";
        }
        if($request->isMethod('post')){
            $data = $request->all();
            $cat_ids = implode(',',$data['cat_ids']);
            $rules = ([
                'filter_name'=> 'required|regex:/^[\pL\s\-]+$/u',
                'filter_column'=>'required',
            ]);
            $this->validate($request,$rules);
            $filter->filter_name = $data['filter_name'];
            $filter->filter_column = $data['filter_column'];
            $filter->cat_ids = $cat_ids;
            $filter->status = 1;
            $filter->save();
            //Alter Filter in Product table
            DB::statement('ALTER TABLE products ADD ' . $data['filter_column'] . ' VARCHAR(255) AFTER product_description');
            return redirect('admin/filters')->with('success_message',$message);
        }
        //Get Section with category subcategory
        $categories=Section::with('categories')->get()->toArray();
        return view('admin.filters.add_edit_filter')->with(compact('title','filter','categories'));
    }
    
    //Filter Values
    public function filtersValues(){
        Session::put('page','filters');
        $filters_values = ProductsFiltersValue::get()->toArray();
        //dd($filters);
        return view('admin.filters.filters_values')->with(compact('filters_values'));
    }
    //Update Filter Status
    public function updateFiltersValueStatus(Request $request){
        if($request->ajax()){
            $data = $request->all();
            if($data['status']=="Active"){
                $status = 0;
            }else{
                $status = 1;
            }
            ProductsFiltersValue::where('id',$data['filter_value_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status,'filter_value_id'=>$data['filter_value_id']]);
        }
    }
    public function deleteFilterValue($id) {
        ProductsFiltersValue::where('id',$id)->delete();
        $massege = "Filter Value Deleted Successfully!";
        return redirect()->back()->with('success_message',$massege);
    }
    //Add Edit Filters Value
    public function addEditFilterValue(Request $request,$id=null) {
        Session::put('page','filters');
        if($id==""){
            $title = "Add Filter Value";
            $filter_value = new ProductsFiltersValue;
            $message = "Filter Value Added Successfully!";
        }else{
            $title = "Edit Filter Value";
            $filter_value = ProductsFiltersValue::find($id);
            $message = "Filter Value Updated Successfully!";
        }
        if($request->isMethod('post')){
            $data = $request->all();
            $rules = ([
                'filter_value'=> 'required',
            ]);
            $this->validate($request,$rules);
            $filter_value->filter_id = $data['filter_id'];
            $filter_value->filter_value = $data['filter_value'];
            $filter_value->status = 1;
            $filter_value->save();
            return redirect('admin/filters-values')->with('success_message',$message);
        }
        $filters = ProductsFilter::where('status',1)->get()->toArray();
        return view('admin.filters.add_edit_filter_value')->with(compact('title','filter_value','filters'));
    }
    //Category Filters
    public function categoryFilters(Request $request){
        if($request->ajax()){
            $data = $request->all();
            $category_id = $data['category_id'];
            return response()->json([
                'view'=>(string)View::make('admin.filters.category_filters')->with(compact('category_id'))
            ]);
        }
    }
}
