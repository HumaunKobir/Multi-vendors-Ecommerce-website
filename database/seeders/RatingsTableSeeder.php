<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Rating;

class RatingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ratingRecords = [
            ['id'=>1,'user_id'=>1,'product_id'=>4,'review'=>'Its Realy Good','rating'=>4,'status'=>1],
            ['id'=>2,'user_id'=>1,'product_id'=>3,'review'=>'Its Realy Good','rating'=>4,'status'=>1],
        ]; 
        Rating::insert($ratingRecords);
    }
}
