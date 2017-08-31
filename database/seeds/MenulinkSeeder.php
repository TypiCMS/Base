<?php

use Illuminate\Database\Seeder;

class MenulinkSeeder extends Seeder
{
    public function run()
    {
        $typi_menulinks = [
            ['id' => 1, 'menu_id' => 1, 'page_id' => 1, 'status' => '{"fr":"1","en":"1","nl":"1"}', 'title' => '{"fr":"Accueil","nl":"Home","en":"Home"}', 'url' => '{"fr":"","en":"","nl":""}', 'position' => 1, 'target' => '', 'class' => '', 'icon_class' => null, 'has_categories' => 0, 'created_at' => '2014-03-28 22:08:05', 'updated_at' => '2014-03-28 18:58:25'],
            ['id' => 2, 'menu_id' => 1, 'page_id' => 2, 'status' => '{"fr":"1","en":"1","nl":"1"}', 'title' => '{"fr":"Contact","nl":"Contact","en":"Contact"}', 'url' => '{"fr":"","en":"","nl":""}', 'position' => 2, 'target' => '', 'class' => '', 'icon_class' => null, 'has_categories' => 0, 'created_at' => '2014-03-28 23:18:49', 'updated_at' => '2014-03-28 18:58:25'],
            ['id' => 3, 'menu_id' => 2, 'page_id' => 2, 'status' => '{"fr":"1","en":"1","nl":"1"}', 'title' => '{"fr":"Contact","nl":"Contact","en":"Contact"}', 'url' => '{"fr":"","en":"","nl":""}', 'position' => 1, 'target' => '', 'class' => '', 'icon_class' => null, 'has_categories' => 0, 'created_at' => '2014-03-28 17:20:16', 'updated_at' => '2014-03-28 13:32:46'],
            ['id' => 4, 'menu_id' => 2, 'page_id' => 3, 'status' => '{"fr":"1","en":"1","nl":"1"}', 'title' => '{"fr":"Conditions d’utilisation","nl":"Gebruiksvoorwaarden","en":"Terms of use"}', 'url' => '{"fr":""}', 'position' => 2, 'target' => '', 'class' => '', 'icon_class' => null, 'has_categories' => 0, 'created_at' => '2014-03-28 17:20:43', 'updated_at' => '2014-03-28 17:31:37'],
            ['id' => 5, 'menu_id' => 3, 'page_id' => 0, 'status' => '{"fr":"1","en":"1","nl":"1"}', 'title' => '{"fr":"Facebook","nl":"Facebook","en":"Facebook"}', 'url' => '{"fr":"https://www.facebook.com","nl":"https://www.facebook.com","en":"https://www.facebook.com"}', 'position' => 1, 'target' => '_blank', 'class' => 'btn-facebook', 'icon_class' => 'fa fa-facebook fa-fw', 'has_categories' => 0, 'created_at' => '2014-03-28 18:30:11', 'updated_at' => '2014-03-28 18:30:17'],
            ['id' => 6, 'menu_id' => 3, 'page_id' => 0, 'status' => '{"fr":"1","en":"1","nl":"1"}', 'title' => '{"fr":"Twitter","en":"Twitter","nl":"Twitter"}', 'url' => '{"fr":"https://twitter.com","en":"https://twitter.com","nl":"https://twitter.com"}', 'position' => 2, 'target' => '_blank', 'class' => 'btn-twitter', 'icon_class' => 'fa fa-twitter fa-fw', 'has_categories' => 0, 'created_at' => '2014-03-28 18:31:35', 'updated_at' => '2014-03-28 18:31:47'],
        ];

        DB::table('menulinks')->insert($typi_menulinks);
    }
}
