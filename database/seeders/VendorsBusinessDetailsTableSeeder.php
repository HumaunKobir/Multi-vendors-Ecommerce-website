<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\vendorsBusinessDetail;

class VendorsBusinessDetailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vendorRecords = ['id'=>1,'vendor_id'=>1,'shop_name'=>'Hk Shop','shop_address'=>'Hk Shop','shop_city'=>'Uttara','shop_state'=>'Sector-10','shop_country'=>'Bangladesh','shop_pincode'=>'1234','shop_mobile'=>'01887363763','shop_website'=>'h.kobir','shop_email'=>'hkobir@gamil.com','address_proof'=>'Passport','address_proof_image'=>'test.jpg','bussines_license_number'=>'123456'];
        
        vendorsBusinessDetail::insert($vendorRecords);
    }
}
