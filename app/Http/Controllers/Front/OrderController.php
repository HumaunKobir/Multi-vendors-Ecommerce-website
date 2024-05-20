<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use Auth;

class OrderController extends Controller
{
    public function orders($id = null){
        if(empty($id)){
            $orders = Order::with('orders_products')->where('user_id',Auth::user()->id)->orderBy('id','Desc')->get()->toArray();
            //dd($orders);
            return view('front.orders.orders')->with(compact('orders'));
        }else{
            $orderDetails = Order::with('orders_products')->where('id',$id)->first()->toArray();
            return view('front.orders.order_detail')->with(compact('orderDetails'));
        }
    }
       //Order Invoice
       public function viewOrderInvoiceUser($order_id){
        $orderDetail = Order::with('orders_products')->where('id', $order_id)->first();
        //dd($orderDetail);
        if (!$orderDetail) {
            // Handle the case where the order is not found
            // You can return an error message or redirect the user
        } else {
            $orderDetail = $orderDetail->toArray();
            $userDetails = User::where('id', $orderDetail['user_id'])->first();
            if (!$userDetails) {
                // Handle the case where the user details are not found
                // You can return an error message or redirect the user
            } else {
                $userDetails = $userDetails->toArray();
                return view('front.orders.order_invoice')->with(compact('orderDetail', 'userDetails'));
            }
        }
    }
}
