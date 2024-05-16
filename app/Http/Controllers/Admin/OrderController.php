<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Models\OrderStatus;
use App\Models\OrderItemStatus;
use App\Models\OrdersProduct;
use App\Models\OrdersLog;
use App\Models\DeliveryBoy;
use App\Models\Vendor;
use Dompdf\Dompdf;
use Dompdf\Options;
use Mail;
use Session;
use Auth;

class OrderController extends Controller
{
    public function orders(){
        Session::put('page','orders');
        $adminType = Auth::guard('admin')->user()->type;
        $vendor_id = Auth::guard('admin')->user()->vendor_id;
        $delivery_boy_name = OrdersLog::where('delivery_boy_name',Auth::user()->name)->get()->toArray();
        //dd($delivery_boy_id);
        if($adminType == "vendor"){
            $vendorStatus = Auth::guard('admin')->user()->status;
            if($vendorStatus== 0){
                return redirect('admin/update-vendor-details/personal')->with('error_message','Your vendor account is not approve yet. please make sure to fill your valid personal, business, and bank details.');
            }
        }
        if($adminType == "vendor"){
            $orders = Order::with(['orders_products'=>function($query)use($vendor_id){
                $query->where('vendor_id',$vendor_id);
            }])->orderBy('id','Desc')->get()->toArray(); 
        }else if($adminType == "deliveryboy"){
            $orders = Order::with(['orders_products'=>function($query)use($delivery_boy_name){
                $query->where('delivery_boy_name',$delivery_boy_name);
            }])->orderBy('id','Desc')->get()->toArray();
            //dd($orders);
        }else{
            $orders = Order::with('orders_products')->orderBy('id','Desc')->get()->toArray();
            //dd($orders);
        }
        return view('admin.orders.orders')->with(compact('orders'));
    }
    //Order Details 
    public function orderDetails($id){
        Session::put('page','orders');
        $adminType = Auth::guard('admin')->user()->type;
        $vendor_id = Auth::guard('admin')->user()->vendor_id;
        if($adminType == "vendor"){
            $vendorStatus = Auth::guard('admin')->user()->status;
            if($vendorStatus== 0){
                return redirect('admin/update-vendor-details/personal')->with('error_message','Your vendor account is not approve yet. please make sure to fill your valid personal, business, and bank details.');
            }
        }
        if($adminType == "vendor"){
            $orderDetails = Order::with(['orders_products'=>function($query)use($vendor_id){
                $query->where('vendor_id',$vendor_id);
            }])->where('id',$id)->first()->toArray();
        }else{
            $orderDetails = Order::with('orders_products')->where('id',$id)->first()->toArray();
        }
        $userDetails = User::where('id',$orderDetails['user_id'])->first()->toArray();
        $orderLogs = OrdersLog::with('orders_products')->where('order_id',$id)->orderBy('id','Desc')->get()->toArray();
        $orderStatuses = OrderStatus::where('status',1)->get()->toArray();
        $orderItemStatuses = OrderItemStatus::where('status',1)->get()->toArray();
        $deliveryBoyStatus = DeliveryBoy::where('status',1)->get()->toArray();
        return view('admin.orders.order_details')->with(compact('orderDetails','userDetails','orderStatuses','orderItemStatuses','orderLogs','deliveryBoyStatus'));
    }
    //Update Order Status
    public function updateOrderStatus(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            if(!empty($data['courier_name']) && !empty($data['tracking_number']) && !empty($data['delivery_boy_name'])){
                Order::where('id',$data['order_id'])->update(['courier_name'=>$data['courier_name'],'tracking_number'=>$data['tracking_number'],'delivery_boy_name'=>$data['delivery_boy_name']]);
            }
            Order::where('id',$data['order_id'])->update(['order_status'=>$data['order_status'],'delivery_boy_name'=>$data['delivery_boy_name']]);
            //Update order log
            $log = new OrdersLog;
            $log->order_id = $data['order_id'];
            $log->order_status = $data['order_status'];
            $log->delivery_boy_name = $data['delivery_boy_name'];
            $log->save();
            //Send Email for order status
            $deliveryDetails = Order::select('name','email','mobile')->where('id',$data['order_id'])->first()->toArray();
            $orderDetails = Order::with('orders_products')->where('id',$data['order_id'])->first()->toArray();
             //Send the Mail
             
            if(!empty($data['courier_name']) && !empty($data['tracking_number'])){
                $email = $deliveryDetails['email'];
                $messageData = [
                    'email' => $email,
                    'name' => $deliveryDetails['name'],
                    'order_id' => $data['order_id'],
                    'orderDetails' => $orderDetails,
                    'order_status' => $data['order_status'],
                    'courier_name' => $data['courier_name'],
                    'tracking_number' => $data['tracking_number'],
                    'delivery_boy_name' => $data['delivery_boy_name'],
                ];
                Mail::Send('emails.order_status',$messageData,function($message)use($email){
                    $message->to($email)->Subject("Order Placed - Multi Vendors Ecommerce Website");
                });
            }else{
                $email = $deliveryDetails['email'];
                $messageData = [
                    'email' => $email,
                    'name' => $deliveryDetails['name'],
                    'order_id' => $data['order_id'],
                    'orderDetails' => $orderDetails,
                    'order_status' => $data['order_status'],
                ];
                Mail::Send('emails.order_status',$messageData,function($message)use($email){
                    $message->to($email)->Subject("Order Placed - Multi Vendors Ecommerce Website");
                });
            } 
            return redirect()->back()->with('success_message','Order status successfully Updated');
        }
    }
    //Update Order Status
    public function updateOrderItemStatus(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            if(!empty($data['item_courier_name']) && !empty($data['item_tracking_number']) && !empty($data['delivery_boy_name'])){
                OrdersProduct::where('id',$data['order_item_id'])->update(['courier_name'=>$data['item_courier_name'],'tracking_number'=>$data['item_tracking_number'],'delivery_boy_name'=>$data['delivery_boy_name']]);
                Order::where('id',$data['order_item_id'])->update(['delivery_boy_name'=>$data['delivery_boy_name']]);
            }
            Order::where('id',$data['order_item_id'])->update(['delivery_boy_name'=>$data['delivery_boy_name']]);
            OrdersProduct::where('id',$data['order_item_id'])->update(['item_status'=>$data['order_item_status'],'delivery_boy_name'=>$data['delivery_boy_name']]);
            $getOrderId = OrdersProduct::select('order_id')->where('id',$data['order_item_id'])->first()->toArray();
            //Update order log
            $log = new OrdersLog;
            $log->order_id = $getOrderId['order_id'];
            $log->order_item_id = $data['order_item_id'];
            $log->order_status = $data['order_item_status'];
            $log->delivery_boy_name = $data['delivery_boy_name'];
            $log->save();
            //Send Email for order item status
            //Get order id
            $order_item_id = $data['order_item_id'];
            $deliveryDetails = Order::select('name','email','mobile')->where('id',$getOrderId)->first()->toArray();
            $orderDetails = Order::with(['orders_products'=>function($query)use($order_item_id){
                $query->where('id',$order_item_id);
            }])->where('id',$getOrderId['order_id'])->first()->toArray();
            //Send the Mail
            if(!empty($data['item_courier_name']) && !empty($data['item_tracking_number'])){
                $email = $deliveryDetails['email'];
                $messageData = [
                    'email' => $email,
                    'name' => $deliveryDetails['name'],
                    'order_id' => $getOrderId['order_id'],
                    'orderDetails' => $orderDetails,
                    'order_status' => $data['order_item_status'],
                    'courier_name' => $data['item_courier_name'],
                    'tracking_number' => $data['item_tracking_number'],
                    'delivery_boy_name' => $data['delivery_boy_name'],
                ];
                Mail::Send('emails.order_item_status',$messageData,function($message)use($email){
                    $message->to($email)->Subject("Order Placed - Multi Vendors Ecommerce Website");
                });
            }else{
                $email = $deliveryDetails['email'];
                $messageData = [
                    'email' => $email,
                    'name' => $deliveryDetails['name'],
                    'order_id' => $getOrderId['order_id'],
                    'orderDetails' => $orderDetails,
                    'order_status' => $data['order_item_status'],
                ];
                Mail::Send('emails.order_item_status',$messageData,function($message)use($email){
                    $message->to($email)->Subject("Order Placed - Multi Vendors Ecommerce Website");
                });
            }
            return redirect()->back()->with('success_message','Order Item status successfully Updated');
        }
    }
    //Order Invoice
    public function viewOrderInvoice($order_id){
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
                return view('admin.orders.order_invoice')->with(compact('orderDetail', 'userDetails'));
            }
        }
    }
}
