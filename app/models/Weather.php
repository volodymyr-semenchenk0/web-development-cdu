<?php

namespace App\Models;

use DateTime;
use Exception;
use App\Helpers\DateHelper;

class Weather
{
    private DateTime $currentDate;
    private string $cityName;
    private DayLight $lightDay;
    private array $weatherDataListPerDay = [];


    public function __construct(string $cityName, DayLight $lightDay, string $currentDate)
    {
        $this->cityName = $cityName;
        $this->lightDay = $lightDay;
        try {
            $this->currentDate = DateHelper::convertUAFormatToDateTime($currentDate);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function getCityName(): string
    {
        return $this->cityName;
    }

    public function getLightDay(): DayLight
    {
        return $this->lightDay;
    }

    public function getCurrentDate(): DateTime
    {
        return $this->currentDate;
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