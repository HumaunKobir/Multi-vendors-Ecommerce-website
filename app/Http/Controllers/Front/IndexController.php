<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\Product;

class IndexController extends Controller
{
    public function index(){
        $sliderbanners = Banner::where('type','Slider')->where('status',1)->get()->toArray();
        $fixbanners = Banner::where('type','Fix')->where('status',1)->get()->toArray();
        $newProducts = Product::orderBy('id','Desc')->where('status',1)->limit(8)->get()->toArray();
        $bestSellers = Product::inRandomOrder()->where(['is_bestseller'=>'Yes','status'=>1])->get()->toArray();
        $proDiscounts = Product::inRandomOrder()->where('product_discount','>',0)->where('status',1)->limit(8)->get()->toArray();
        $proFeatured = Product::inRandomOrder()->where(['is_featured'=>'Yes','status'=>1])->limit(8)->get()->toArray();
        return view('front.index')->with(compact('sliderbanners','fixbanners','newProducts','bestSellers','proDiscounts','proFeatured'));
    }
}
