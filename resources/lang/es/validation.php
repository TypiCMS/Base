<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | such as the size rules. Feel free to tweak each of these messages.
    |
    */
    'accepted'             => ':attribute debe ser aceptado.',
    'active_url'           => ':attribute no es una URL válida.',
    'after'                => ':attribute debe ser una fecha posterior a :date.',
    'alpha'                => ':attribute solo debe contener letras.',
    'alpha_dash'           => ':attribute solo debe contener letras, números y guiones.',
    'alpha_num'            => ':attribute solo debe contener letras y números.',
    'array'                => ':attribute debe ser un conjunto.',
    'before'               => ':attribute debe ser una fecha anterior a :date.',
    'between'              => [
        'numeric' => ':attribute tiene que estar entre :min - :max.',
        'file'    => ':attribute debe pesar entre :min - :max kilobytes.',
        'string'  => ':attribute tiene que tener entre :min - :max caracteres.',
        'array'   => ':attribute tiene que tener entre :min - :max ítems.',
    ],
    'boolean'              => 'El campo :attribute debe tener un valor verdadero o falso.',
    'confirmed'            => 'La confirmación de :attribute no coincide.',
    'date'                 => ':attribute no es una fecha válida.',
    'date_format'          => ':attribute no corresponde al formato :format.',
    'different'            => ':attribute y :other deben ser diferentes.',
    'digits'               => ':attribute debe tener :digits dígitos.',
    'digits_between'       => ':attribute debe tener entre :min y :max dígitos.',
    'dimensions'           => 'Las dimensiones de la imagen :attribute no son validas.',
    'distinct'             => 'El campo :attribute contiene un valor duplicado.',
    'email'                => ':attribute no es un correo válido',
    'exists'               => ':attribute es inválido.',
    'filled'               => 'El campo :attribute es obligatorio.',
    'image'                => ':attribute debe ser una imagen.',
    'in'                   => ':attribute es inválido.',
    'in_array'             => 'El campo :attribute no existe en :other.',
    'integer'              => ':attribute debe ser un número entero.',
    'ip'                   => ':attribute debe ser una dirección IP válida.',
    'json'                 => 'El campo :attribute debe tener una cadena JSON válida.',
    'max'                  => [
        'numeric' => ':attribute no debe ser mayor a :max.',
        'file'    => ':attribute no debe ser mayor que :max kilobytes.',
        'string'  => ':attribute no debe ser mayor que :max caracteres.',
        'array'   => ':attribute no debe tener más de :max elementos.',
    ],
    'mimes'                => ':attribute debe ser un archivo con formato: :values.',
    'min'                  => [
        'numeric' => 'El tamaño de :attribute debe ser de al menos :min.',
        'file'    => 'El tamaño de :attribute debe ser de al menos :min kilobytes.',
        'string'  => ':attribute debe contener al menos :min caracteres.',
        'array'   => ':attribute debe tener al menos :min elementos.',
    ],
    'not_in'               => ':attribute es inválido.',
    'numeric'              => ':attribute debe ser numérico.',
    'present'              => 'El campo :attribute debe estar presente.',
    'regex'                => 'El formato de :attribute es inválido.',
    'required'             => 'El campo :attribute es obligatorio.',
    'required_if'          => 'El campo :attribute es obligatorio cuando :other es :value.',
    'required_unless'      => 'El campo :attribute es obligatorio a menos que :other esté en :values.',
    'required_with'        => 'El campo :attribute es obligatorio cuando :values está presente.',
    'required_with_all'    => 'El campo :attribute es obligatorio cuando :values está presente.',
    'required_without'     => 'El campo :attribute es obligatorio cuando :values no está presente.',
    'required_without_all' => 'El campo :attribute es obligatorio cuando ninguno de :values estén presentes.',
    'same'                 => ':attribute y :other deben coincidir.',
    'size'                 => [
        'numeric' => 'El tamaño de :attribute debe ser :size.',
        'file'    => 'El tamaño de :attribute debe ser :size kilobytes.',
        'string'  => ':attribute debe contener :size caracteres.',
        'array'   => ':attribute debe contener :size elementos.',
    ],
    'string'               => 'El campo :attribute debe ser una cadena de caracteres.',
    'timezone'             => 'El :attribute debe ser una zona válida.',
    'unique'               => ':attribute ya ha sido registrado.',
    'url'                  => 'El formato :attribute es inválido.',
    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */
    'custom'               => [
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
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [
        // General
        'name'             => 'Nombre',
        'username'         => 'Nombre de usuario',
        'password'         => 'Contraseña',
        'age'              => 'Edad',
        'sex'              => 'Sexo',
        'gender'           => 'Género',
        'day'              => 'Día',
        'month'            => 'Mes',
        'year'             => 'Año',
        'hour'             => 'Hora',
        'minute'           => 'Minuto',
        'second'           => 'Segundo',
        'title'            => 'Título',
        'website_title'    => 'Título de la web',
        'content'          => 'Contenido',
        'description'      => 'Descripción',
        'excerpt'          => 'Extracto',
        'date'             => 'Fecha',
        'time'             => 'Hora',
        'available'        => 'Disponible',
        'size'             => 'Tamañao',
        'slug'             => 'Slug',
        'url'              => 'URL',
        'body'             => 'Contenido principal',
        'meta_keywords'    => 'Meta keywords',
        'meta_title'       => 'Meta title',
        'meta_description' => 'Meta description',
        'summary'          => 'Resumen',
        'uri'              => 'Uri',
        'online'           => 'Conectado',
        'status'           => 'Estado',
        'generate'         => 'Generar',

        // Contacts
        'created_at' => 'Creado el',
        'email'      => 'Email',
        'mr'         => 'Sr',
        'mrs'        => 'Sra',
        'website'    => 'Sitio Web',
        'first_name' => 'Nombre',
        'last_name'  => 'Apellidos',
        'company'    => 'Empresa',
        'city'       => 'Ciudad',
        'country'    => 'País',
        'address'    => 'Dirección',
        'postcode'   => 'Código Postal',
        'phone'      => 'Teléfono',
        'mobile'     => 'Móvil',
        'fax'        => 'Fax',
        'language'   => 'Idioma',
        'message'    => 'Mensaje',
        'send'       => 'Enviar',

        // Pages
        'rss_enabled'               => 'Rss habilitado',
        'comments_enabled'          => 'Comentarios habilitados',
        'private'                   => 'Privado',
        'is_home'                   => 'Es inicio',
        'redirect to first child'   => 'Redireccionar al primer hijo',
        'don’t generate HTML cache' => 'No generar HTML cache',
        'module'                    => 'Módulo',
        'template'                  => 'Plantilla',
        'css'                       => 'CSS',
        'js'                        => 'JavaScript',
        'add_to_menu'               => 'Añadir al menú',

        // Places
        'latitude'    => 'Latitud',
        'longitude'   => 'Longitud',
        'fax'         => 'Fax',
        'info'        => 'Información',
        'Show on map' => 'Mostrar en el mapa',
        'category_id' => 'Categoría',
        'info'        => 'Información',

        // Partners
        'logo'     => 'Logo',
        'homepage' => 'En página de inicio',

        // Events
        'start_date'    => 'Fecha de inicio',
        'end_date'      => 'Fecha de finalización',
        'start_time'    => 'Hora de inicio',
        'end_time'      => 'Hora de finalización',
        'HH:MM'         => 'HH:MM',
        'DDMMYYYY'      => 'DD.MM.YYYY',
        'DDMMYYYY HHMM' => 'DD.MM.YYYY HH:MM',
        'location'      => 'Ubicación',
        'venue'         => 'Ubicación',
        'price'         => 'Precio',
        'currency'      => 'Moneda',

        // Projects
        'category_id' => 'Categoría',

        // Mots-clés
        'tags' => 'Etiquetas',
        'tag'  => 'Etiqueta',
        'uses' => 'Usos',

        // Menulinks
        'page_id'        => 'Página',
        'menu_id'        => 'Menú',
        'module_name'    => 'Nombre del módulo',
        'target'         => 'Objetivo',
        'class'          => 'Clase',
        'icon_class'     => 'Clase de icono',
        'restricted_to'  => 'Restringido a',
        'link_type'      => 'Tipo de enlace',
        'has_categories' => 'Mostrar categorías',
        'side'           => 'Lado',
        'Front office'   => 'Front office',
        'Back office'    => 'Back office',

        // Users
        'first_name'            => 'Nombre',
        'last_name'             => 'Apellidos',
        'groups'                => 'Grupos',
        'roles'                 => 'Roles',
        'email'                 => 'Email',
        'password'              => 'Contraseña',
        'password_confirmation' => 'Confirmación de contraseña',
        'reset password'        => 'Restablecer contraseña',
        'register'              => 'Registrar',
        'Change password'       => 'Cambiar contraseña',
        'save'                  => 'Guardar',
        'save and exit'         => 'Guardar y salir',
        'exit'                  => 'Salir',
        'log in'                => 'Acceder',
        'modify'                => 'Modicar',
        'permissions'           => 'Permisos',
        'superuser'             => 'Superusuario',
        'activated'             => 'Activado',
        'getMergedPermissions'  => 'Obtener permisos fusionados',

        // Settings
        'webmaster_email'       => 'Email del Maestro de la Web',
        'google_analytics_code' => 'Google Analytics ID',
        'google_tag_manager_id' => 'Google Tag Manager ID',
        'lang_chooser'          => 'Selector de idioma',
        'welcome_message'       => 'Administration welcome message',
        'admin_locale'          => 'Idioma de la administración',
        'auth_public'           => 'Autenticarse para ver la web',
        'registration allowed'  => 'Registro permitido',

        // Galleries
        'galleries' => 'Galerías',

        // Translations
        'key'          => 'Clave',
        'translations' => 'Traducciones',

        // Files
        'alt_attribute'    => 'Alt attribute',
        'keywords'         => 'Palabras clave',
        'folder_id'        => 'Carpeta',
        'user_id'          => 'Usuario',
        'type'             => 'Tipo',
        'position'         => 'Posición',
        'name'             => 'Nombre',
        'path'             => 'Ruta',
        'files'            => 'Archivos',
        'filename'         => 'Nombre de archivo',
        'extension'        => 'Extensión',
        'mimetype'         => 'Tipo Mime',
        'width'            => 'Anchura',
        'height'           => 'Altura',
        'download_count'   => 'Número de descargas',
        'file information' => 'Información del archivo',
        'image'            => 'Imagen',
        'replace image'    => 'Reemplazar imagen',
        'file'             => 'Archivo',
        'replace file'     => 'Reemplazar archivo',
        'max'              => 'Máximo',
        'max :size MB'     => 'Máximo :size MB',
        'KB'               => 'KB',
        'MB'               => 'MB',
        'size (px)'        => 'Tamaño (px)',
        'preview'          => 'Previsualizar',

        'Submit' => 'Enviar',
        'Reset'  => 'Resetear',
        'Cancel' => 'Cancelar',
    ],

];
