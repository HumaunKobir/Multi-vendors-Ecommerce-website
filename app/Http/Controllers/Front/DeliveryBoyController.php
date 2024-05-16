<?php

namespace App\Http\Controllers\Front;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DeliveryBoy;
use App\Models\Subadmin;
use App\Models\Vendor;
use App\Models\Admin;
use Validator;
use DB;

class DeliveryBoyController extends Controller
{
    public function loginRegister(){
        return view('front.deliveryboys.login_register');
    }
    //For Register
    public function deliveryboyRegister(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            //validate Vendor
            $rules = [
                'name'=>'required',
                'email'=>'required|email|unique:admins|unique:delivery_boys',
                'mobile'=>'required|min:11|numeric|unique:admins|unique:delivery_boys',
            ];
            $customMessage =[
                'name.required'=>'Name is Required',
                'email.required'=>'Email is Required',
                'email.unique'=>'Email already exists',
                'mobile.unique'=>'Phone number already exists',
                'mobile.required'=>'Phone number is Required',
            ];
            $validator = Validator::make($data,$rules,$customMessage);
            if($validator->fails()){
                return redirect()->back()->withErrors($validator);
            }
            DB::beginTransaction();
           //save delivery Boy data
           $deliveryboy = new DeliveryBoy;
           $deliveryboy->type = "deliveryboy";
           $deliveryboy->name = $data['name'];
           $deliveryboy->email = $data['email'];
           $deliveryboy->mobile = $data['mobile'];
           $deliveryboy->password = bcrypt($data['password']);
           $deliveryboy->status = 0;
           $deliveryboy->save();

            $delivery_boy_id = DB::getPdo()->lastInsertId();

            //Insert The subadmin account in Admins table
            $admin = new Admin;
            $admin->type = 'deliveryboy';
            $admin->vendor_id = 0;
            $admin->delivery_boy_id = $delivery_boy_id;
            $admin->name = $data['name'];
            $admin->mobile = $data['mobile'];
            $admin->email = $data['email'];
            $admin->password = bcrypt($data['password']);
            $admin->status = 0;
            $admin->save();

             //Send Confirmation Email
             $email = $data['email'];
             $messageData = [
                'email'=>$data['email'],
                'name'=>$data['name'],
                'code'=>base64_encode($data['email']),
             ];
             Mail::send('emails.deliveryboy_confirmation',$messageData,function($message)use($email){
                $message->to($email)->subject('Confirm Your DeliveryBoy Account');
             });

            DB::commit();
            //Succes message
            $message = "Thanks for registering as DeliveryBoy. We will confirm by email to activate your account.";
            return redirect()->back()->with('success_message',$message);

        }
    }
    //send Email
    public function confirmDeliveryboy($email){
         $email= base64_decode($email); 
        //check email exists
        $deliveryboyCount = DeliveryBoy::where('email',$email)->count();
        if($deliveryboyCount>0){
            $deliveryboyDetails = DeliveryBoy::where('email',$email)->first();
            if($deliveryboyDetails->confirm == "Yes"){
                $message = "Your Account Already confirm. You can Login Now!";
                return redirect('deliveryboy/login-register')->with('error_message',$message);
            }else{
                Admin::where('email',$email)->update(['confirm'=>"Yes"]);
                //Send Email
                $messageData = [
                    'email'=>$email,
                    'name'=>$deliveryboyDetails->name,
                    'mobile'=>$deliveryboyDetails->mobile,
                 ];
                 Mail::send('emails.deliveryboy_confirmed',$messageData,function($message)use($email){
                    $message->to($email)->subject('Your Account Confirmed');
                 });
                $message = "Your Account is Confirmed. You can login After Admin Approved Your Account Please Wait!";

                return redirect('deliveryboy/login-register')->with('success_message',$message);
            }
        }else{
            abort(404);
        }

    }
}
