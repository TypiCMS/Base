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
    'session_prefix'                        => 'notifications_',

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
    | Specify default format for each container.
    | Available place holders:
    |
    | :type - type of message (error, warning, info, success).
    | :message - message text.
    |
    */
    'default_format'                        => array(

        'default'               => '<div class="alert alert-:type">:message</div>',

    ),

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
    | Available place holders:
    |
    | :type - type of message (error, warning, info, success).
    | :message - message text.
    |
    */
    'default_formats'                       => array(

        'default'               => array(
            'error'             => '<div class="alert alert-danger">:message</div>'
        ),

    ),

    /*
    |--------------------------------------------------------------------------
    | Default message types available in containers
    |--------------------------------------------------------------------------
    |
    | Specify available types for each container.
    |
    */
    'default_types'                         => array(

        'default'               => array('info', 'success', 'warning', 'error'),

    ),

);
