<?php

    $environment = 'development'; 

    return [

        'app_name'          => 'Moltin',

        'app_mode'          => $environment,
        'app_debug'         => ( $environment == 'development' ? true : false ),

        'app_per_page'      => 15,

        'app_cookie_ttl'    => '20 minutes',
        'app_cookie_secret' => '',

        'api_client_id'     => 'umRG34nxZVGIuCSPfYf8biBSvtABgTR8GMUtflyE',
        'api_client_secret' => 'W0EMkTVKgfWOn88Z17ZAHVPaS9UVUEGVPou78GiI',

        'moltin_api_url'        => ( $environment == 'development' ? 'http://api.dev.molt.in/' : 'https://api.molt.in/' ),
        'moltin_api_auth_url'   => ( $environment == 'development' ? 'http://api.dev.molt.in/' : 'https://auth.molt.in/' ),
        'moltin_api_version'    => ( $environment == 'development' ? 'v1' : 'v1' ),

    ];