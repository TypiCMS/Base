<?php


return array(

    /*
    |--------------------------------------------------------------------------
    | Session prefix name
    |--------------------------------------------------------------------------
    |
    | This will be used to prefix flash messages.
    |
    */
    'session_prefix'                       => 'notifications_',

    /*
    |--------------------------------------------------------------------------
    | Default container name
    |--------------------------------------------------------------------------
    |
    | This name will be used to name default container (when calling it with null value).
    |
    */
    'default_container'                     => 'default',

    /*
    |--------------------------------------------------------------------------
    | Default message format
    |--------------------------------------------------------------------------
    |
    | This format will be used when no format is specified.
    | Available place holders:
    |
    | :type - type of message (error, warning, info, success).
    | :message - message text.
    |
    */
    'default_format'                        => '<div class="alert alert-:type">:message</div>',

    /*
    |--------------------------------------------------------------------------
    | Default message formats for types and container types
    |--------------------------------------------------------------------------
    |
    | These formats can override default format for each type of message (error, warning, info, success).
    | You can set formats for each container by using this syntax:
    |
    | 'default_formats'         => array(
    |       'myContainer'   => array(
    |           'info'  => ':key - :message'
    |       )
    |   )
    |
    | If you want to set global formats for each type of message use same syntax just place them in array named '__'.
    |
    | Available place holders:
    |
    | :type - type of message (error, warning, info, success).
    | :message - message text.
    |
    */
    'default_formats'                       => array(

        /**
         * Default individual messages for all containers.
         */
        '__'                    => array(

        ),

    )

);
