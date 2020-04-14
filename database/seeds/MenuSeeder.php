<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class MenuSeeder extends Seeder
{
    public function run()
    {
        $typi_menus = [
            ['id' => 1, 'image_id' => null, 'name' => 'main', 'class' => null, 'status' => '{"fr":"1","en":"1","nl":"1"}', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 2, 'image_id' => null, 'name' => 'footer', 'class' => null, 'status' => '{"fr":"1","en":"1","nl":"1"}', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 3, 'image_id' => null, 'name' => 'social', 'class' => null, 'status' => '{"fr":"1","en":"1","nl":"1"}', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 4, 'image_id' => null, 'name' => 'legal', 'class' => null, 'status' => '{"fr": 1, "en": 1, "nl": 1}', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ];

        DB::table('menus')->insert($typi_menus);
    }
}
