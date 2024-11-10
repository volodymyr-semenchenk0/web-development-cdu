<?php

namespace App\services;

use DateTime;
use DOMDocument;
use DOMXPath;
use IntlDateFormatter;
use App\models\
{
    Weather, DayLight
};

class WeatherService
{
    private string $url = 'https://meteofor.com.ua/weather-kharkiv-5053/';
    private Weather $weather;
    private DOMXPath $xpath;

    public function fetchWeatherData() : Weather
    {
        $ch = curl_init($this->url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);

        $this->parseWeatherData($response);

        return $this->weather;
    }

    private function parseWeatherData($response) : void
    {
        $dom = new DOMDocument();
        @$dom->loadHTML($response);
        $this->xpath = new DOMXPath($dom);

        $cityName = $this->fetchCityName();
        $dayLight = new DayLight(
            $this->fetchDayLightTime( 'Схід'),
            $this->fetchDayLightTime('Захід')
        );
        $currentDate = $this->fetchCurrentDate();

        $this->weather = new Weather($cityName, $dayLight, $currentDate);
    }

    private function fetchCityName() : string
    {
         return $this->xpath->query("//div[@class='page-title']/h1")->item(0)->nodeValue;
    }

    private function fetchDayLightTime($periodName): string
    {
        $sunriseNode = $this->xpath->query("//div[@class='astro-times']/div[contains(text(), '$periodName')]");
        $sunriseText = $sunriseNode->item(0)->nodeValue;

        preg_match('/' . $periodName . ' — ([0-9]{1,2}:[0-9]{2})/', $sunriseText, $matches);
        return $matches[1];
    }

    private function fetchCurrentDate() : string
    {
        return $this->xpath->
        query("//div[contains(@class, 'date-0')]")->item(0)->nodeValue;
    }
}