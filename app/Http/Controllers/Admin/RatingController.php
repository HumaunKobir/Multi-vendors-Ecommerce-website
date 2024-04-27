<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rating;
use Session;

class RatingController extends Controller
{
    public function ratings(){
        Session::put('page','rating');
        $ratings = Rating::with(['user','product'])->get()->toArray();
        //dd($ratings);
        return view('admin.ratings.ratings')->with(compact('ratings'));
    }
    //Update Rating Status
    public function updateRatingStatus(Request $request){
        if($request->ajax()){
            $data = $request->all();
            if($data['status']=="Active"){
                $status = 0;
            }else{
                $status = 1;
            }
            Rating::where('id',$data['rating_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status,'rating_id'=>$data['rating_id']]);
        }
    }
    //Delete Rating
    public function deleteRating($id) {
        Rating::where('id',$id)->delete();
        $massege = "Rating Deleted Successfully!";
        return redirect()->back()->with('success_message',$massege);
    }
}
