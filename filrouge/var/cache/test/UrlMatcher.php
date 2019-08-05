<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    false, // $matchHost
    [ // $staticRoutes
        '/api/partenaire' => [[['_route' => 'partenaire', '_controller' => 'App\\Controller\\PartenaireController::index'], null, null, null, false, false, null]],
        '/api/ajoutcompt' => [[['_route' => 'compt', '_controller' => 'App\\Controller\\PartenaireController::ajoutcompt'], null, null, null, false, false, null]],
        '/api/depot' => [[['_route' => 'depot', '_controller' => 'App\\Controller\\PartenaireController::depot'], null, ['POST' => 0], null, false, false, null]],
        '/api/register' => [[['_route' => 'register', '_controller' => 'App\\Controller\\SecurityController::register'], null, ['POST' => 0], null, false, false, null]],
        '/api/login' => [[['_route' => 'login', '_controller' => 'App\\Controller\\SecurityController::login'], null, ['POST' => 0], null, false, false, null]],
        '/api/ajoutpart' => [[['_route' => 'ajoutpart', '_controller' => 'App\\Controller\\SecurityController::ajoutpart'], null, ['POST' => 0], null, false, false, null]],
        '/api/ajoutpartuser' => [[['_route' => 'ajoutpartuser', '_controller' => 'App\\Controller\\SecurityController::ajoutpartuser'], null, ['POST' => 0], null, false, false, null]],
        '/api/login_check' => [[['_route' => 'api_login_check'], null, null, null, false, false, null]],
    ],
    [ // $regexpList
    ],
    [ // $dynamicRoutes
    ],
    null, // $checkCondition
];
