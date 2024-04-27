<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;
    public function vendorsbusinessdetails(){
        return $this->belongsTo('App\Models\vendorsBusinessDetail','id','vendor_id');
    }
    public static function getVendorShop($vendorid){
        $getVendorShop = vendorsBusinessDetail::select('shop_name')->where('vendor_id',$vendorid)->first()->toArray();
        return $getVendorShop['shop_name'];
    }
}
