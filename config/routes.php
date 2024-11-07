<?php

$routes = [
    '/' => [
        'controller' => 'App\Controllers\HomeController',
        'method' => 'index'
    ],
    '/regions' => [
        'controller' => 'App\Controllers\RegionController',
        'method' => 'displayRegions'
    ],
    '/study-directions' => [
        'controller' => 'App\Controllers\StudyDirectionController',
        'method' => 'displayStudyDirectionTypes'
    ],
    '/study-directions/institution' => [
        'controller' => 'App\Controllers\StudyDirectionController',
        'method' => 'displayInstitutionInfo'
    ],
    '/region' => [
        'controller' => 'App\Controllers\RegionController',
        'method' => 'getRegionsNames'
    ],
    '/region/info' => [
        'controller' => 'App\Controllers\RegionController',
        'method' => 'displayRegions'
    ],
    '/weather' => [
        'controller' => 'App\Controllers\WeatherController',
        'method' => 'displayCityWeather'
    ],
];