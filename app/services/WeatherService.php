<?php

namespace App\services;

use DOMDocument;
use DOMXPath;
use App\models\
{
    Weather, DayLight
};

class WeatherService
{
    private string $url = 'https://meteofor.com.ua/weather-kharkiv-5053/';
    private Weather $weather;

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
        $xpath = new DOMXPath($dom);

        $cityName = $this->getCityName($xpath);
        $sunriseTime = $this->getSunriseTime($xpath, 'Схід');
        $sunsetTime = $this->getSunriseTime($xpath, 'Захід');

//        $sunriseTime = '4:00';
//        $sunsetTime = '5:00';
        $dayLight = new DayLight($sunriseTime, $sunsetTime);



        $this->weather = new Weather($cityName, $dayLight, 'Чт, 7 лис');
    }

    private function getCityName($xpath) : string
    {
         return $xpath->query("//div[@class='page-title']/h1")->item(0)->nodeValue;
    }

    private function getSunriseTime($xpath, $periodName) : string
    {
        $sunriseNode = $xpath->query("//div[@class='astro-times']/div[contains(text(), '$periodName')]");
        $sunriseText = $sunriseNode->item(0)->nodeValue;

        preg_match('/' . $periodName . ' — ([0-9]{1,2}:[0-9]{2})/', $sunriseText, $matches);
        return $matches[1];
    }
}