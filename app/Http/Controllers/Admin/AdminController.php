<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Hash;
use App\Models\Admin;
use App\Models\Vendor;
use App\Models\vendorsBusinessDetail;
use App\Models\vendorsBankDetail;
use App\Models\Country;
use Session;



class AdminController extends Controller
{
    public function dashboard(){
        Session::put('page','dashboard');
        return view('admin.dashboard');
    }

    public function login(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();

            $validated = $request->validate([
                'email' => 'required|email',
                'password'=> 'required',
            ]);

            if(Auth::guard('admin')->attempt(['email'=>$data['email'],'password'=>$data['password'],'status'=>1])){
                return redirect('admin/dashboard');
            }else{
                return redirect()->back()->with('error_message','Invalid Email or Password!');
            }  
        }
        return view('admin.login');
    }

    //Update Admin Password
    public function updateAdminPassword(Request $request){
        Session::put('page','update_admin_password');
        if($request->isMethod('post')){
            $data = $request->all();
            //Check current Password
            if(Hash::check($data['current_password'],Auth::guard('admin')->user()->password)){
                //Check if new Password is matching with Comfirm password
                if($data['confirm_password']==$data['new_password']){
                    Admin::where('id',Auth::guard('admin')->user()->id)->update(['password'=>bcrypt($data['new_password'])]);
                    return redirect()->back()->with('success_message','Password Has Been Upadate Successfully!');
                }else{
                    return redirect()->back()->with('error_message','New Password is not match With Confirm Password!');
                }

            }else{
                return redirect()->back()->with('error_message','Current Password is not match!');
            }
        }
        $adminDetails=Admin::where('email',Auth::guard('admin')->user()->email)->first()->toArray();
        return view('admin.settings.update_admin_password')->with(compact('adminDetails'));
        
    }

    //Update Admin Details 
    public function updateAdminDetails(Request $request) {
        Session::put('page','update_admin_details');
        if($request->isMethod('post')){
            $data = $request->all();
            $rules = ([
                'name'=> 'required|regex:/^[\pL\s\-]+$/u',
                'mobile'=> 'required|min:11|numeric'
            ]);
            $this->validate($request,$rules);
            //Upload Admin Picture
            if($request->hasFile('admin_image')){
                $image_tmp = $request->file('admin_image');
                if($image_tmp->isValid()){
                    //Get Image Extension
                    $extension = $image_tmp->getClientOriginalExtension();
                    //Generate New Image Name
                    $image_name = time().'-'.$request->name .'.'.$extension;
                    $request->admin_image->move(public_path('admin/images/photos'),$image_name);
                    
                    
                }
            }else if(!empty($data['current_admin_image'])){
                $image_name = $data['current_admin_image'];
            }else{
                $image_name = "";
            }

            Admin::where('id',Auth::guard('admin')->user()->id)->update(['name'=> $data['name'],'mobile'=> $data['mobile'], 'image'=>$image_name ]);
            return redirect()->back()->with('success_message','Admin Details Updated Successfully!');
        }
        return view('admin.settings.update_admin_details');
    }
    //Update Vendor Details
    public function updateVendorDetails($slug, Request $request) {
        if($slug=="personal"){   
        Session::put('page','update_personal_details');
            if($request->isMethod('post')){
                $data = $request->all();
                $rules = [
                    'vendor_name' => 'required|regex:/^[\pL\s\-]+$/u',
                    'vendor_mobile' => 'required|min:11|numeric',
                    
                ];
                $this->validate($request,$rules);
                //Update Vendor Image
                if($request->hasFile('vendor_image')){
                    $image_tmp = $request->file('vendor_image');
                    if($image_tmp->isValid()){
                        $extension = $image_tmp->getClientOriginalExtension();
                        $image_name = time().'-'.$request->vendor_name.'.'.$extension;
                        $image_path = $request->vendor_image->move(public_path('admin/images/photos'),$image_name);
                    }
                }elseif(!empty($data['current_vendor_image']))
                {
                    $image_name = $data['current_vendor_image'];
                }else{
                    $image_name ="";
                }
                //For Admin Table
                Admin::where('id',Auth::guard('admin')->user()->id)->update(['name'=> $data['vendor_name'],'mobile'=> $data['vendor_mobile'], 'image'=>$image_name]);
                //For Vendor Table
                Vendor::where('id',Auth::guard('admin')->user()->vendor_id)->update(['name'=> $data['vendor_name'],'address'=> $data['vendor_address'],'city'=> $data['vendor_city'],'state'=> $data['vendor_state'],'country'=> $data['vendor_country'],'mobile'=> $data['vendor_mobile'],'pincode'=> $data['vendor_pincode'],]);
                return redirect()->back()->with('success_message','Vendor Information Update Successfully!');
            }
            $vendorDetails = Vendor::where('id',Auth::guard('admin')->user()->vendor_id)->first()->toArray();
        }elseif($slug=="business"){
            Session::put('page','update_business_details');
            if($request->isMethod('post')){
                $data = $request->all();
                $rules = [
                    'shop_name' => 'required|regex:/^[\pL\s\-]+$/u',
                    'shop_mobile' => 'required|min:11|numeric',
                    'address_proof' => 'required',
                    'address_proof_image' => 'image',
                    
                ];
                $this->validate($request,$rules);
                //Update Vendor Image
                if($request->hasFile('address_proof_image')){
                    $image_tmp = $request->file('address_proof_image');
                    if($image_tmp->isValid()){
                        $extension = $image_tmp->getClientOriginalExtension();
                        $image_name = time().'-'.$request->shop_name.'.'.$extension;
                        $image_path = $request->address_proof_image->move(public_path('admin/images/proofs'),$image_name);
                    }
                }elseif(!empty($data['current_shop_image']))
                {
                    $image_name = $data['current_shop_image'];
                }else{
                    $image_name ="";
                }
                
                //For Vendor_Business Table
                vendorsBusinessDetail::where('vendor_id',Auth::guard('admin')->user()->vendor_id)->update(['shop_name'=> $data['shop_name'],'shop_address'=> $data['shop_address'],'shop_city'=> $data['shop_city'],'shop_state'=> $data['shop_state'],'shop_country'=> $data['shop_country'],'shop_pincode'=> $data['shop_pincode'],'shop_mobile'=> $data['shop_mobile'],'shop_website'=> $data['shop_website'],'address_proof'=> $data['address_proof'],'address_proof_image'=> $image_name,'bussines_license_number'=> $data['bussines_license_number'],]);
                return redirect()->back()->with('success_message','Vendor Information Update Successfully!');
            }
            $vendorDetails = vendorsBusinessDetail::where('vendor_id',Auth::guard('admin')->user()->vendor_id)->first()->toArray();

        }elseif($slug=="bank"){
            Session::put('page','update_bank_details');
            if($request->isMethod('post')){
                $data = $request->all();
                $rules = [
                    'account_holder_name' => 'required|regex:/^[\pL\s\-]+$/u',
                    'account_number' => 'required|numeric',
                    'bank_name' => 'required',
                    'bank_ifsc_code' => 'required',
                    
                ];
                $this->validate($request,$rules);
                
                //For Vendor_Business Table
                vendorsBankDetail::where('vendor_id',Auth::guard('admin')->user()->vendor_id)->update(['account_holder_name'=> $data['account_holder_name'],'bank_name'=> $data['bank_name'],'account_number'=> $data['account_number'],'bank_ifsc_code'=> $data['bank_ifsc_code'],]);
                return redirect()->back()->with('success_message','Vendor Information Update Successfully!');
            }
            $vendorDetails = vendorsBankDetail::where('vendor_id',Auth::guard('admin')->user()->vendor_id)->first()->toArray();
        }
        $countries = Country::where('status',1)->get()->toArray();
        return view('admin.settings.update_vendor_details')->with(compact('slug','vendorDetails','countries'));

    }

    public function checkCurrentPassword(Request $request){
        $data = $request->all();
        // echo "<pre>"; print_r($data);die;
        if(Hash::check($data['current_password'],Auth::guard('admin')->user()->password)){
            return "true";
        }else{
            return "false";
        }
    }
    //Admin SuperAdmin Vendors
    public function admins($type=null){
        $admins = Admin::query();
        if(!empty($type)){
            $admins = $admins->where('type',$type);
            $title = ucfirst($type).'s';
            Session::put('page','view_'.strtolower($title));
        }else{
            $title = "All Admins/Subadmins/Vendors";
            Session::put('page','view_all');
        }
        $admins = $admins->get()->toArray();
        return view('admin.admins.admins')->with(compact('admins','title'));
    }
    //View Vendor Details
    public function viewVendorDetails($id){
        $vendorDetails = Admin::with('vendorPersonal','vendorBusiness','vendorBank')->where('id',$id)->first();
        $vendorDetails = json_decode(json_encode($vendorDetails),true);
        return view('admin/admins/view_vendor_details')->with(compact('vendorDetails'));
    }
    //Update Admin Status
    public function updateAdminStatus(Request $request){
        if($request->ajax()){
            $data = $request->all();
            if($data['status']=="Active"){
                $status = 0;
            }else{
                $status = 1;
            }
            Admin::where('id',$data['admin_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status,'admin_id'=>$data['admin_id']]);
        }
    }

    public function logout(){
        Auth::guard('admin')->logout();
        return redirect('admin/login');
    }
}
