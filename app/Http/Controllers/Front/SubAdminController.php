<?php

namespace App\Http\Controllers\Front;

use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subadmin;
use App\Models\Vendor;
use App\Models\Admin;
use Validator;
use DB;

class SubAdminController extends Controller
{
    public function loginRegister(){
        return view('front.subadmins.login_register');
    }
    //For Register
    public function subadminRegister(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            //validate Vendor
            $rules = [
                'name'=>'required',
                'email'=>'required|email|unique:admins|unique:subadmins',
                'mobile'=>'required|min:11|numeric|unique:admins|unique:subadmins',
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
            $vendor_id = DB::getPdo()->lastInsertId();
            $subadmin = new Subadmin;
            $subadmin->type = 'subadmin';
            $subadmin->vendor_id = $vendor_id;
            $subadmin->name = $data['name'];
            $subadmin->mobile = $data['mobile'];
            $subadmin->email = $data['email'];
            $subadmin->status = 0;
            $subadmin->save();

            $subadmin_id = DB::getPdo()->lastInsertId();

            //Insert The subadmin account in Admins table
            $admin = new Admin;
            $admin->type = 'subadmin';
            $admin->vendor_id = 0;
            $admin->subadmin_id = $subadmin_id;
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
             Mail::send('emails.subadmin_confirmation',$messageData,function($message)use($email){
                $message->to($email)->subject('Confirm Your Subadmin Account');
             });

            DB::commit();
            //Succes message
            $message = "Thanks for registering as Subadmin. We will confirm by email to activate your account.";
            return redirect()->back()->with('success_message',$message);

        }
    }
    //send Email
    public function confirmSubadmin($email){
         $email= base64_decode($email); 
        //check email exists
        $subadminCount = Subadmin::where('email',$email)->count();
        if($subadminCount>0){
            $subadminDetails = Subadmin::where('email',$email)->first();
            if($subadminDetails->confirm == "Yes"){
                $message = "Your Account Already confirm. You can Login Now!";
                return redirect('subadmin/login-register')->with('error_message',$message);
            }else{
                Admin::where('email',$email)->update(['confirm'=>"Yes"]);
                Subadmin::where('email',$email)->update(['confirm'=>"Yes"]);
                //Send Email
                $messageData = [
                    'email'=>$email,
                    'name'=>$subadminDetails->name,
                    'mobile'=>$subadminDetails->mobile,
                 ];
                 Mail::send('emails.subadmin_confirmed',$messageData,function($message)use($email){
                    $message->to($email)->subject('Your Account Confirmed');
                 });
                $message = "Your Account is Confirmed. You can login After Admin Approved Your Account Please Wait!";

                return redirect('subadmin/login-register')->with('success_message',$message);
            }
        }else{
            abort(404);
        }

    }
}
