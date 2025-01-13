<?php

$routes = [
    '/' => [
        'controller' => 'App\controllers\HomeController',
        'method' => 'index'
    ],
    '/regions' => [
        'controller' => 'App\controllers\RegionController',
        'method' => 'displayRegions'
    ],
    '/study-directions' => [
        'controller' => 'App\controllers\StudyDirectionController',
        'method' => 'displayStudyDirectionTypes'
    ],
    '/study-directions/institution' => [
        'controller' => 'App\controllers\StudyDirectionController',
        'method' => 'displayInstitutionInfo'
    ],
    '/region' => [
        'controller' => 'App\controllers\RegionController',
        'method' => 'getRegionsNames'
    ],
    '/region/info' => [
        'controller' => 'App\controllers\RegionController',
        'method' => 'displayRegions'
    ],
    '/weather' => [
        'controller' => 'App\controllers\WeatherController',
        'method' => 'displayCityWeather'
    ],
];