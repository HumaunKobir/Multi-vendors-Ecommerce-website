<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DeliveryAddress;

class DeliveryAddressTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $deliveryRecords =[
            ['id'=>1,'user_id'=>2,'name'=>'Tanvir','address'=>'Gazipur','city'=>'Gazipur','state'=>'Gazipur','country'=>'Bangladesh','pincode'=>2040,'mobile'=>'02786453355','status'=>1],
            ['id'=>2,'user_id'=>3,'name'=>'Hafiz','address'=>'Jamalpur','city'=>'Jamalpur','state'=>'Jamalpur','country'=>'Bangladesh','pincode'=>2040,'mobile'=>'027456453355','status'=>1],
        ];
        DeliveryAddress::insert($deliveryRecords);
    }
}
