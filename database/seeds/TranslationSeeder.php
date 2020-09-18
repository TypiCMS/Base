<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class TranslationSeeder extends Seeder
{
    public function run()
    {
        $typi_translations = [
            ['id' => 1, 'translation' => '{"fr":"En savoir plus","en":"More","nl":"Meer"}', 'key' => 'More', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 2, 'translation' => '{"fr":"Aller au contenu","en":"Skip to content","nl":"Naar inhoud"}', 'key' => 'Skip to content', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 3, 'translation' => '{"fr":"Français","en":"Français","nl":"Français"}', 'key' => 'languages.fr', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 4, 'translation' => '{"fr":"English","en":"English","nl":"English"}', 'key' => 'languages.en', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 5, 'translation' => '{"fr":"Nederlands","en":"Nederlands","nl":"Nederlands"}', 'key' => 'languages.nl', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 6, 'translation' => '{"fr":"Chercher","en":"Search","nl":"Zoeken"}', 'key' => 'Search', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 7, 'translation' => '{"fr":"Merci","en":"Thank you","nl":"Dank u"}', 'key' => 'message when contact form is sent', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 8, 'translation' => '{"fr":"Veuillez s’il vous plaît corriger les erreurs ci-dessous","en":"Please correct the errors below","nl":"Gelieve de onderstaande fouten te corrigeren"}', 'key' => 'message when errors in form', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 9, 'translation' => '{"fr":"Ajouter au calendrier","en":"Add to calendar","nl":"Toevoegen aan Agenda"}', 'key' => 'Add to calendar', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 10, 'translation' => '{"fr":"Toutes les actualités","nl":"Alle nieuws","en":"All news"}', 'key' => 'All news', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 11, 'translation' => '{"fr":"Tous les événements","nl":"Alle evenementen","en":"All events"}', 'key' => 'All events', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 12, 'translation' => '{"fr":"Partenaires","nl":"Partners","en":"Partners"}', 'key' => 'Partners', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 13, 'translation' => '{"fr":"Dernières actualités","nl":"Laatste Nieuws","en":"Latest news"}', 'key' => 'Latest news', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 14, 'translation' => '{"fr":"Prochains événements","nl":"Aankomende evenementen","en":"Upcoming events"}', 'key' => 'Upcoming events', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 16, 'translation' => '{"fr":"Erreur :code","nl":"Error :code","en":"Error :code"}', 'key' => 'Error :code', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 17, 'translation' => '{"fr":"Désolé, vous n’êtes pas autorisé à voir cette page","nl":"Sorry, u bent niet bevoegd om deze pagina te bekijken","en":"Sorry, you are not authorized to view this page"}', 'key' => 'Sorry, you are not authorized to view this page', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 18, 'translation' => '{"fr":"Souhaitez-vous visiter notre :a_openpage d’accueil:a_close ?","nl":"Wilt u onze :a_openhomepage:a_close te bezoeken?","en":"Go to our :a_openhomepage:a_close?"}', 'key' => 'Go to our homepage?', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 19, 'translation' => '{"fr":"Désolé, cette page n’a pas été trouvée","nl":"Sorry, deze pagina is niet gevonden","en":"Sorry, this page was not found"}', 'key' => 'Sorry, this page was not found', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 20, 'translation' => '{"fr":"Désolé, une erreur serveur est survenue","nl":"Sorry, er is een serverfout opgetreden","en":"Sorry, a server error occurred"}', 'key' => 'Sorry, a server error occurred', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 21, 'translation' => '{"fr":"Aller à la navigation","nl":"Open navigatie","en":"Open navigation"}', 'key' => 'Open navigation', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ];

        DB::table('translations')->insert($typi_translations);
    }
}
