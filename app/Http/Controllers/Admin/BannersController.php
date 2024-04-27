<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use Session;

class BannersController extends Controller
{
    
    public function banners(){
        Session::put('page','banners');
        $banners = Banner::get()->toArray();
        return view('admin.banners.banners')->with(compact('banners'));
    }
    //Delete Banner
    public function deleteBanner($id){ 
        $banner = Banner::where('id',$id)->first();
        //Get Image path
        $imagePath = 'front/images/banner_image/';
        if(file_exists($imagePath.$banner->image)){
            unlink($imagePath.$banner->image);
        }
        Banner::where('id',$id)->delete();
        $message = "Banner Deleted Successfully!";
        return redirect()->back()->with('success_message',$message);
    }
    //Update Banner Status
    public function updateBannerStatus(Request $request){
        if($request->ajax()){
            $data = $request->all();
            if($data['status']=="Active"){
                $status = 0;
            }else{
                $status = 1;
            }
            Banner::where('id',$data['banner_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status,'banner_id'=>$data['banner_id']]);
        }
    }
        //Add Edit Products
        public function addEditBanner(Request $request,$id=null){
            Session::put('page','banners');
            if($id==""){
                $title = "Add Banner";
                $banner = new Banner;
                $message = "Banner Added Successfully!";
            }else{
                $title = "Edit Banner";
                $banner = Banner::find($id);
                $message = "Banner Updated Successfully!";
            }
            if($request->isMethod('post')){
                $data = $request->all();
                //echo "<pre>"; print_r($data); die;
                //Data Validation
                $rules = ([
                    'banner_image'=>'required',
                    'type'=>'required',
                    'title'=>'required',
                    'alt'=>'required',
                    'link'=>'required',
                ]);
                $this->validate($request,$rules);
                 //Upload Product Picture
                 if($request->hasFile('banner_image')){
                    $image_tmp = $request->file('banner_image');
                    if($image_tmp->isValid()){
                        //Get Image Extension
                        $extension = $image_tmp->getClientOriginalExtension();
                        //Generate New Image Name
                        $image_name = time().'-'.$request->product_name .'.'.$extension;
                        $request->banner_image->move(public_path('front/images/banner_image/'),$image_name);
                        $banner->image = $image_name; 
                           
                    }
                }else{
                    $banner->image = "";
                }
                $banner->type = $data['type'];
                $banner->link = isset($data['link']) ? $data['link'] : "-";
                $banner->title = isset($data['title']) ? $data['title'] : "-";
                $banner->alt = isset($data['alt']) ? $data['alt'] : "-";
                $banner->status = 1;
                if($data['type']=="slider"){
                    $width ="900";
                    $height = "510";
                }else if($data['type']=="Fix"){
                    $width = "370";
                    $height = "230";
                }
                $banner->save();
                return redirect('admin/banners')->with('success_message',$message);
            }
            return view('admin.banners.add_edit_banner')->with(compact('title','banner'));
        }
}
