<?php

// This file has been auto-generated by the Symfony Routing Component.

return [
    '_preview_error' => [['code', '_format'], ['_controller' => 'error_controller::preview', '_format' => 'html'], ['code' => '\\d+'], [['variable', '.', '[^/]++', '_format'], ['variable', '/', '\\d+', 'code'], ['text', '/_error']], [], []],
    '_wdt' => [['token'], ['_controller' => 'web_profiler.controller.profiler::toolbarAction'], [], [['variable', '/', '[^/]++', 'token'], ['text', '/_wdt']], [], []],
    '_profiler_home' => [[], ['_controller' => 'web_profiler.controller.profiler::homeAction'], [], [['text', '/_profiler/']], [], []],
    '_profiler_search' => [[], ['_controller' => 'web_profiler.controller.profiler::searchAction'], [], [['text', '/_profiler/search']], [], []],
    '_profiler_search_bar' => [[], ['_controller' => 'web_profiler.controller.profiler::searchBarAction'], [], [['text', '/_profiler/search_bar']], [], []],
    '_profiler_phpinfo' => [[], ['_controller' => 'web_profiler.controller.profiler::phpinfoAction'], [], [['text', '/_profiler/phpinfo']], [], []],
    '_profiler_search_results' => [['token'], ['_controller' => 'web_profiler.controller.profiler::searchResultsAction'], [], [['text', '/search/results'], ['variable', '/', '[^/]++', 'token'], ['text', '/_profiler']], [], []],
    '_profiler_open_file' => [[], ['_controller' => 'web_profiler.controller.profiler::openAction'], [], [['text', '/_profiler/open']], [], []],
    '_profiler' => [['token'], ['_controller' => 'web_profiler.controller.profiler::panelAction'], [], [['variable', '/', '[^/]++', 'token'], ['text', '/_profiler']], [], []],
    '_profiler_router' => [['token'], ['_controller' => 'web_profiler.controller.router::panelAction'], [], [['text', '/router'], ['variable', '/', '[^/]++', 'token'], ['text', '/_profiler']], [], []],
    '_profiler_exception' => [['token'], ['_controller' => 'web_profiler.controller.exception_panel::body'], [], [['text', '/exception'], ['variable', '/', '[^/]++', 'token'], ['text', '/_profiler']], [], []],
    '_profiler_exception_css' => [['token'], ['_controller' => 'web_profiler.controller.exception_panel::stylesheet'], [], [['text', '/exception.css'], ['variable', '/', '[^/]++', 'token'], ['text', '/_profiler']], [], []],
    'acceuil_back' => [[], ['_controller' => 'App\\Controller\\AcceuilBackController::index'], [], [['text', '/acceuil/back']], [], []],
    'acceuil' => [[], ['_controller' => 'App\\Controller\\AcceuilController::index'], [], [['text', '/acceuil']], [], []],
    'app_details' => [[], ['_controller' => 'App\\Controller\\DetailsController::index'], [], [['text', '/details.html.twig']], [], []],
    'listh' => [[], ['_controller' => 'App\\Controller\\HotelController::list'], [], [['text', '/hotel/list']], [], []],
    'deleteh' => [['id'], ['_controller' => 'App\\Controller\\HotelController::delete'], [], [['variable', '/', '[^/]++', 'id'], ['text', '/hotel/delete']], [], []],
    'updateh' => [['id'], ['_controller' => 'App\\Controller\\HotelController::update'], [], [['variable', '/', '[^/]++', 'id'], ['text', '/hotel/update']], [], []],
    'addh' => [[], ['_controller' => 'App\\Controller\\HotelController::add'], [], [['text', '/hotel/add']], [], []],
    'details' => [['id'], ['_controller' => 'App\\Controller\\HotelController::details'], [], [['variable', '/', '[^/]++', 'id'], ['text', '/hotel/details']], [], []],
    'listr' => [[], ['_controller' => 'App\\Controller\\ReservationController::list'], [], [['text', '/reservation/list']], [], []],
    'deleter' => [['id'], ['_controller' => 'App\\Controller\\ReservationController::delete'], [], [['variable', '/', '[^/]++', 'id'], ['text', '/reservation/delete']], [], []],
    'updater' => [['id'], ['_controller' => 'App\\Controller\\ReservationController::update'], [], [['variable', '/', '[^/]++', 'id'], ['text', '/reservation/update']], [], []],
    'addr' => [[], ['_controller' => 'App\\Controller\\ReservationController::add'], [], [['text', '/reservation/add']], [], []],
];
