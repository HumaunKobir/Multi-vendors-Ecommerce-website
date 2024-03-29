<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Session;

class ProductController extends Controller
{
    public function products(){
        Session::put('page','products');
        $products = Product::with(['section'=>function($query){
            $query->select('id','name');
        },'category'=>function($query){
            $query->select('id','category_name');
        }])->get()->toArray();
        return view('admin.products.products')->with(compact('products'));
    }
     //Update Product Status
     public function updateProductStatus(Request $request){
        if($request->ajax()){
            $data = $request->all();
            if($data['status']=="Active"){
                $status = 0;
            }else{
                $status = 1;
            }
            Product::where('id',$data['product_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status,'product_id'=>$data['product_id']]);
        }
    }
    //Delete Product
    public function deleteProduct($id){
        Product::where('id',$id)->delete();
        return redirect()->back()->with('success_message','Product Deleted Successfully!');
    }
    //Add Edit Products
    public function addEditProduct(Request $request,$id=null){
        Session::put('page','products');
        if($id==""){
            $title = "Add Product";
        }else{
            $title = "Edit Product";
        }
        return view('admin.products.add_edit_product')->with(compact('title'));
    }
}
