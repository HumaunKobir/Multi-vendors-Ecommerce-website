<?php

namespace App\Http\Controllers\Front;

use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vendor;
use App\Models\Admin;
use App\Models\Subadmin;
use Validator;
use DB;

class VendorController extends Controller
{
    public function loginRegister(){
        return view('front.vendors.login_register');
    }
    //For Register
    public function vendorRegister(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            //validate Vendor
            $rules = [
                'name'=>'required',
                'email'=>'required|email|unique:admins|unique:vendors',
                'mobile'=>'required|min:11|numeric|unique:admins|unique:vendors',
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
            //Save Vendor Account
            //insert the vendor account in vendor table
            $vendor = new Vendor;
            $vendor->name = $data['name'];
            $vendor->mobile = $data['mobile'];
            $vendor->email = $data['email'];
            $vendor->status = 0;
            $vendor->save();

            $vendor_id = DB::getPdo()->lastInsertId();
            //Insert The vendor account in SubAdmins table
            $subadmin = new Subadmin;
            $subadmin->type = 'vendor';
            $subadmin->vendor_id = $vendor_id;
            $subadmin->name = $data['name'];
            $subadmin->mobile = $data['mobile'];
            $subadmin->email = $data['email'];
            $subadmin->status = 0;
            $subadmin->save();
            //Insert The vendor account in Admins table
            $admin = new Admin;
            $admin->type = 'vendor';
            $admin->vendor_id = $vendor_id;
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
             Mail::send('emails.vendor_confirmation',$messageData,function($message)use($email){
                $message->to($email)->subject('Confirm Your Vendor Account');
             });

            DB::commit();
            //Succes message
            $message = "Thanks for registering as vendor. We will confirm by email to activate your account.";
            return redirect()->back()->with('success_message',$message);

        }
    }
    //send Email
    public function confirmVendor($email){
         $email= base64_decode($email); 
        //check vendor email exists
        $vendorCount = Vendor::where('email',$email)->count();
        if($vendorCount>0){
            $vendorDetails = Vendor::where('email',$email)->first();
            if($vendorDetails->confirm == "Yes"){
                $message = "Your Vendor Account Already confirm. You can Login!";
                return redirect('vendor/login-register')->with('error_message',$message);
            }else{
                Admin::where('email',$email)->update(['confirm'=>"Yes"]);
                Vendor::where('email',$email)->update(['confirm'=>"Yes"]);
                Subadmin::where('email',$email)->update(['confirm'=>"Yes"]);
                //Send Email
                $messageData = [
                    'email'=>$email,
                    'name'=>$vendorDetails->name,
                    'mobile'=>$vendorDetails->mobile,
                 ];
                 Mail::send('emails.vendor_confirmed',$messageData,function($message)use($email){
                    $message->to($email)->subject('Your Vendor Account Confirmed');
                 });
                $message = "Your Vendor Account is Confirmed. You can login and add Your Personal, Business, and Bank Details to your vendor account to add products";

                return redirect('vendor/login-register')->with('success_message',$message);
            }
        }else{
            abort(404);
        }

    }
}
