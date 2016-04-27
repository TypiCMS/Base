<?php

use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    public function run()
    {
        $typi_pages = [
            [
                'id' => '1',
                'meta_robots_no_index' => '',
                'meta_robots_no_follow' => '',
                'is_home' => '1',
                'css' => '',
                'js' => '',
                'template' => 'home',
                'created_at' => '2014-03-28 21:57:44',
                'updated_at' => '2014-03-28 20:26:35',
                'slug' => '{"fr":"","en":"","nl":""}',
                'uri' => '{"fr":"","nl":"","en":""}',
                'title' => '{"fr":"Accueil","nl":"Home","en":"Home"}',
                'body' => '{"fr":"<h1>Accueil</h1>","nl":"<h1>Home</h1>","en":"<h1>Home</h1>"}',
                'status' => '{"fr":"1","nl":"1","en":"1"}',
                'meta_description' => '{"fr":"","nl":"","en":""}',
                'meta_keywords' => '{"fr":"","nl":"","en":""}',
            ],
            [
                'id' => '2',
                'meta_robots_no_index' => '',
                'meta_robots_no_follow' => '',
                'is_home' => '0',
                'css' => '',
                'js' => '',
                'template' => '',
                'created_at' => '2014-03-28 21:52:13',
                'updated_at' => '2014-03-28 21:08:14',
                'slug' => '{"fr":"contact","en":"contact","nl":"contact"}',
                'uri' => '{"fr":"contact","nl":"contact","en":"contact"}',
                'title' => '{"fr":"Contact","nl":"Contact","en":"Contact"}',
                'body' => '{"fr":"<h1>Contact</h1>","nl":"<h1>Contact</h1>","en":"<h1>Contact</h1>"}',
                'status' => '{"fr":"1","nl":"1","en":"1"}',
                'meta_description' => '{"fr":"","nl":"","en":""}',
                'meta_keywords' => '{"fr":"","nl":"","en":""}',
            ],
            [
                'id' => '3',
                'meta_robots_no_index' => '',
                'meta_robots_no_follow' => '',
                'is_home' => '0',
                'css' => '',
                'js' => '',
                'template' => '',
                'created_at' => '2014-03-28 21:58:30',
                'updated_at' => '2014-03-28 20:59:15',
                'slug' => '{"fr":"conditions-d-utilisation","nl":"gebruiksvoorwaarden","en":"terms-of-use"}',
                'uri' => '{"fr":"conditions-d-utilisation","nl":"gebruiksvoorwaarden","en":"terms-of-use"}',
                'title' => '{"fr":"Conditions d’utilisation","nl":"Gebruiksvoorwaarden","en":"Terms of use"}',
                'body' => '{"fr":"<h1>Conditions d’utilisation</h1>","nl":"<h1>Gebruiksvoorwaarden</h1>","en":"<h1>Terms of use</h1>"}',
                'status' => '{"fr":"1","nl":"1","en":"1"}',
                'meta_description' => '{"fr":"","nl":"","en":""}',
                'meta_keywords' => '{"fr":"","nl":"","en":""}',
            ],
        ];

        DB::table('pages')->insert($typi_pages);
    }
}
