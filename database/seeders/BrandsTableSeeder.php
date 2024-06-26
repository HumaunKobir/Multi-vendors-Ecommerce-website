<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Brand;
class BrandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $brandRecords=[
            ['id'=>1,'name'=>'Smasung','status'=>1],
            ['id'=>2,'name'=>'Arrow','status'=>1],
            ['id'=>3,'name'=>'Walton','status'=>1],
            ['id'=>4,'name'=>'iPhone','status'=>1],
            ['id'=>5,'name'=>'HP','status'=>1],
            ['id'=>6,'name'=>'Guchi','status'=>1],
            ['id'=>7,'name'=>'Smart','status'=>1],
        ];
        Brand::insert($brandRecords);
    }
}
