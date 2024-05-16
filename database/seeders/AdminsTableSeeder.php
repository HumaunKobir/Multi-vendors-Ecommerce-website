<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRecords=[
            //['id'=>2,'name'=>'kobir','type'=>'vendor','vendor_id'=>1,'mobile'=>'01887363763','email'=>'hkobir@gmail.com','password'=>'$2a$12$.YIEXPt0Qt.HE7dgxgln7uhkC1D.LHoP6upS/5xs1R5WLIqQ5gqPy','image'=>'','status'=>0],
            ['id'=>4,'name'=>'H.Kobir','type'=>'subadmin','subadmin_id'=>1,'vendor_id'=>0,'mobile'=>'01887363763','email'=>'hk@gmail.com','password'=>'$2a$12$G7.nRfWTarBQFkMojfDE1.HPxNm7zHUpabvr.R27oRP//0pHw2ltW','image'=>'','status'=>0],
        ];
        Admin::insert($adminRecords);
    }
}
