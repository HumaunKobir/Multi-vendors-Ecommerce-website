<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productRecords = [
            ['id'=>1,'section_id'=>2,'category_id'=>16,'brand_id'=>9,'vendor_id'=>1,'admin_id'=>2,'admin_type'=>'vendor','product_name'=>'Nokia 11 Pro','product_code'=>'N11','product_color'=>'Black','product_price'=>16000,'product_discount'=>10,'product_weight'=>500,'product_image'=>'','product_video'=>'','product_description'=>'','meta_title'=>'','meta_description'=>'','meta_keywords'=>'','is_featured'=>'Yes','status'=>1],
            ['id'=>2,'section_id'=>1,'category_id'=>10,'brand_id'=>6,'vendor_id'=>0,'admin_id'=>1,'admin_type'=>'admin','product_name'=>'Shari','product_code'=>'s22','product_color'=>'Black','product_price'=>1600,'product_discount'=>10,'product_weight'=>500,'product_image'=>'','product_video'=>'','product_description'=>'','meta_title'=>'','meta_description'=>'','meta_keywords'=>'','is_featured'=>'Yes','status'=>1],
        ];
        Product::insert($productRecords);
    }
}
