<?php

class Weather
{
    private string $cityName;
    private DateTime $currentDate;
    private string $sunsetTime;
    private string $sunriseTime;
    private string $dayLightDuration;
    private string $dayLightTime;
    private array $weatherDataListPerDay = [];

    public function __construct(string $cityName)
    {
        $this->cityName = $cityName;
    }

    public function getCityName(): string
    {
        return $this->cityName;
    }

    private function initiateWeatherHoursPerDay()
    {

    }


    public function getMinTemperaturePerDay(): int {
        return 0;
    }

    public function getMaxTemperaturePerDay(): int {
        return 0;
    }
}