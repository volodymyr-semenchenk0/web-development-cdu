<?php

namespace App\services;

class WeatherLocation
{
    private array $citiesUrls = [];

    public function __construct()
    {
        $this->citiesUrls = [
            [
                'name' => 'Київ',
                'request' =>  'weather-kyiv-4944'
            ],
            [
                'name' => 'Харків',
                'request' =>  'weather-kharkiv-5053'
            ],
            [
                'name' => 'Черкаси',
                'request' =>  'weather-cherkasy-4956'
            ],
            [
                'name' => 'Аеропорт Сімферополя',
                'request' =>  'weather-simferopol-14409'
            ]
        ];
    }

    public function getCitiesUrls(): array
    {
        return $this->citiesUrls;
    }
}