<?php

class Weather
{
    private string $cityName;
    private DayLight $lightDay;
    private array $weatherDataListPerDay = [];

    public function __construct(string $cityName, DayLight $lightDay)
    {
        $this->cityName = $cityName;
        $this->lightDay = $lightDay;
    }

    public function getCityName(): string
    {
        return $this->cityName;
    }

    public function getLightDay(): DayLight
    {
        return $this->lightDay;
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