<?php

use Illuminate\Database\Seeder;

class TheLoaiTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	DB::table('TheLoai')->insert([
        	['Ten' => 'Xã Hội'],
        	['Ten' => 'Thế Giới'],
        	['Ten' => 'Kinh Doanh']

    	]);

    }
}
