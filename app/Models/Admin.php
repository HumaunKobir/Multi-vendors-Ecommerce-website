<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory;
    protected $guard='admin';

    public function vendorPersonal(){
      return $this->belongsTo('App\Models\Vendor','vendor_id');
    }
    public function subAdmin(){
      return $this->belongsTo('App\Models\Subadmin','subadmin_id');
    }
    public function deliveryboy(){
      return $this->belongsTo('App\Models\DeliveryBoy','delivery_boy_id');
    }
    public function vendorBusiness(){
      return $this->belongsTo('App\Models\vendorsBusinessDetail','vendor_id');
    }
    public function vendorBank(){
      return $this->belongsTo('App\Models\vendorsBankDetail','vendor_id');
    }
}
