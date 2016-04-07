<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => 'Le champ :attribute doit être accepté.',
    'active_url'           => 'Le champ :attribute n’est pas une URL valide.',
    'after'                => 'Le champ :attribute doit être une date postérieure au :date.',
    'alpha'                => 'Le champ :attribute doit seulement contenir des lettres.',
    'alpha_dash'           => 'Le champ :attribute doit seulement contenir des lettres, des chiffres et des tirets.',
    'alpha_num'            => 'Le champ :attribute doit seulement contenir des chiffres et des lettres.',
    'array'                => 'Le champ :attribute doit être un tableau.',
    'before'               => 'Le champ :attribute doit être une date antérieure au :date.',
    'between'              => [
        'numeric' => 'La valeur de :attribute doit être comprise entre :min et :max.',
        'file'    => 'Le fichier :attribute doit avoir une taille entre :min et :max kilobytes.',
        'string'  => 'Le texte :attribute doit avoir entre :min et :max caractères.',
        'array'   => 'Le champ :attribute doit avoir entre :min et :max éléments.',
    ],
    'boolean'              => 'Le champ :attribute doit true ou false',
    'confirmed'            => 'Le champ de confirmation :attribute ne correspond pas.',
    'date'                 => 'Le champ :attribute n’est pas une date valide.',
    'date_format'          => 'Le champ :attribute ne correspond pas au format :format.',
    'different'            => 'Les champs :attribute et :other doivent être différents.',
    'digits'               => 'Le champ :attribute doit avoir :digits chiffres.',
    'digits_between'       => 'Le champ :attribute doit avoir entre :min and :max chiffres.',
    'email'                => 'Le champ :attribute doit être une adresse email valide.',
    'filled'               => 'Le champ :attribute est requis.',
    'exists'               => 'Le champ :attribute sélectionné est invalide.',
    'image'                => 'Le champ :attribute doit être une image.',
    'in'                   => 'Le champ :attribute est invalide.',
    'integer'              => 'Le champ :attribute doit être un entier.',
    'ip'                   => 'Le champ :attribute doit être une adresse IP valide.',
    'max'                  => [
        'numeric' => 'La valeur de :attribute ne peut être supérieure à :max.',
        'file'    => 'Le fichier :attribute ne peut être plus gros que :max kilobytes.',
        'string'  => 'Le texte de :attribute ne peut contenir plus de :max caractères.',
        'array'   => 'Le champ :attribute ne peut avoir plus de :max éléments.',
    ],
    'mimes'                => 'Le champ :attribute doit être un fichier de type : :values.',
    'min'                  => [
        'numeric' => 'La valeur de :attribute doit être supérieure à :min.',
        'file'    => 'Le fichier :attribute doit être plus que gros que :min kilobytes.',
        'string'  => 'Le texte :attribute doit contenir au moins :min caractères.',
        'array'   => 'Le champ :attribute doit avoir au moins :min éléments.',
    ],
    'not_in'               => 'Le champ :attribute sélectionné n’est pas valide.',
    'numeric'              => 'Le champ :attribute doit contenir un nombre.',
    'regex'                => 'Le format du champ :attribute est invalide.',
    'required'             => 'Le champ :attribute est obligatoire.',
    'required_if'          => 'Le champ :attribute est obligatoire quand la valeur de :other est :value.',
    'required_with'        => 'Le champ :attribute est obligatoire quand :values est présent.',
    'required_with_all'    => 'Le champ :attribute est obligatoire quand :values est présent.',
    'required_without'     => 'Le champ :attribute est obligatoire quand :values n’est pas présent.',
    'required_without_all' => 'Le champ :attribute est requis quand aucun de :values n’est présent.',
    'same'                 => 'Les champs :attribute et :other doivent être identiques.',
    'size'                 => [
        'numeric' => 'La valeur de :attribute doit être :size.',
        'file'    => 'La taille du fichier de :attribute doit être de :size kilobytes.',
        'string'  => 'Le texte de :attribute doit contenir :size caractères.',
        'array'   => 'Le champ :attribute doit contenir :size éléments.',
    ],
    'unique'               => 'La valeur du champ :attribute est déjà utilisée.',
    'url'                  => 'Le format de l’URL de :attribute n’est pas valide.',
    'timezone'             => 'Le champ :attribute doit être une zone valide.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention 'attribute.rule' to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of 'email'. This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [
        // General
        'name'             => 'Nom',
        'username'         => 'Pseudo',
        'password'         => 'Mot de passe',
        'age'              => 'Age',
        'sex'              => 'Sexe',
        'gender'           => 'Genre',
        'day'              => 'Jour',
        'month'            => 'Mois',
        'year'             => 'Année',
        'hour'             => 'Heure',
        'minute'           => 'Minute',
        'second'           => 'Seconde',
        'title'            => 'Titre',
        'website_title'    => 'Titre du site',
        'content'          => 'Contenu',
        'description'      => 'Description',
        'excerpt'          => 'Extrait',
        'date'             => 'Date',
        'time'             => 'Heure',
        'available'        => 'Disponible',
        'size'             => 'Taille',
        'slug'             => 'Slug',
        'url'              => 'URL',
        'body'             => 'Corps',
        'meta_keywords'    => 'Meta mots clés',
        'meta_title'       => 'Meta titre',
        'meta_description' => 'Meta description',
        'summary'          => 'Résumé',
        'uri'              => 'URI',
        'online'           => 'En ligne',
        'status'           => 'Statut',
        'generate'         => 'Générer',

        // Contacts
        'created_at' => 'Créé le',
        'email'      => 'E-mail',
        'mr'         => 'M.',
        'mrs'        => 'Mme',
        'website'    => 'Site web',
        'first_name' => 'Prénom',
        'last_name'  => 'Nom',
        'company'    => 'Société',
        'city'       => 'Ville',
        'country'    => 'Pays',
        'address'    => 'Adresse',
        'postcode'   => 'Code postal',
        'phone'      => 'Téléphone',
        'mobile'     => 'Portable',
        'fax'        => 'Fax',
        'language'   => 'Langue',
        'message'    => 'Message',
        'send'       => 'Envoyer',

        // Pages
        'rss_enabled'               => 'Activer un flux RSS',
        'comments_enabled'          => 'Activer les commentaires',
        'private'                   => 'Privée',
        'is_home'                   => 'Définir en tant que page d’accueil',
        'redirect to first child'   => 'Rediriger vers le premier enfant',
        'don’t generate HTML cache' => 'Ne pas générer un cache HTML',
        'module'                    => 'Module',
        'template'                  => 'Template',
        'css'                       => 'Code CSS',
        'js'                        => 'Code JavaScript',
        'add_to_menu'               => 'Ajouter au menu',

        // Places
        'latitude'    => 'Latitude',
        'longitude'   => 'Longitude',
        'fax'         => 'Fax',
        'info'        => 'Info',
        'Show on map' => 'afficher sur la carte',
        'category_id' => 'Catégorie',
        'info'        => 'Informations complémentaires',

        // Partners
        'logo'     => 'Logo',
        'homepage' => 'Sur la page d’accueil',

        // Events
        'start_date'    => 'Date de début',
        'end_date'      => 'Date de fin',
        'start_time'    => 'Heure de début',
        'end_time'      => 'Heure de fin',
        'HH:MM'         => 'HH:MM',
        'DDMMYYYY'      => 'JJ.MM.AAAA',
        'DDMMYYYY HHMM' => 'JJ.MM.AAAA HH:MM',
        'location'      => 'Lieu',
        'venue'         => 'Lieu',
        'price'         => 'Prix',
        'currency'      => 'Devise',

        // Projects
        'category_id' => 'Catégorie',

        // Mots-clés
        'tags' => 'Tags',
        'tag'  => 'Tag',
        'uses' => 'Utilisations',

        // Menulinks
        'page_id'        => 'Page',
        'menu_id'        => 'Menu',
        'module_name'    => 'Module',
        'target'         => 'Cible',
        'class'          => 'Class',
        'icon_class'     => 'Class d’icône',
        'restricted_to'  => 'Restreint à',
        'link_type'      => 'Type de lien',
        'has_categories' => 'Afficher les catégories',
        'side'           => 'Côté',
        'Front office'   => 'Public',
        'Back office'    => 'Admin',

        // Users
        'first_name'            => 'Prénom',
        'last_name'             => 'Nom',
        'groups'                => 'Groupes',
        'roles'                 => 'Rôles',
        'email'                 => 'Email',
        'password'              => 'Mot de passe',
        'password_confirmation' => 'Confirmer le mot de passe',
        'reset password'        => 'Réinitialiser le mot de passe',
        'register'              => 'Créer le compte',
        'Change password'       => 'Modifier le mot de passe',
        'save'                  => 'Enregistrer',
        'save and exit'         => 'Enregistrer et sortir',
        'exit'                  => 'Sortir',
        'log in'                => 'Connexion',
        'modify'                => 'Modifier',
        'permissions'           => 'Permissions',
        'superuser'             => 'Super utilisateur',
        'activated'             => 'Activé',
        'getMergedPermissions'  => 'Permissions',

        // Settings
        'webmaster_email'       => 'Email du webmaster',
        'google_analytics_code' => 'Google Analytics Tracking Id',
        'lang_chooser'          => 'Page de choix de langue',
        'welcome_message'       => 'Message d’accueil de l’interface d’administration',
        'admin_locale'          => 'Langue de l’interface d’administration',
        'auth_public'           => 'Se connecter pour voir le site',
        'registration allowed'  => 'Permettre la création de comptes utilisateurs',

        // Galleries
        'galleries' => 'Galeries',

        // Translations
        'key'          => 'Clé',
        'translations' => 'Traduction',

        // Files
        'alt_attribute'    => 'Texte alternatif',
        'keywords'         => 'Mots-clés',
        'folder_id'        => 'ID Dossier',
        'user_id'          => 'ID Utilisateur',
        'type'             => 'Type',
        'position'         => 'Position',
        'name'             => 'Nom',
        'path'             => 'Chemin',
        'files'            => 'Fichiers',
        'filename'         => 'Nom du fichier',
        'extension'        => 'Extension',
        'mimetype'         => 'Type Mime',
        'width'            => 'Largeur',
        'height'           => 'Hauteur',
        'download_count'   => 'download_count',
        'file information' => 'Informations',
        'image'            => 'Image',
        'replace image'    => 'Remplacer l’image',
        'file'             => 'Fichier',
        'replace file'     => 'Remplacer le fichier',
        'max'              => 'Maximum',
        'max :size MB'     => 'Maximum :size Mo',
        'KB'               => 'Ko',
        'MB'               => 'Mo',
        'size (px)'        => 'Taille (px)',
        'preview'          => 'Prévisualisation',

        'Submit' => 'Envoyer',
        'Reset'  => 'Reinitialiser',
        'Cancel' => 'Annuler',
    ],

];
