<?php

$routes = [
    '/' => [
        'controller' => 'HomeController',
        'method' => 'index'
    ],
    '/regions' => [
        'controller' => 'RegionController',
        'method' => 'displayRegions'
    ],
    '/study-directions' => [
        'controller' => 'StudyDirectionController',
        'method' => 'displayStudyDirectionTypes'
    ],
    '/study-directions/institution' => [
        'controller' => 'StudyDirectionController',
        'method' => 'displayInstitutionInfo'
    ],
    '/region' => [
        'controller' => 'RegionController',
        'method' => 'getRegionsNames'
    ],
    '/region/info' => [
        'controller' => 'RegionController',
        'method' => 'displayRegions'
    ],
    '/weather' => [
        'controller' => 'WeatherController',
        'method' => 'displayCityWeather'
    ],
];