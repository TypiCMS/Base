<?php

use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    public function run()
    {
        $typi_menus = [
            ['id' => '1', 'name' => 'main', 'status' => '{"fr":"1","en":"1","nl":"1"}', 'class' => '', 'created_at' => '2013-09-03 22:05:21', 'updated_at' => '2014-02-17 16:00:00'],
            ['id' => '2', 'name' => 'footer', 'status' => '{"fr":"1","en":"1","nl":"1"}', 'class' => '', 'created_at' => '2013-09-03 22:05:42', 'updated_at' => '2014-02-17 16:00:00'],
            ['id' => '3', 'name' => 'social', 'status' => '{"fr":"1","en":"1","nl":"1"}', 'class' => '', 'created_at' => '2014-02-04 18:27:18', 'updated_at' => '2014-02-17 16:00:00'],
        ];

        DB::table('menus')->insert($typi_menus);
    }
}
