<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public function section(){
        return $this->belongsTo('App\Models\Section','section_id');
    }
    public function brand(){
        return $this->belongsTo('App\Models\Brand','brand_id');
    }
    public function category(){
        return $this->belongsTo('App\Models\Category','category_id');
    }
    public function attributes(){
        return $this->hasMany('App\Models\ProductsAttribute');
    }
    public function images(){
        return $this->hasMany('App\Models\ProductsImage');
    }
    public function vendor(){
        return $this->belongsTo('App\Models\Vendor','vendor_id')->with('vendorsbusinessdetails');
    }
    public static function getDiscountPrice($product_id){
        $proDitails = Product::select('product_price','product_discount','category_id')->where('id',$product_id)->first();
        $proDitails = json_decode(json_encode($proDitails),true);
        $catDitails = Category::select('category_discount')->where('id',$proDitails['category_id'])->first();
        $catDitails = json_decode(json_encode($catDitails),true);
        if($proDitails['product_discount']>0){
            $discounted_price = $proDitails['product_price'] - ($proDitails['product_price']*$proDitails['product_discount']/100);
        } else if($catDitails['category_discount']>0){
            $discounted_price = $proDitails['product_price'] - ($proDitails['product_price']*$catDitails['category_discount']/100);
        }else{
            $discounted_price = 0;
        }
        return $discounted_price;
    }
    //Product Attribute Discount
    public static function getDiscountAttributePrice($product_id,$size){
        $proAttrPrice = ProductsAttribute::where(['product_id'=>$product_id,'size'=>$size])->first()->toArray();
        $proDitails = Product::select('product_discount','category_id')->where('id',$product_id)->first();
        $proDitails = json_decode(json_encode($proDitails),true);
        $catDitails = Category::select('category_discount')->where('id',$proDitails['category_id'])->first();
        $catDitails = json_decode(json_encode($catDitails),true);
        if($proDitails['product_discount']>0){
            $final_price = $proAttrPrice['price'] - ($proAttrPrice['price']*$proDitails['product_discount']/100);
            $discount = $proAttrPrice['price'] - $final_price;
        } else if($catDitails['category_discount']>0){
            $final_price = $proAttrPrice['price'] - ($proAttrPrice['price']*$catDitails['category_discount']/100);
            $discount = $proAttrPrice['price'] - $final_price;
        }else{
            $final_price = $proAttrPrice['price'];
            $discount = 0;
        }
        return array('product_price'=>$proAttrPrice['price'],'final_price'=>$final_price,'discount'=>$discount);
    }
    //Product is New
    public static function isProductNew($product_id){
        $productIds = Product::select('id')->where('status',1)->orderby('id','Desc')->limit(5)->pluck('id');
        $prodcutIds = json_decode(json_encode($productIds),true);
        if(in_array($product_id,$prodcutIds)){
            $isProductNew = "Yes";
        }else{
            $isProductNew = "No";
        }
        return $isProductNew;
    }
}
