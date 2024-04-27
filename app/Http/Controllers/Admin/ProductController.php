<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductsAttribute;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Section;
use App\Models\Brand;
use App\Models\Category;
use App\Models\ProductsImage;
use App\Models\ProductsFilter;
use Auth;
use Session;
use Image;

class ProductController extends Controller
{
    public function products(){
        Session::put('page','products');
        $adminType = Auth::guard('admin')->user()->type;
        $vendor_id = Auth::guard('admin')->user()->vendor_id;
        if($adminType == "vendor"){
            $vendorStatus = Auth::guard('admin')->user()->status;
            if($vendorStatus== 0){
                return redirect('admin/update-vendor-details/personal')->with('error_message','Your vendor account is not approve yet. please make sure to fill your valid personal, business, and bank details.');
            }
        }
        $products = Product::with(['section'=>function($query){
            $query->select('id','name');
        },'category'=>function($query){
            $query->select('id','category_name');
        }]);
        if($adminType == "vendor"){
            $products = $products->where('vendor_id',$vendor_id);
        }
        $products = $products->get()->toArray();
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
        $product= Product::where('id',$id)->first();
        //Get Image path
        $imagePath = 'front/images/product_image/';
        if(file_exists($imagePath.$product->product_image)){
            unlink($imagePath.$product->product_image);
        }
        Product::where('id',$id)->delete();
        return redirect()->back()->with('success_message','Product Deleted Successfully!');
    }
    //Delete Image
    public function deleteProductImage($id){
        $product = Product::select('product_image')->where('id',$id)->first();
         //Get Image path
         $imagePath = 'front/images/product_image/';
         if(file_exists($imagePath.$product->product_image)){
             unlink($imagePath.$product->product_image);
         }
         Product::where('id',$id)->update(['product_image'=>'']);
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
            $product = Product::find($id);
            $message = "Product Updated Successfully!";
        }
        if($request->isMethod('post')){
            $data = $request->all();
            //echo "<pre>"; print_r($data); die;
            //Data Validation
            $rules = ([
                'brand_id'=>'required',
                'product_name'=> 'required',
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
             //Upload Product Picture
             if($request->hasFile('product_image')){
                $image_tmp = $request->file('product_image');
                if($image_tmp->isValid()){
                    //Get Image Extension
                    $extension = $image_tmp->getClientOriginalExtension();
                    //Generate New Image Name
                    $image_name = time().'-'.$request->product_name .'.'.$extension;
                    $request->product_image->move(public_path('front/images/product_image/'),$image_name);
                    $product->product_image = $image_name;    
                }
            }
             //Upload product Video
             if($request->hasFile('product_video')){
                $video_tmp = $request->file('product_video');
                if($video_tmp->isValid()){
                    //Get Video Extension
                    $extension = $video_tmp->getClientOriginalExtension();
                    //Generate New Video Name
                    $video_name = time().'-'.$request->product_name .'.'.$extension;
                    //Video Path
                    $videoPath = 'front/videos/product_video/';
                    $video_tmp->move($videoPath,$video_name);
                    $product->product_video = $video_name;
                }
            }else{
                $product->product_video = "";
            }
            //Save Products Filters
            $productFilters = ProductsFilter::productFilters();
            foreach($productFilters as $filter){
                $filterAvailable = ProductsFilter::filterAvailable($filter['id'],$data['category_id']);
                if($filterAvailable == "Yes"){
                    if(isset($filter['filter_column']) && $data[$filter['filter_column']]){
                        $product->{$filter['filter_column']} = $data[$filter['filter_column']];
                    }
                }
            }
            $product->brand_id = $data['brand_id'];
            $product->product_name = $data['product_name'];
            $product->product_code = $data['product_code'];
            $product->product_color = $data['product_color'];
            $product->product_price = $data['product_price'];
            $product->product_discount = isset($data['product_discount']) ? $data['product_discount'] : "0";
            $product->product_weight = isset($data['product_weight']) ? $data['product_weight'] : "0";
            $product->product_description = isset($data['product_description']) ? $data['product_description'] : "-";
            $product->meta_title = isset($data['meta_title']) ? $data['meta_title'] : "-";
            $product->meta_description = isset($data['meta_description']) ? $data['meta_description'] : "-";
            $product->meta_keywords = isset($data['meta_keywords']) ? $data['meta_keywords'] : "-";
            if(!empty($data['is_featured'])){
                $product->is_featured = $data['is_featured'];
            }else{
                $product->is_featured = "No";
            }
            if(!empty($data['is_bestseller'])){
                $product->is_bestseller = $data['is_bestseller'];
            }else{
                $product->is_bestseller = "No";
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
        return view('admin.products.add_edit_product')->with(compact('title','categories','brands','product'));
    }
    //Add Attributes
    public function addAttributes(Request $request,$id){
        Session::put('page','products');
        $product = Product::select('id','product_name','product_code','product_color','product_price','product_image')->with('attributes')->find($id);
        if($request->isMethod('post')){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            foreach($data['sku'] as $key => $value){
                if(!empty($value)){
                    //SKU Duplicate
                    $skuCount = ProductsAttribute::where('sku',$value)->count();
                    if($skuCount>0){
                        return redirect()->back()->with('error_message','SKU already exists!,Please add another SKU');
                    }
                      //Size Duplicate
                      $sizeCount = ProductsAttribute::where(['product_id'=>$id,'size'=>$data['size'][$key]])->count();
                      if($sizeCount>0){
                          return redirect()->back()->with('error_message','Size already exists!,Please add another Size');
                      }
                    $attribute = new ProductsAttribute;
                    $attribute->product_id = $id;
                    $attribute->sku = $value;
                    $attribute->size = $data['size'][$key];
                    $attribute->price = $data['price'][$key];
                    $attribute->stock = $data['stock'][$key];
                    $attribute->status =1;
                    $attribute->save();
                }
            }
            return redirect()->back()->with('success_message','Product Attributes Added Successfully!');
        }
        return view('admin.attributes.add_edit_attributes')->with(compact('product'));
    }
     //Update Attribute Status
     public function updateAttributeStatus(Request $request){
        if($request->ajax()){
            $data = $request->all();
            if($data['status']=="Active"){
                $status = 0;
            }else{
                $status = 1;
            }
            ProductsAttribute::where('id',$data['attribute_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status,'attribute_id'=>$data['attribute_id']]);
        }
    }
    //Edit Attribute
    public function editAttribute(Request $request){
       if($request->isMethod('post')){
            $data = $request->all();
            foreach($data['attributeId'] as $key => $attribute){
                if(!empty($attribute)){
                    ProductsAttribute::where(['id'=>$data['attributeId'][$key]])->update(['price'=>$data['price'][$key],'stock'=>$data['stock'][$key]]);
                }
            }
            return redirect()->back()->with('success_message','Attribute updated Successfully!');
       }
    }
    //Add Multiple Image
    public function addImages(Request $request,$id){
        Session::put('page','products');
        $product = Product::select('id','product_name','product_code','product_color','product_price','product_image')->with('images')->find($id);
        if($request->isMethod('post')){
            $data = $request->all();
            //Upload Product Picture
            if($request->hasFile('image')){
            //dd($images);
                foreach($request->file('image') as $key=>$image){
                    if($image->isValid()){
                    //Get Image Extension
                    $extension = $image->getClientOriginalExtension();
                    //Generate New Image Name
                    $image_name = $key.'-'.time().'-'.$product->product_name.'.'.$extension;
                    $image->move(public_path('front/images/product_image/'),$image_name);
                    $image = new ProductsImage;
                    $image->image = $image_name; 
                    $image->product_id = $id;
                    $image->status = 1;
                    $image->save(); 
                    }  
                }
                }else{
                    $image = new ProductsImage;
                    $image->image = "";
                }
            return redirect()->back()->with('success_message','Image Upload Successfully!');
        }
        return view('admin.images.add_images')->with(compact('product'));

    }
      //Update Image Status
      public function updateImageStatus(Request $request){
        if($request->ajax()){
            $data = $request->all();
            if($data['status']=="Active"){
                $status = 0;
            }else{
                $status = 1;
            }
            ProductsImage::where('id',$data['image_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status,'image_id'=>$data['image_id']]);
        }
    }
    //Delete Image
    public function deleteImage($id){
        $productImage = ProductsImage::select('image')->where('id',$id)->first();
        //Get Image path
        $imagePath = 'front/images/product_image/';
        if(file_exists($imagePath.$productImage->image)){
            unlink($imagePath.$productImage->image);
        }
        ProductsImage::where('id',$id)->delete();
        $message = "Image Deleted Successfully!";
        return redirect()->back()->with('success_message',$message);
    }
}
