<?php

namespace App\Controllers;

use App\Services\WeatherService;

class WeatherController
{
    public array $weatherList = [];
    private WeatherService $weatherService;

    public function __construct() {
        $this->weatherService = new WeatherService();
    }

    public function displayCityWeather() : void
    {
        $this->weatherList[0] = $this->weatherService->fetchWeatherData();
        require_once 'app/views/weather.php';
    }

}