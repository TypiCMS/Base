<?php

use Illuminate\Database\Seeder;

class TranslationSeeder extends Seeder
{
    public function run()
    {
        $typi_translations = [
            ['id' => '1', 'group' => 'db', 'translation' => '{"fr":"En savoir plus","en":"More","nl":"Meer"}', 'key' => 'More', 'created_at' => '2014-02-28 22:50:19', 'updated_at' => '2014-02-28 22:50:19'],
            ['id' => '2', 'group' => 'db', 'translation' => '{"fr":"Aller au contenu","en":"Skip to content","nl":"Naar inhoud"}', 'key' => 'Skip to content', 'created_at' => '2014-02-28 22:50:19', 'updated_at' => '2014-02-28 22:50:19'],
            ['id' => '3', 'group' => 'db', 'translation' => '{"fr":"Français","en":"Français","nl":"Français"}', 'key' => 'languages.fr', 'created_at' => '2014-02-28 22:50:19', 'updated_at' => '2014-02-28 22:50:19'],
            ['id' => '4', 'group' => 'db', 'translation' => '{"fr":"English","en":"English","nl":"English"}', 'key' => 'languages.en', 'created_at' => '2014-02-28 22:50:19', 'updated_at' => '2014-02-28 22:50:19'],
            ['id' => '5', 'group' => 'db', 'translation' => '{"fr":"Nederlands","en":"Nederlands","nl":"Nederlands"}', 'key' => 'languages.nl', 'created_at' => '2014-02-28 22:50:19', 'updated_at' => '2014-02-28 22:50:19'],
            ['id' => '6', 'group' => 'db', 'translation' => '{"fr":"Chercher","en":"Search","nl":"Zoeken"}', 'key' => 'Search', 'created_at' => '2014-02-28 22:50:19', 'updated_at' => '2014-02-28 22:50:19'],
            ['id' => '7', 'group' => 'db', 'translation' => '{"fr":"Merci pour votre demande de contact, elle sera traitée dans les meilleurs délais.","en":"Thank you for your contact request, it will be treated as soon as possible.","nl":"Bedankt voor uw contactaanvraag, het zal zo snel mogelijk worden behandeld."}', 'key' => 'message when contact form is sent', 'created_at' => '2014-02-28 22:50:19', 'updated_at' => '2014-02-28 22:50:19'],
            ['id' => '8', 'group' => 'db', 'translation' => '{"fr":"Veuillez s’il vous plaît corriger les erreurs ci-dessous","en":"Please correct the errors below","nl":"Gelieve de onderstaande fouten te corrigeren"}', 'key' => 'message when errors in form', 'created_at' => '2014-02-28 22:50:19', 'updated_at' => '2014-02-28 22:50:19'],
            ['id' => '9', 'group' => 'db', 'translation' => '{"fr":"Ajouter au calendrier","en":"Add to calendar","nl":"Toevoegen aan Agenda"}', 'key' => 'Add to calendar', 'created_at' => '2014-02-28 22:50:19', 'updated_at' => '2014-02-28 22:50:19'],
            ['id' => '10', 'group' => 'db', 'translation' => '{"fr":"Toutes les actualités","nl":"Alle nieuws","en":"All news"}', 'key' => 'All news', 'created_at' => '2014-02-28 15:39:28', 'updated_at' => '2014-02-28 15:39:28'],
            ['id' => '11', 'group' => 'db', 'translation' => '{"fr":"Tous les événements","nl":"Alle evenementen","en":"All events"}', 'key' => 'All events', 'created_at' => '2014-02-28 15:40:04', 'updated_at' => '2014-02-28 15:40:04'],
            ['id' => '12', 'group' => 'db', 'translation' => '{"fr":"Partenaires","nl":"Partners","en":"Partners"}', 'key' => 'Partners', 'created_at' => '2014-02-28 15:40:35', 'updated_at' => '2014-02-28 15:40:35'],
            ['id' => '13', 'group' => 'db', 'translation' => '{"fr":"Dernières actualités","nl":"Laatste Nieuws","en":"Latest news"}', 'key' => 'Latest news', 'created_at' => '2014-02-28 15:41:21', 'updated_at' => '2014-02-28 15:41:21'],
            ['id' => '14', 'group' => 'db', 'translation' => '{"fr":"Prochains événements","nl":"Aankomende evenementen","en":"Incoming events"}', 'key' => 'Incoming events', 'created_at' => '2014-02-28 15:41:54', 'updated_at' => '2014-02-28 15:41:54'],
            ['id' => '16', 'group' => 'db', 'translation' => '{"fr":"Erreur :code","nl":"Error :code","en":"Error :code"}', 'key' => 'Error :code', 'created_at' => '2014-02-28 16:35:45', 'updated_at' => '2014-02-28 16:35:45'],
            ['id' => '17', 'group' => 'db', 'translation' => '{"fr":"Désolé, vous n’êtes pas autorisé à voir cette page","nl":"Sorry, u bent niet bevoegd om deze pagina te bekijken","en":"Sorry, you are not authorized to view this page"}', 'key' => 'Sorry, you are not authorized to view this page', 'created_at' => '2014-02-28 16:38:43', 'updated_at' => '2014-02-28 16:38:43'],
            ['id' => '18', 'group' => 'db', 'translation' => '{"fr":"Souhaitez-vous visiter notre :a_openpage d’accueil:a_close ?","nl":"Wilt u onze :a_openhomepage:a_close te bezoeken?","en":"Go to our :a_openhomepage:a_close?"}', 'key' => 'Go to our homepage?', 'created_at' => '2014-02-28 16:40:40', 'updated_at' => '2014-02-28 16:40:40'],
            ['id' => '19', 'group' => 'db', 'translation' => '{"fr":"Désolé, cette page n’a pas été trouvée","nl":"Sorry, deze pagina is niet gevonden","en":"Sorry, this page was not found"}', 'key' => 'Sorry, this page was not found', 'created_at' => '2014-02-28 16:42:18', 'updated_at' => '2014-02-28 16:42:18'],
            ['id' => '20', 'group' => 'db', 'translation' => '{"fr":"Désolé, une erreur serveur est survenue","nl":"Sorry, er is een serverfout opgetreden","en":"Sorry, a server error occurred"}', 'key' => 'Sorry, a server error occurred', 'created_at' => '2014-02-28 16:44:46', 'updated_at' => '2014-02-28 16:44:46'],
            ['id' => '21', 'group' => 'db', 'translation' => '{"fr":"Aller à la navigation","nl":"Open navigatie","en":"Open navigation"}', 'key' => 'Open navigation', 'created_at' => '2016-02-15 16:44:46', 'updated_at' => '2016-02-15 16:44:46'],
            ['id' => '22', 'group' => 'db', 'translation' => '{"fr":"Fermer la navigation","nl":"Sluiten navigatie","en":"Close navigation"}', 'key' => 'Close navigation', 'created_at' => '2016-02-15 16:44:46', 'updated_at' => '2016-02-15 16:44:46'],
        ];

        DB::table('translations')->insert($typi_translations);
    }
}
