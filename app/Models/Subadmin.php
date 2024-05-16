<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subadmin extends Model
{
    use HasFactory;
    protected $guard='admin';
    public function vendorPersonal(){
        return $this->belongsTo('App\Models\Vendor','vendor_id');
      }
      public function vendorBusiness(){
        return $this->belongsTo('App\Models\vendorsBusinessDetail','vendor_id');
      }
      public function vendorBank(){
        return $this->belongsTo('App\Models\vendorsBankDetail','vendor_id');
      }
}
