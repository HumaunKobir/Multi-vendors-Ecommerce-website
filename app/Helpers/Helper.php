<?php
use App\Models\Cart;

function totalCartItems(){
    if(Auth::check()){
        $user_id = Auth::user()->id;
        $totalCartItems = Cart::where('user_id',$user_id)->sum('quantity');
    }else{
        $session_id = Session::get('session_id');
        $totalCartItems = Cart::where('session_id',$session_id)->sum('quantity');
    }
    return $totalCartItems;
}
//Cart Items
 function getCartItems(){
    if(Auth::check()){
         
    //if User is  Logged in get user id
    $getCartItems = Cart::with(['product'=>function($query){
        $query->select('id','category_id','product_name','product_code','product_color','product_image');
    }])->orderBy('id','Desc')->where('user_id',Auth::user()->id)->get()->toArray();

    }else{
         
    //if User is not Logged in get session id
    $getCartItems = Cart::with(['product'=>function($query){
        $query->select('id','category_id','product_name','product_code','product_color','product_image');
    }])->orderBy('id','Desc')->where('session_id',Session::get('session_id'))->get()->toArray();
    }
    //dd($getCartItems);
    return $getCartItems;
}