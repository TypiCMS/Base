<?php

use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    public function run()
    {
        $typi_menus = [
            ['id' => '1', 'name' => 'main', 'class' => '', 'created_at' => '2013-09-03 22:05:21', 'updated_at' => '2014-02-17 16:00:00'],
            ['id' => '2', 'name' => 'footer', 'class' => '', 'created_at' => '2013-09-03 22:05:42', 'updated_at' => '2014-02-17 16:00:00'],
            ['id' => '3', 'name' => 'social', 'class' => '', 'created_at' => '2014-02-04 18:27:18', 'updated_at' => '2014-02-17 16:00:00'],
        ];

        $typi_menu_translations = [
            ['id' => '1', 'menu_id' => '1', 'locale' => 'fr', 'status' => '1', 'created_at' => '2014-02-17 16:00:00', 'updated_at' => '2014-02-17 16:00:00'],
            ['id' => '2', 'menu_id' => '1', 'locale' => 'nl', 'status' => '1', 'created_at' => '2014-02-17 16:00:00', 'updated_at' => '2014-02-17 16:00:00'],
            ['id' => '3', 'menu_id' => '1', 'locale' => 'en', 'status' => '1', 'created_at' => '2014-02-17 16:00:00', 'updated_at' => '2014-02-17 16:00:00'],
            ['id' => '4', 'menu_id' => '2', 'locale' => 'fr', 'status' => '1', 'created_at' => '2014-02-17 16:00:00', 'updated_at' => '2014-02-17 16:00:00'],
            ['id' => '5', 'menu_id' => '2', 'locale' => 'nl', 'status' => '1', 'created_at' => '2014-02-17 16:00:00', 'updated_at' => '2014-02-17 16:00:00'],
            ['id' => '6', 'menu_id' => '2', 'locale' => 'en', 'status' => '1', 'created_at' => '2014-02-17 16:00:00', 'updated_at' => '2014-02-17 16:00:00'],
            ['id' => '7', 'menu_id' => '3', 'locale' => 'fr', 'status' => '1', 'created_at' => '2014-02-04 18:27:18', 'updated_at' => '2014-02-04 18:35:01'],
            ['id' => '8', 'menu_id' => '3', 'locale' => 'nl', 'status' => '1', 'created_at' => '2014-02-04 18:27:18', 'updated_at' => '2014-02-04 18:35:01'],
            ['id' => '9', 'menu_id' => '3', 'locale' => 'en', 'status' => '1', 'created_at' => '2014-02-04 18:27:18', 'updated_at' => '2014-02-04 18:35:01'],
        ];

        DB::table('menus')->insert($typi_menus);
        DB::table('menu_translations')->insert($typi_menu_translations);
    }
}
