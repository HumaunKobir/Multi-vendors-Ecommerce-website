<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Section;
use App\Models\Brand;
use App\Models\Category;
use Auth;
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
            $product = new Product;
            $message = "Product Added Successfully!";
        }else{
            $title = "Edit Product";
        }
        if($request->isMethod('post')){
            $data = $request->all();
            //echo "<pre>"; print_r($data); die;
            //Data Validation
            $rules = ([
                'brand_id'=>'required',
                'product_name'=> 'required|regex:/^[\pL\s\-]+$/u',
                'category_id' =>'required',
                'product_code' =>'required|regex:/^\w+$/',
                'product_price' => 'required|numeric',
                'product_color'=> 'required|regex:/^[\pL\s\-]+$/u',
            ]);
            $this->validate($request,$rules);

            //Save All Data of Product
            $categoryDetails = Category::find($data['category_id']);
            if(!empty($categoryDetails)){
                $product->section_id = $categoryDetails['section_id'];
            }else{
                $product->section_id = 0;
            }
            //dd($product);
            $product->category_id = $data['category_id'];

            $adminType = Auth::guard('admin')->user()->type;
            $vendor_id = Auth::guard('admin')->user()->vendor_id;
            $admin_id = Auth::guard('admin')->user()->id;

            $product->admin_type = $adminType;
            $product->admin_id = $admin_id;
            if($adminType=="vendor"){
                $product->vendor_id = $vendor_id;
            }else{
                $product->vendor_id = 0;
            }
             //Upload Category Picture
             if($request->hasFile('product_image')){
                $image_tmp = $request->file('product_image');
                if($image_tmp->isValid()){
                    //Get Image Extension
                    $extension = $image_tmp->getClientOriginalExtension();
                    //Generate New Image Name
                    $image_name = time().'-'.$request->product_name .'.'.$extension;
                    $request->product_image->move(public_path('front/images/product_image'),$image_name);
                    $product->product_image = $image_name;    
                }
            }else{
                $product->product_image = "";
            }
            $product->brand_id = $data['brand_id'];
            $product->product_name = $data['product_name'];
            $product->product_code = $data['product_code'];
            $product->product_color = $data['product_color'];
            $product->product_price = $data['product_price'];
            $product->product_discount = isset($data['product_discount']) ? $data['product_discount'] : "-";
            $product->product_weight = isset($data['product_weight']) ? $data['product_weight'] : "-";
            $product->product_description = isset($data['product_description']) ? $data['product_description'] : "-";
            $product->meta_title = isset($data['meta_title']) ? $data['meta_title'] : "-";
            $product->meta_description = isset($data['meta_description']) ? $data['meta_description'] : "-";
            $product->meta_keywords = isset($data['meta_keywords']) ? $data['meta_keywords'] : "-";
            if(!empty($data['is_featured'])){
                $product->is_featured = $data['is_featured'];
            }else{
                $product->is_featured = "No";
            }
            $product->status = 1;
            $product->save();
            return redirect('admin/products')->with('success_message',$message);
        }
        //Get Section with category subcategory
        $categories=Section::with('categories')->get()->toArray();
        // dd($categories);
        //Get All Brands
        $brands = Brand::where('status',1)->get()->toArray();
        return view('admin.products.add_edit_product')->with(compact('title','categories','brands'));
    }
}
