<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rating;
use Auth;

class RatingController extends Controller
{
    public function addRating(Request $request){
        
        if($request->isMethod('post')){
            $data = $request->all();
            $user_id = Auth::user()->id;
            $ratingCount = Rating::where(['user_id'=>$user_id,'product_id'=>$data['product_id']])->count();
            //echo "<pre>"; print_r($data);die;
            if($ratingCount > 0){
                return redirect()->back()->with('error_message','Your rating alrady exists for this product!');
            }else{
                if(empty($data['rating'])){
                    $message = "Please Add Rating for Product";
                    return redirect()->back()->with('error_message',$message);
                }else{
                    $rating = new Rating;
                    $rating->user_id = $user_id;
                    $rating->product_id = $data['product_id'];
                    $rating->review = $data['review'];
                    $rating->rating = $data['rating'];
                    $rating->status = 0;
                    $rating->save();
                    return redirect()->back()->with('success_message',"Thanks For Your Rating!");
                }
            }
        }
    }
}
