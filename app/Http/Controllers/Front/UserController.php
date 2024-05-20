<?php

namespace App\Http\Controllers\Front;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Country;
use App\Models\Cart;
use Validator;
use Session;
use Hash;
use Auth;

class UserController extends Controller
{
    public function loginRegister(){
        return view('front.users.login_register');
    }
    public function userRegister(Request $request){
        if($request->ajax()){
            $data = $request->all();
            //Validation data
            $validator = Validator::make($request->all(),[
                'name'=>'required|string',
                'mobile'=>'required|numeric|digits:11',
                'email'=>'required|email|unique:users',
                'password'=>'required|min:6',
            ]);
            if($validator->passes()){
                $user = new User;
                $user->name = $data['name'];
                $user->mobile = $data['mobile'];
                $user->email = $data['email'];
                $user->password = bcrypt($data['password']);
                $user->status = 0;
                $user->save();
                //Send Email confirmation code
                $email = $data['email'];
                $messageData =['name'=>$data['name'],'email'=>$data['email'],'code'=>base64_encode($data['email'])];
                Mail::send('emails.confirmation',$messageData,function($message)use($email){
                    $message->to($email)->subject('Welcome to multi vendor Ecommerce');
                });
                $redirectTo = url('user/login-register');
                return response()->json(['type'=>'success','url'=>$redirectTo,'message'=>'Please confirm to Activate your Account!']);
                //send email
                if(Auth::attempt(['email'=>$data['email'],'password'=>$data['password']])){
                    $redirectTo = url('cart');
                      //Update user cart with user id
                      if(!empty(Session::get('session_id'))){
                        $user_id = Auth::user()->id;
                        $session_id = Session::get('session_id');
                        Cart::where('session_id',$session_id)->update(['user_id'=>$user_id]);
                    }
                    return response()->json(['type'=>'success','url'=>$redirectTo]);
                }
            }else{
                return response()->json(['type'=>'error','errors'=>$validator->messages()]);
            }
            
        }
    }
    //User Login
    public function userLogin(Request $request){
        if($request->ajax()){
            $data = $request->all();
            //echo "<pre>"; print_r($data);die;
              //Validation data
              $validator = Validator::make($request->all(),[
                'email'=>'required|email|exists:users',
                'password'=>'required|min:6',
            ]);
            if($validator->passes()){
                if(Auth::attempt(['email'=>$data['email'],'password'=>$data['password']])){
                    if(Auth::user()->status==0){
                        Auth::logout();
                        return response()->json(['type'=>'inactive','message'=>'Your Account is Inactive Please Contact the Admin!']);
                    }
                    //Update user cart with user id
                    if(!empty(Session::get('session_id'))){
                        $user_id = Auth::user()->id;
                        $session_id = Session::get('session_id');
                        Cart::where('session_id',$session_id)->update(['user_id'=>$user_id]);
                    }
                    $redirectTo = url('cart');
                    return response()->json(['type'=>'success','url'=>$redirectTo]);
                }else{
                    return response()->json(['type'=>'incorrect','message'=>'Incorrect Email or Password!']);
                }
            }else{
                return response()->json(['type'=>'error','errors'=>$validator->messages()]);
            }
        }
    }
    //Forgot Password
    public function forgotPassword(Request $request){
        if($request->ajax()){
            $data = $request->all();
            //Validation data
            $validator = Validator::make($request->all(),[
                'email'=>'required|email|exists:users',
            ],[
                'email.exists'=>'Email does not Exists'
            ]
        );
            if($validator->passes()){
                $new_password = Str::random(16);
                $userDetails = User::where('email',$data['email'])->first()->toArray();
                User::where('email',$data['email'])->update(['password'=>bcrypt($new_password)]);
                //send email
                $email = $data['email'];
                $messageData = ['name'=>$userDetails['name'],'email'=>$email,'password'=>$new_password];
                Mail::send('emails.user_forgot_password',$messageData,function($message)use($email){
                    $message->to($email)->subject('Welcome to multi vendor Ecommerce');
                });
                return response()->json(['type'=>'success','message'=>'New password sent to your registerd email!']);
            }else{
                return response()->json(['type'=>'error','errors'=>$validator->messages()]);
            }
        }else{
         return view('front.users.forgot_password');
        }
    }
    //User Email Corfirmation
    public function confirmAccount($code){
        $email = base64_decode($code);
        $userCount = User::where('email',$email)->count();
        if($userCount >0){
            $userDetails = User::where('email',$email)->first();
            if($userDetails->status==1){
                return redirect('user/login-register')->with('error_message','Your account is already activate. You can login now');
            }else{
              User::where('email',$email)->update(['status'=>1]); 
              $messageData =['name'=>$userDetails->name,'mobile'=>$userDetails->mobile,'email'=>$email];
              Mail::send('emails.register',$messageData,function($message)use($email){
                  $message->to($email)->subject('Welcome to multi vendor Ecommerce');
              });
              return redirect('user/login-register')->with('success_message','Your account is already activate. You can login now');
            }
        }else{
            abort(404);
        }
    }
    //User Account 
    public function userAccount(Request $request){
       if($request->ajax()){
        $data = $request->all();
            //Validation data
            $validator = Validator::make($request->all(),[
                'name'=>'required|string',
                'mobile'=>'required|numeric|digits:11',
                'address'=>'required|string',
                'city'=>'required|string',
                'state'=>'required|string',
                'country'=>'required|string',
                'pincode'=>'required|numeric',
            ]);
            if($validator->passes()){
                User::where('id',Auth::user()->id)->update(['name'=>$data['name'],'address'=>$data['address'],'city'=>$data['city'],'state'=>$data['state'],'country'=>$data['country'],'pincode'=>$data['pincode'],'mobile'=>$data['mobile'],]);
                return response()->json(['type'=>'success','message'=>'Your contact/billing updated Successfully!']);
            }else{
                return response()->json(['type'=>'error','errors'=>$validator->messages()]);
            }
       }else{
        $countries = Country::where('status',1)->get()->toArray();
        return view('front.users.user_account')->with(compact('countries'));
       }
    }
     //User update Password Account 
     public function userUpdatePassword(Request $request){
        if($request->ajax()){
         $data = $request->all();
             //Validation data
             $validator = Validator::make($request->all(),[
                 'current_password'=>'required',
                 'new_password'=>'required|min:6',
                 'confirm_password'=>'required|min:6|same:new_password',
             ]);
             if($validator->passes()){
                $currentPassword = $data['current_password'];
                $checkPassword = User::where('id',Auth::user()->id)->first();
                if(Hash::check($currentPassword,$checkPassword->password)){
                    $user = User::find(Auth::user()->id);
                    $user->password = bcrypt($data['new_password']);
                    $user->save();
                    return response()->json(['type'=>'success','message'=>'Your account password successfully Update']);
                }else{
                    return response()->json(['type'=>'incorrect','message'=>'Your Current Password is Incorrect']);
                }
             }else{
                 return response()->json(['type'=>'error','errors'=>$validator->messages()]);
             }
        }else{
         $countries = Country::where('status',1)->get()->toArray();
         return view('front.users.user_account')->with(compact('countries'));
        }
     }
    //User Logout
    public function userLogout(){
        Auth::logout();
        return redirect('/');
    }
}
