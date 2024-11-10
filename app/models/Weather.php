<?php

namespace App\models;

use DateTime;
use Exception;
use IntlDateFormatter;

class Weather
{
    private string $cityName;
    private DateTime $currentDate;
    private DayLight $lightDay;
    private array $weatherDataListPerDay = [];


    public function __construct(string $cityName, DayLight $lightDay, string $currentDate)
    {
        $this->cityName = $cityName;
        $this->lightDay = $lightDay;
        $this->currentDate = $this->convertUAFormatToDateTime($currentDate);
    }

    public function convertUAFormatToDateTime($dateString) : DateTime
    {
        $daysMap = [
            'пн' => 'Mon', 'вт' => 'Tue', 'ср' => 'Wed', 'чт' => 'Thu',
            'пт' => 'Fri', 'сб' => 'Sat', 'нд' => 'Sun'
        ];

        $monthsMap = [
            'січ' => 'Jan', 'лют' => 'Feb', 'бер' => 'Mar', 'квіт' => 'Apr',
            'трав' => 'May', 'черв' => 'Jun', 'лип' => 'Jul', 'серп' => 'Aug',
            'вер' => 'Sep', 'жовт' => 'Oct', 'лис' => 'Nov', 'груд' => 'Dec'
        ];

        $dateString = mb_strtolower($dateString,'UTF-8');
        $dateString = strtr($dateString, $daysMap);
        $dateString = strtr($dateString, $monthsMap);
        $dateString .= ' ' . date('Y');

        $date = DateTime::createFromFormat('D, j M Y', $dateString);

        return $date === false ? throw new Exception("Invalid date format") : $date;
    }

    public function getCityName() : string
    {
        return $this->cityName;
    }

    public function getLightDay() : DayLight
    {
        return $this->lightDay;
    }

    public function getCurrentDate() : DateTime
    {
        return $this->currentDate;
    }

    private function initiateWeatherHoursPerDay()
    {

    }

    public function getMinTemperaturePerDay() : int {
        return 0;
    }

    public function getMaxTemperaturePerDay() : int {
        return 0;
    }
}