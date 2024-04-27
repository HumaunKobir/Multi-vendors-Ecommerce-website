<?php

namespace App\Http\Controllers\Front;

use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Cart;
use Validator;
use Session;
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
                // $email = $data['email'];
                // $messageData =['name'=>$data['name'],'mobile'=>$data['mobile'],'email'=>$data['email']];
                // Mail::send('emails.register',$messageData,function($message)use($email){
                //     $message->to($email)->subject('Welcome to multi vendor Ecommerce');
                // });
                // if(Auth::attempt(['email'=>$data['email'],'password'=>$data['password']])){
                //     $redirectTo = url('cart');
                //       //Update user cart with user id
                //       if(!empty(Session::get('session_id'))){
                //         $user_id = Auth::user()->id;
                //         $session_id = Session::get('session_id');
                //         Cart::where('session_id',$session_id)->update(['user_id'=>$user_id]);
                //     }
                //     return response()->json(['type'=>'success','url'=>$redirectTo]);
                // }
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
    //User Logout
    public function userLogout(){
        Auth::logout();
        return redirect('/');
    }
}
