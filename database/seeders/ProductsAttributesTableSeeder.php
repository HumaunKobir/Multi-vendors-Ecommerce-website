<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProductsAttribute;

class ProductsAttributesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productsAttributeRecords = [
            ['id'=>1,'product_id'=>2,'size'=>'Small','price'=>1600,'stock'=>10,'sku'=>'bl22-s','status'=>1],
            ['id'=>2,'product_id'=>2,'size'=>'Medium','price'=>2000,'stock'=>15,'sku'=>'bl22-m','status'=>1],
            ['id'=>3,'product_id'=>2,'size'=>'large','price'=>2200,'stock'=>20,'sku'=>'bl22-l','status'=>1],
        ];
        ProductsAttribute::insert($productsAttributeRecords);
    }
}
