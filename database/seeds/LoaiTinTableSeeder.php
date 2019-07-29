<?php

use Illuminate\Database\Seeder;

class LoaiTinTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('LoaiTin')->insert([
        	['idTheLoai'=>'1','Ten' => 'Máy Tính Windows'],
        	['idTheLoai'=>'1','Ten' => 'Máy Tính macOS'],
        	['idTheLoai'=>'2','Ten' => 'Điện Thoại Android'],
        	['idTheLoai'=>'2','Ten' => 'Điện Thoại IOS'],
        	['idTheLoai'=>'3','Ten' => 'Xe Máy'],
        	['idTheLoai'=>'3','Ten' => 'Ô Tô']

    	]);
    }
}


