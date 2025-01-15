<?php

namespace App\controllers;

use App\models\Weather;
use Exception;
use App\services\
{
    WeatherService,
    WeatherLocation
};

class WeatherController
{
    private Weather $weatherData;
    private array $locations = [];
    private WeatherService $weatherService;
    private WeatherLocation $weatherCityService;

    public function __construct() {
        $this->weatherService = new WeatherService();
        $this->weatherCityService = new WeatherLocation();
        $this->locations = $this->weatherCityService->getCitiesUrls();
    }

    /**
     * @throws Exception
     */
    public function displayCityWeather() : void
    {
        try {
            $response = $_GET['location'] ?? $this->locations[0]['request'];
            $this->weatherData = $this->weatherService->fetchWeatherData($response);
        } catch (Exception $e) {
            error_log($e->getMessage());
            http_response_code(400);

            echo $e->getMessage();
        }

        require_once __DIR__ . '/../views/weather.php';
    }

    public function getWeatherData(): Weather
    {
        return $this->weatherData;
    }

    public function getLocations(): array
    {
        return $this->locations;
    }
}