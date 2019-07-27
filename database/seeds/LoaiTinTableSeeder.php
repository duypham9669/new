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
        	['idTheLoai'=>'1','Ten' => 'Giáo Dục'],
        	['idTheLoai'=>'1','Ten' => 'Nhịp Điệu Trẻ'],
        	['idTheLoai'=>'2','Ten' => 'Cuộc Sống Đó Đây'],
        	['idTheLoai'=>'2','Ten' => 'Ảnh'],
        	['idTheLoai'=>'3','Ten' => 'Mua Sắm'],
        	['idTheLoai'=>'3','Ten' => 'Doanh Nghiệp Viết']

    	]);
    }
}


