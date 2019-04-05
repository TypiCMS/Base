<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class MenuSeeder extends Seeder
{
    public function run()
    {
        $typi_menus = [
            ['id' => 1, 'name' => 'main', 'status' => '{"fr":"1","en":"1","nl":"1"}', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 2, 'name' => 'footer', 'status' => '{"fr":"1","en":"1","nl":"1"}', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 3, 'name' => 'social', 'status' => '{"fr":"1","en":"1","nl":"1"}', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ];

        DB::table('menus')->insert($typi_menus);
    }
}
