<?php

namespace App\Http\Controllers\Front;

use App\Models\ProductsAttribute;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vendor;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductsFilter;
use App\Models\Cart;
use App\Models\Rating;
use Session;
use Auth;

class ProductController extends Controller
{
    //Product Listing 
    public function listing(Request $request){
        if($request->ajax()){
            $data = $request->all();
            $url = $data['url'];
            $_GET['sort'] = $data['sort'];
            $categoryCount = Category::where(['url'=>$url,'status'=>1])->count();
                if($categoryCount>0){
                    //Get Category Details
                    $categoryDetails = Category::categoryDetails($url);
                    $categoryProducts = Product::with('brand')->whereIn('category_id',$categoryDetails['catIds'])->where('status',1);
                    //Chaking for Daynamic
                    $productFilters = ProductsFilter::productFilters();
                    foreach($productFilters as $key => $filter){
                        if(isset($filter['filter_column']) && isset($data[$filter['filter_column']]) && !empty($filter['filter_column']) && !empty($data[$filter['filter_column']])){
                            $categoryProducts->whereIn($filter['filter_column'],$data[$filter['filter_column']]);
                        }
                    }
                    //checking for sort
                    if(isset($_GET['sort']) && !empty($_GET['sort'])){
                        if($_GET['sort'] == "product_latest"){
                            $categoryProducts->orderBy('products.id','Desc');
                        }else if($_GET['sort'] == "product_highest"){
                            $categoryProducts->orderBy('products.product_price','Desc');
                        }else if($_GET['sort'] == "product_lowest"){
                            $categoryProducts->orderBy('products.product_price','Asc');
                        }else if($_GET['sort'] == "name_a_z"){
                            $categoryProducts->orderBy('products.product_name','Asc');
                        }else if($_GET['sort'] == "name_z_a"){
                            $categoryProducts->orderBy('products.product_name','Desc');
                        }
                    }         
                    $categoryProducts = $categoryProducts->paginate(30);
                    return view('front.products.ajax_products_listing')->with(compact('categoryDetails','categoryProducts','url'));
                }else{
                    abort(404);
                }
        }else {
            $url = Route::getFacadeRoot()->current()->uri();
            $categoryCount = Category::where(['url'=>$url,'status'=>1])->count();
            if($categoryCount>0){
                //Get Category Details
                $categoryDetails = Category::categoryDetails($url);
                $categoryProducts = Product::with('brand')->whereIn('category_id',$categoryDetails['catIds'])->where('status',1);
                //checking for sort
                if(isset($_GET['sort']) && !empty($_GET['sort'])){
                    if($_GET['sort'] == "product_latest"){
                        $categoryProducts->orderBy('products.id','Desc');
                    }else if($_GET['sort'] == "product_highest"){
                        $categoryProducts->orderBy('products.product_price','Desc');
                    }else if($_GET['sort'] == "product_lowest"){
                        $categoryProducts->orderBy('products.product_price','Asc');
                    }else if($_GET['sort'] == "name_a_z"){
                        $categoryProducts->orderBy('products.product_name','Asc');
                    }else if($_GET['sort'] == "name_z_a"){
                        $categoryProducts->orderBy('products.product_name','Desc');
                    }
                }           
                $categoryProducts = $categoryProducts->paginate(2);
                return view('front.products.listing')->with(compact('categoryDetails','categoryProducts','url'));
            }else{
                abort(404);
            }
        } 
    }
    // Get Vendor Shop Details
    public function vendorListing($vendorid){
       $getVendorShop = Vendor::getVendorShop($vendorid);
       //get vendor products
       $vendorProducts = Product::with('brand')->where('vendor_id',$vendorid)->where('status',1);
       $vendorProducts =$vendorProducts->paginate(30);
       return view('front.products.vendor_listing')->with(compact('getVendorShop','vendorProducts'));
    }
    //Product Details
    public function detail($id){
        $productDetails = Product::with(['section','category','brand','attributes'=>function($query){
            $query->where('stock','>',0)->where('status',1);
        },
        'images'=>function($query){
            $query->where(['status'=>1]);
        },'vendor'])->find($id)->toArray();
        $categoryDetails = Category::categoryDetails($productDetails['category']['url']);
        //dd($productDetails);
        //Simillar Category Products
        $similerProducts = Product::with('brand')->where('category_id',$productDetails['category']['id'])->where('id','!=',$id)->limit(15)->inRandomOrder()->get()->toArray();
        //dd($similerProducts);
        //Rating
        $ratings = Rating::with('user')->where(['product_id'=>$id,'status'=>1])->get()->toArray();
        //Rating sum 
        $ratingSum = Rating::where(['product_id'=>$id,'status'=>1])->sum('rating');
        $ratingCount = Rating::where(['product_id'=>$id,'status'=>1])->count();
        $avgRating = null;
        $avgStarRating = null;

        if ($ratingCount > 0) {
            $avgRating = round($ratingSum / $ratingCount, 2);
            $avgStarRating = round($ratingSum / $ratingCount);
        }

        // Sum Stock
        $totalStock = ProductsAttribute::where('product_id', $id)->sum('stock');

        // Compact variables inside the conditional block
        return view('front.products.detail')->with(compact('productDetails', 'categoryDetails', 'totalStock', 'similerProducts', 'ratings'))->with(compact('avgRating', 'avgStarRating'));

    }
    //Get Product Attribute Price
    public function getProductPrice(Request $request){
        if($request->ajax()){
            $data = $request->all();
            $getDiscountAttributePrice = Product::getDiscountAttributePrice($data['product_id'],$data['size']);
            //echo "<pre>"; print_r($getDiscountAttributePrice); die;
            return $getDiscountAttributePrice;
        }
    }
    //Add To Cart Function
    public function cartAdd(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            //dd($data);
            $getProductStock = ProductsAttribute::getProductStock($data['product_id'],$data['size']);
            //dd($getProductStock);
            if($getProductStock < $data['quantity']){
                return redirect()->back()->with('error_message','Required Quantity is not Available!');
            }
            //Generate Session Id if not exists
            $session_id = Session::get('session_id');
            if(empty($session_id)){
                $session_id = Session::getId();
                Session::put('session_id',$session_id);
            }
            //Check if the product is alrady Exists
            if(Auth::check()){
                //User is Login
                $user_id = Auth::user()->id;
                $countProducts = Cart::where(['product_id'=>$data['product_id'],'size'=>$data['size'],'user_id'=>$user_id])->count();

            }else{
                //user is not logged in
                $user_id = 0;
                $countProducts = Cart::where(['product_id'=>$data['product_id'],'size'=>$data['size'],'session_id'=>$session_id])->count();
            }
            //Save item in Cart table
            $item = new Cart;
            $item->session_id = $session_id;
            $item->product_id = $data['product_id'];
            $item->size = $data['size'];
            $item->quantity = $data['quantity'];
            $item->save();
            return redirect()->back()->with('success_message','Product has been added in Cart! <a style="text-decoration:underline; font-size:15px;" href="/cart">View Cart</a>');
        }
    }
    //Cart Function
    public function cart(){
        $getCartItems = Cart::getCartItems();
        //dd($getCartItems);
        return view('front.products.cart')->with(compact('getCartItems'));
    }
}
