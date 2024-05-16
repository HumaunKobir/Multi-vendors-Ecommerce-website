<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DeliveryAddress;
use App\Models\Country;
use Validator;
use View;
use Auth;

class AddressController extends Controller
{
    public function getDeliveryAddress(Request $request){
        if($request->ajax()){
            $data = $request->all();
            $address = DeliveryAddress::where('id',$data['addressid'])->first()->toArray();
            return response()->json(['address'=>$address]);
        }
    }
    //Save Delivery Address 
    public function saveDeliveryAddress(Request $request){
        if($request->ajax()){
            $validator = Validator::make($request->all(),[
                'delivery_name'=>'required|string',
                'delivery_address'=>'required|string',
                'delivery_city'=>'required|string',
                'delivery_state'=>'required|string',
                'delivery_country'=>'required|string',
                'delivery_pincode'=>'required|string',
                'delivery_mobile'=>'required|string|min:11',
            ]);
            if($validator->passes()){
                $data = $request->all();
                $address = array();
                $address['user_id'] = Auth::user()->id;
                $address['name'] = $data['delivery_name'];
                $address['address'] = $data['delivery_address'];
                $address['city'] = $data['delivery_city'];
                $address['state'] = $data['delivery_state'];
                $address['country'] = $data['delivery_country'];
                $address['pincode'] = $data['delivery_pincode'];
                $address['mobile'] = $data['delivery_mobile'];
                if(!empty($data['delivery_id'])){
                    DeliveryAddress::where('id',$data['delivery_id'])->update($address);
                }else{
                    DeliveryAddress::create($address);
                }
                $deliveryAddresses = DeliveryAddress::deliveryAddresses();
                $countries = Country::where('status',1)->get()->toArray();
                return response()->json(['view'=>(String)View::make('front.products.delivery_address')->with(compact('deliveryAddresses','countries'))]);
            }else{
                return response()->json(['type'=>'error','errors'=>$validator->messages()]);
            }
        }
    }
    //Remove Delivery Address
    public function removeDeliveryAddress(Request $request){
        if($request->ajax()){
            $data = $request->all();
            DeliveryAddress::where('id',$data['addressid'])->delete();
            $deliveryAddresses = DeliveryAddress::deliveryAddresses();
            $countries = Country::where('status',1)->get()->toArray();
            return response()->json(['view'=>(String)View::make('front.products.delivery_address')->with(compact('deliveryAddresses','countries'))]);
        }
    }
}
