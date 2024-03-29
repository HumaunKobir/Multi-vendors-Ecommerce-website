<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Vendor;

class VendorsTableSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vendorRecords=['id'=>1,'name'=>'kobir','address'=>'Dhaka','city'=>'Nikonjo','state'=>'Dhaka','country'=>'Bangladesh','mobile'=>'01887363763','email'=>'hkobir@gamil.com','pincode'=>'1232','status'=>0];
        Vendor::insert($vendorRecords);
    }
}
