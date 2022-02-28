<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    false, // $matchHost
    [ // $staticRoutes
        '/_profiler' => [[['_route' => '_profiler_home', '_controller' => 'web_profiler.controller.profiler::homeAction'], null, null, null, true, false, null]],
        '/_profiler/search' => [[['_route' => '_profiler_search', '_controller' => 'web_profiler.controller.profiler::searchAction'], null, null, null, false, false, null]],
        '/_profiler/search_bar' => [[['_route' => '_profiler_search_bar', '_controller' => 'web_profiler.controller.profiler::searchBarAction'], null, null, null, false, false, null]],
        '/_profiler/phpinfo' => [[['_route' => '_profiler_phpinfo', '_controller' => 'web_profiler.controller.profiler::phpinfoAction'], null, null, null, false, false, null]],
        '/_profiler/open' => [[['_route' => '_profiler_open_file', '_controller' => 'web_profiler.controller.profiler::openAction'], null, null, null, false, false, null]],
        '/acceuil/back' => [[['_route' => 'acceuil_back', '_controller' => 'App\\Controller\\AcceuilBackController::index'], null, null, null, false, false, null]],
        '/acceuil' => [[['_route' => 'acceuil', '_controller' => 'App\\Controller\\AcceuilController::index'], null, null, null, false, false, null]],
        '/details.html.twig' => [[['_route' => 'app_details', '_controller' => 'App\\Controller\\DetailsController::index'], null, null, null, false, false, null]],
        '/hotel/list' => [[['_route' => 'listh', '_controller' => 'App\\Controller\\HotelController::list'], null, null, null, false, false, null]],
        '/hotel/add' => [[['_route' => 'addh', '_controller' => 'App\\Controller\\HotelController::add'], null, null, null, false, false, null]],
        '/reservation/list' => [[['_route' => 'listr', '_controller' => 'App\\Controller\\ReservationController::list'], null, null, null, false, false, null]],
        '/reservation/add' => [[['_route' => 'addr', '_controller' => 'App\\Controller\\ReservationController::add'], null, null, null, false, false, null]],
    ],
    [ // $regexpList
        0 => '{^(?'
                .'|/_(?'
                    .'|error/(\\d+)(?:\\.([^/]++))?(*:38)'
                    .'|wdt/([^/]++)(*:57)'
                    .'|profiler/([^/]++)(?'
                        .'|/(?'
                            .'|search/results(*:102)'
                            .'|router(*:116)'
                            .'|exception(?'
                                .'|(*:136)'
                                .'|\\.css(*:149)'
                            .')'
                        .')'
                        .'|(*:159)'
                    .')'
                .')'
                .'|/hotel/(?'
                    .'|de(?'
                        .'|lete/([^/]++)(*:197)'
                        .'|tails/([^/]++)(*:219)'
                    .')'
                    .'|update/([^/]++)(*:243)'
                .')'
                .'|/reservation/(?'
                    .'|delete/([^/]++)(*:283)'
                    .'|update/([^/]++)(*:306)'
                .')'
            .')/?$}sD',
    ],
    [ // $dynamicRoutes
        38 => [[['_route' => '_preview_error', '_controller' => 'error_controller::preview', '_format' => 'html'], ['code', '_format'], null, null, false, true, null]],
        57 => [[['_route' => '_wdt', '_controller' => 'web_profiler.controller.profiler::toolbarAction'], ['token'], null, null, false, true, null]],
        102 => [[['_route' => '_profiler_search_results', '_controller' => 'web_profiler.controller.profiler::searchResultsAction'], ['token'], null, null, false, false, null]],
        116 => [[['_route' => '_profiler_router', '_controller' => 'web_profiler.controller.router::panelAction'], ['token'], null, null, false, false, null]],
        136 => [[['_route' => '_profiler_exception', '_controller' => 'web_profiler.controller.exception_panel::body'], ['token'], null, null, false, false, null]],
        149 => [[['_route' => '_profiler_exception_css', '_controller' => 'web_profiler.controller.exception_panel::stylesheet'], ['token'], null, null, false, false, null]],
        159 => [[['_route' => '_profiler', '_controller' => 'web_profiler.controller.profiler::panelAction'], ['token'], null, null, false, true, null]],
        197 => [[['_route' => 'deleteh', '_controller' => 'App\\Controller\\HotelController::delete'], ['id'], null, null, false, true, null]],
        219 => [[['_route' => 'details', '_controller' => 'App\\Controller\\HotelController::details'], ['id'], null, null, false, true, null]],
        243 => [[['_route' => 'updateh', '_controller' => 'App\\Controller\\HotelController::update'], ['id'], null, null, false, true, null]],
        283 => [[['_route' => 'deleter', '_controller' => 'App\\Controller\\ReservationController::delete'], ['id'], null, null, false, true, null]],
        306 => [
            [['_route' => 'updater', '_controller' => 'App\\Controller\\ReservationController::update'], ['id'], null, null, false, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
