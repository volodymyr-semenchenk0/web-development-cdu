<?php

require_once 'app/services/WeatherService.php';

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