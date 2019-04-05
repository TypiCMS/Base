<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class MenulinkSeeder extends Seeder
{
    public function run()
    {
        $typi_menulinks = [
            ['id' => 1, 'menu_id' => 1, 'page_id' => 1, 'status' => '{"fr":"1","en":"1","nl":"1"}', 'title' => '{"fr":"Accueil","nl":"Home","en":"Home"}', 'url' => '{"fr":null,"en":null,"nl":null}', 'position' => 1, 'target' => null, 'class' => null, 'icon_class' => null, 'has_categories' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 2, 'menu_id' => 1, 'page_id' => 2, 'status' => '{"fr":"1","en":"1","nl":"1"}', 'title' => '{"fr":"Contact","nl":"Contact","en":"Contact"}', 'url' => '{"fr":null,"en":null,"nl":null}', 'position' => 2, 'target' => null, 'class' => null, 'icon_class' => null, 'has_categories' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 3, 'menu_id' => 2, 'page_id' => 2, 'status' => '{"fr":"1","en":"1","nl":"1"}', 'title' => '{"fr":"Contact","nl":"Contact","en":"Contact"}', 'url' => '{"fr":null,"en":null,"nl":null}', 'position' => 1, 'target' => null, 'class' => null, 'icon_class' => null, 'has_categories' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 4, 'menu_id' => 2, 'page_id' => 3, 'status' => '{"fr":"1","en":"1","nl":"1"}', 'title' => '{"fr":"Conditions d’utilisation","nl":"Gebruiksvoorwaarden","en":"Terms of use"}', 'url' => '{"fr":null,"en":null,"nl":null}', 'position' => 2, 'target' => null, 'class' => null, 'icon_class' => null, 'has_categories' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 5, 'menu_id' => 3, 'page_id' => 0, 'status' => '{"fr":"1","en":"1","nl":"1"}', 'title' => '{"fr":"Facebook","nl":"Facebook","en":"Facebook"}', 'url' => '{"fr":"https://www.facebook.com","nl":"https://www.facebook.com","en":"https://www.facebook.com"}', 'position' => 1, 'target' => '_blank', 'class' => 'btn-facebook', 'icon_class' => 'fa fa-facebook fa-fw', 'has_categories' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 6, 'menu_id' => 3, 'page_id' => 0, 'status' => '{"fr":"1","en":"1","nl":"1"}', 'title' => '{"fr":"Twitter","en":"Twitter","nl":"Twitter"}', 'url' => '{"fr":"https://twitter.com","en":"https://twitter.com","nl":"https://twitter.com"}', 'position' => 2, 'target' => '_blank', 'class' => 'btn-twitter', 'icon_class' => 'fa fa-twitter fa-fw', 'has_categories' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ];

        DB::table('menulinks')->insert($typi_menulinks);
    }
}
