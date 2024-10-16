<?php

$routes = [
    '/' => [
        'controller' => 'HomeController',
        'method' => 'index'
    ],
    '/regions' => [
        'controller' => 'RegionController',
        'method' => 'index'
    ],
    '/study-directions' => [
        'controller' => 'StudyDirectionController',
        'method' => 'index'
    ],
    '/study-directions/institution' => [
        'controller' => 'StudyDirectionController',
        'method' => 'getInstitutionInfo'
    ],
];