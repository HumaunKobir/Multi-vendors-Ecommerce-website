<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\vendorsBankDetail;

class VendorsBankDetailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vendorRecords = [
            'id'=>1,'vendor_id'=>1,'account_holder_name'=>'Humaun','bank_name'=>'Jumuna','account_number'=>'123434256','bank_ifsc_code'=>'13424',
        ];

        vendorsBankDetail::insert($vendorRecords);
    }
}
