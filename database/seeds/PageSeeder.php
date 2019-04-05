<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class PageSeeder extends Seeder
{
    public function run()
    {
        $typi_pages = [
            [
                'id' => 1,
                'image_id' => null,
                'position' => 1,
                'is_home' => 1,
                'css' => null,
                'js' => null,
                'template' => 'home',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'slug' => '{"fr":null,"en":null,"nl":null}',
                'uri' => '{"fr":null,"nl":null,"en":null}',
                'title' => '{"fr":"Accueil","nl":"Home","en":"Home"}',
                'body' => '{"fr":"<h1>Accueil</h1>","nl":"<h1>Home</h1>","en":"<h1>Home</h1>"}',
                'status' => '{"fr":"1","nl":"1","en":"1"}',
                'meta_description' => '{"fr":null,"nl":null,"en":null}',
                'meta_keywords' => '{"fr":null,"nl":null,"en":null}',
            ],
            [
                'id' => 2,
                'image_id' => null,
                'position' => 2,
                'is_home' => 0,
                'css' => null,
                'js' => null,
                'template' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'slug' => '{"fr":"contact","en":"contact","nl":"contact"}',
                'uri' => '{"fr":"contact","nl":"contact","en":"contact"}',
                'title' => '{"fr":"Contact","nl":"Contact","en":"Contact"}',
                'body' => '{"fr":"<h1>Contact</h1>","nl":"<h1>Contact</h1>","en":"<h1>Contact</h1>"}',
                'status' => '{"fr":"1","nl":"1","en":"1"}',
                'meta_description' => '{"fr":null,"nl":null,"en":null}',
                'meta_keywords' => '{"fr":null,"nl":null,"en":null}',
            ],
            [
                'id' => 3,
                'image_id' => null,
                'position' => 3,
                'is_home' => 0,
                'css' => null,
                'js' => null,
                'template' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'slug' => '{"fr":"conditions-d-utilisation","nl":"gebruiksvoorwaarden","en":"terms-of-use"}',
                'uri' => '{"fr":"conditions-d-utilisation","nl":"gebruiksvoorwaarden","en":"terms-of-use"}',
                'title' => '{"fr":"Conditions d’utilisation","nl":"Gebruiksvoorwaarden","en":"Terms of use"}',
                'body' => '{"fr":"<h1>Conditions d’utilisation</h1>","nl":"<h1>Gebruiksvoorwaarden</h1>","en":"<h1>Terms of use</h1>"}',
                'status' => '{"fr":"1","nl":"1","en":"1"}',
                'meta_description' => '{"fr":null,"nl":null,"en":null}',
                'meta_keywords' => '{"fr":null,"nl":null,"en":null}',
            ],
        ];

        DB::table('pages')->insert($typi_pages);
    }
}
