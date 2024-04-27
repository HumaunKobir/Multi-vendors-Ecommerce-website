<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Session;
use Auth;

class Cart extends Model
{
    use HasFactory;
    public static function getCartItems(){
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
   
    public function product(){
        return $this->belongsTo('App\Models\Product','product_id');
    }
}
