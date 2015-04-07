<?php

use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    public function run()
    {

        $typi_pages = array(
            array('id' => '1','meta_robots_no_index' => '','meta_robots_no_follow' => '','is_home' => '1','css' => '','js' => '','template' => 'home','created_at' => '2013-09-03 21:57:44','updated_at' => '2013-09-11 20:26:35'),
            array('id' => '2','meta_robots_no_index' => '','meta_robots_no_follow' => '','is_home' => '0','css' => '','js' => '','template' => '','created_at' => '2013-09-09 21:52:13','updated_at' => '2013-09-11 21:08:14'),
            array('id' => '3','meta_robots_no_index' => '','meta_robots_no_follow' => '','is_home' => '0','css' => '','js' => '','template' => '','created_at' => '2013-09-03 21:58:30','updated_at' => '2013-09-11 20:59:15'),
        );

        $typi_page_translations = array(
            array('id' => '1','page_id' => '1','locale' => 'fr','slug' => 'accueil', 'uri' => 'fr/accueil', 'title' => 'Accueil','body' => '<h1>Accueil</h1>','status' => '1','meta_title' => '','meta_keywords' => '','meta_description' => '','created_at' => '1900-01-01 00:00:00','updated_at' => '1900-01-01 00:00:00'),
            array('id' => '2','page_id' => '1','locale' => 'nl','slug' => 'home', 'uri' => 'nl/home', 'title' => 'Home','body' => '<h1>Home</h1>','status' => '1','meta_title' => '','meta_keywords' => '','meta_description' => '','created_at' => '1900-01-01 00:00:00','updated_at' => '1900-01-01 00:00:00'),
            array('id' => '3','page_id' => '1','locale' => 'en','slug' => 'home', 'uri' => 'en/home', 'title' => 'Home','body' => '<h1>Home</h1>','status' => '1','meta_title' => '','meta_keywords' => '','meta_description' => '','created_at' => '1900-01-01 00:00:00','updated_at' => '1900-01-01 00:00:00'),
            array('id' => '4','page_id' => '2','locale' => 'fr','slug' => 'contact', 'uri' => 'fr/contact', 'title' => 'Contact','body' => '<h1>Contact</h1>','status' => '1','meta_title' => '','meta_keywords' => '','meta_description' => '','created_at' => '1900-01-01 00:00:00','updated_at' => '1900-01-01 00:00:00'),
            array('id' => '5','page_id' => '2','locale' => 'nl','slug' => 'contact', 'uri' => 'nl/contact', 'title' => 'Contact','body' => '<h1>Contact</h1>','status' => '1','meta_title' => '','meta_keywords' => '','meta_description' => '','created_at' => '1900-01-01 00:00:00','updated_at' => '1900-01-01 00:00:00'),
            array('id' => '6','page_id' => '2','locale' => 'en','slug' => 'contact', 'uri' => 'en/contact', 'title' => 'Contact','body' => '<h1>Contact</h1>','status' => '1','meta_title' => '','meta_keywords' => '','meta_description' => '','created_at' => '1900-01-01 00:00:00','updated_at' => '1900-01-01 00:00:00'),
            array('id' => '7','page_id' => '3','locale' => 'fr','slug' => 'conditions-d-utilisation', 'uri' => 'fr/conditions-d-utilisation', 'title' => 'Conditions d’utilisation','body' => '<h1>Conditions d’utilisation</h1>','status' => '1','meta_title' => '','meta_keywords' => '','meta_description' => '','created_at' => '1900-01-01 00:00:00','updated_at' => '1900-01-01 00:00:00'),
            array('id' => '8','page_id' => '3','locale' => 'nl','slug' => 'gebruiksvoorwaarden', 'uri' => 'nl/gebruiksvoorwaarden', 'title' => 'Gebruiksvoorwaarden','body' => '<h1>Gebruiksvoorwaarden</h1>','status' => '1','meta_title' => '','meta_keywords' => '','meta_description' => '','created_at' => '1900-01-01 00:00:00','updated_at' => '1900-01-01 00:00:00'),
            array('id' => '9','page_id' => '3','locale' => 'en','slug' => 'terms-of-use', 'uri' => 'en/terms-of-use', 'title' => 'Terms of use','body' => '<h1>Terms of use</h1>','status' => '1','meta_title' => '','meta_keywords' => '','meta_description' => '','created_at' => '1900-01-01 00:00:00','updated_at' => '1900-01-01 00:00:00'),
        );

        DB::table('pages')->insert( $typi_pages );
        DB::table('page_translations')->insert( $typi_page_translations );

    }

}
