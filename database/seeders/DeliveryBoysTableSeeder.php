<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DeliveryBoy;

class DeliveryBoysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $deliveryBoyRecords=['id'=>2,'name'=>'kobir','password'=>'$2y$10$Ljejm8L0vM2lRot1CSVns.jYnmO3umedQYc8APxqwdFt17ikrSLPm','address'=>'Dhaka','city'=>'Nikonjo','state'=>'Dhaka','country'=>'Bangladesh','mobile'=>'01887363763','email'=>'hkobir@gamil.com','pincode'=>'1232','status'=>1];
        DeliveryBoy::insert($deliveryBoyRecords);
    }
}
