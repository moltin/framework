<?php

    // Load
    require '../vendor/autoload.php';
    
    // Load configs
    $config = require '../app/Config/config.php';
    $routes = require '../app/Config/routes.php';

    // Session
    session_cache_limiter(false);
    session_start();

    // Startup
    $app = new \SlimController\Slim([
        'mode'                       => $config['app_mode'],
        'debug'                      => $config['app_debug'],
        'cookies.lifetime'           => $config['app_cookie_ttl'],
        'cookies.secret_key'         => $config['app_cookie_secret'],
        'view'                       => new \Slim\Views\Twig(),
        'templates.path'             => '../app/Templates',
        'controller.class_prefix'    => '\\Controllers',
        'controller.method_suffix'   => 'Action',
        'controller.template_suffix' => 'php',
        'cookies.encrypt'            => true,
    ]);

    // Views
    $view                   = $app->view();
    $view->parserOptions    = ['debug' => $config['app_debug'], 'cache' => '../cache'];
    $view->parserExtensions = [new \Slim\Views\TwigExtension()];
    $view->setTemplatesDirectory('../app/Templates/');

    // Add global values
    $app->view->getEnvironment()->addGlobal('config', $config);

    // SDK
    $app->moltin = new \Moltin\SDK\SDK(new \Moltin\SDK\Storage\Session(), new \Moltin\SDK\Request\CURL());

    // SDK Authentication
    $app->moltin->authenticate(new \Moltin\SDK\Authenticate\ClientCredentials(), [
        'client_id'     => $config['api_client_id'],
        'client_secret' => $config['api_client_secret']
    ]);

    // Routes
    $app->addRoutes($routes);

    // GO!
    $app->run();
