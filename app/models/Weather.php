<?php

namespace App\models;

use DateTime;
use Exception;
use IntlDateFormatter;

class Weather
{
    private string $locationName;
    private DateTime $currentDate;
    private DayLight $lightDay;
    private array $temperatureForecast = [];

    /**
     * @throws Exception
     */
    public function __construct(
        string $cityName,
        DayLight $lightDay,
        string $currentDate,
        array $temperatureForecast
    )
    {
        $this->locationName = $cityName;
        $this->lightDay = $lightDay;
        try {
            $this->currentDate = $this->convertUAFormatToDateTime($currentDate);
        } catch (Exception $e) {
            throw new Exception("Failed to parse currentDate for city $cityName: " . $e->getMessage());
        }
        ;$this->temperatureForecast = $temperatureForecast;
    }

    /**
     * @throws Exception
     */
    public function convertUAFormatToDateTime($dateString): DateTime
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

        if ($date === false) {
            throw new Exception("Invalid date format: '$dateString'");
        }
        return $date;
    }

    public function getLocationName(): string
    {
        return $this->locationName;
    }

    public function getLightDay(): DayLight
    {
        return $this->lightDay;
    }

    public function getCurrentDate(): DateTime
    {
        return $this->currentDate;
    }

    public function getTemperatureForecast(): array
    {
        return $this->temperatureForecast;
    }

    public function getMinTemperaturePerDay(): int {
        $temperatures = array_column($this->temperatureForecast, 'temperature');
        return min($temperatures);
    }

    public function getMaxTemperaturePerDay(): int {
        $temperatures = array_column($this->temperatureForecast, 'temperature');
        return max($temperatures);
    }
}