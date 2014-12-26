<?php

return array(

    /*
    |--------------------------------------------------------------------------
    | Rollbar Configuration
    |--------------------------------------------------------------------------
    |
    | Any values will be passed directly as configuration to the Rollbar
    | instance. For more information about the possible values check
    | out: https://rollbar.com/docs/notifier/rollbar-php
    |
    | Example: "access_token", "batch_size", "included_errno", "scrub_fields", ...
    |
    */

    'access_token' => getenv('ROLLBAR_TOKEN'),

);
