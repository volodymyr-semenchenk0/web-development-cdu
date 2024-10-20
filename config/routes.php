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
        'method' => 'gerRegionsNames'
    ],
    '/region/info' => [
        'controller' => 'RegionController',
        'method' => 'displayRegions'
    ],
];