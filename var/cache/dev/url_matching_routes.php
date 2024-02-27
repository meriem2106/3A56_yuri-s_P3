<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    false, // $matchHost
    [ // $staticRoutes
        '/hotel/Collaboration' => [[['_route' => 'test_page', '_controller' => 'App\\Controller\\HotelController::testPage'], null, null, null, false, false, null]],
        '/hotel' => [[['_route' => 'app_hotel_index', '_controller' => 'App\\Controller\\HotelController::index'], null, ['GET' => 0], null, true, false, null]],
        '/hotel/new' => [[['_route' => 'app_hotel_new', '_controller' => 'App\\Controller\\HotelController::new'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/maison' => [[['_route' => 'app_maison_index', '_controller' => 'App\\Controller\\MaisonController::index'], null, ['GET' => 0], null, true, false, null]],
        '/maison/new' => [[['_route' => 'app_maison_new', '_controller' => 'App\\Controller\\MaisonController::new'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/reservation/h' => [[['_route' => 'app_reservation_h_index', '_controller' => 'App\\Controller\\ReservationHController::index'], null, ['GET' => 0], null, true, false, null]],
        '/reservation/h/new' => [[['_route' => 'app_reservation_h_new', '_controller' => 'App\\Controller\\ReservationHController::new'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/reservation/m' => [[['_route' => 'app_reservation_m_index', '_controller' => 'App\\Controller\\ReservationMController::index'], null, ['GET' => 0], null, true, false, null]],
        '/reservation/m/new' => [[['_route' => 'app_reservation_m_new', '_controller' => 'App\\Controller\\ReservationMController::new'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/_profiler' => [[['_route' => '_profiler_home', '_controller' => 'web_profiler.controller.profiler::homeAction'], null, null, null, true, false, null]],
        '/_profiler/search' => [[['_route' => '_profiler_search', '_controller' => 'web_profiler.controller.profiler::searchAction'], null, null, null, false, false, null]],
        '/_profiler/search_bar' => [[['_route' => '_profiler_search_bar', '_controller' => 'web_profiler.controller.profiler::searchBarAction'], null, null, null, false, false, null]],
        '/_profiler/phpinfo' => [[['_route' => '_profiler_phpinfo', '_controller' => 'web_profiler.controller.profiler::phpinfoAction'], null, null, null, false, false, null]],
        '/_profiler/open' => [[['_route' => '_profiler_open_file', '_controller' => 'web_profiler.controller.profiler::openAction'], null, null, null, false, false, null]],
        '/' => [[['_route' => 'app_first', '_controller' => 'App\\Controller\\HotelController::indexa'], null, null, null, false, false, null]],
    ],
    [ // $regexpList
        0 => '{^(?'
                .'|/hotel/([^/]++)(?'
                    .'|(*:25)'
                    .'|/edit(*:37)'
                    .'|(*:44)'
                .')'
                .'|/maison/([^/]++)(?'
                    .'|(*:71)'
                    .'|/edit(*:83)'
                    .'|(*:90)'
                .')'
                .'|/reservation/(?'
                    .'|h/([^/]++)(?'
                        .'|(*:127)'
                        .'|/edit(*:140)'
                        .'|(*:148)'
                    .')'
                    .'|m/([^/]++)(?'
                        .'|(*:170)'
                        .'|/edit(*:183)'
                        .'|(*:191)'
                    .')'
                .')'
                .'|/_(?'
                    .'|error/(\\d+)(?:\\.([^/]++))?(*:232)'
                    .'|wdt/([^/]++)(*:252)'
                    .'|profiler/([^/]++)(?'
                        .'|/(?'
                            .'|search/results(*:298)'
                            .'|router(*:312)'
                            .'|exception(?'
                                .'|(*:332)'
                                .'|\\.css(*:345)'
                            .')'
                        .')'
                        .'|(*:355)'
                    .')'
                .')'
            .')/?$}sDu',
    ],
    [ // $dynamicRoutes
        25 => [[['_route' => 'app_hotel_show', '_controller' => 'App\\Controller\\HotelController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        37 => [[['_route' => 'app_hotel_edit', '_controller' => 'App\\Controller\\HotelController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        44 => [[['_route' => 'app_hotel_delete', '_controller' => 'App\\Controller\\HotelController::delete'], ['id'], ['POST' => 0], null, false, true, null]],
        71 => [[['_route' => 'app_maison_show', '_controller' => 'App\\Controller\\MaisonController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        83 => [[['_route' => 'app_maison_edit', '_controller' => 'App\\Controller\\MaisonController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        90 => [[['_route' => 'app_maison_delete', '_controller' => 'App\\Controller\\MaisonController::delete'], ['id'], ['POST' => 0], null, false, true, null]],
        127 => [[['_route' => 'app_reservation_h_show', '_controller' => 'App\\Controller\\ReservationHController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        140 => [[['_route' => 'app_reservation_h_edit', '_controller' => 'App\\Controller\\ReservationHController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        148 => [[['_route' => 'app_reservation_h_delete', '_controller' => 'App\\Controller\\ReservationHController::delete'], ['id'], ['POST' => 0], null, false, true, null]],
        170 => [[['_route' => 'app_reservation_m_show', '_controller' => 'App\\Controller\\ReservationMController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        183 => [[['_route' => 'app_reservation_m_edit', '_controller' => 'App\\Controller\\ReservationMController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        191 => [[['_route' => 'app_reservation_m_delete', '_controller' => 'App\\Controller\\ReservationMController::delete'], ['id'], ['POST' => 0], null, false, true, null]],
        232 => [[['_route' => '_preview_error', '_controller' => 'error_controller::preview', '_format' => 'html'], ['code', '_format'], null, null, false, true, null]],
        252 => [[['_route' => '_wdt', '_controller' => 'web_profiler.controller.profiler::toolbarAction'], ['token'], null, null, false, true, null]],
        298 => [[['_route' => '_profiler_search_results', '_controller' => 'web_profiler.controller.profiler::searchResultsAction'], ['token'], null, null, false, false, null]],
        312 => [[['_route' => '_profiler_router', '_controller' => 'web_profiler.controller.router::panelAction'], ['token'], null, null, false, false, null]],
        332 => [[['_route' => '_profiler_exception', '_controller' => 'web_profiler.controller.exception_panel::body'], ['token'], null, null, false, false, null]],
        345 => [[['_route' => '_profiler_exception_css', '_controller' => 'web_profiler.controller.exception_panel::stylesheet'], ['token'], null, null, false, false, null]],
        355 => [
            [['_route' => '_profiler', '_controller' => 'web_profiler.controller.profiler::panelAction'], ['token'], null, null, false, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
