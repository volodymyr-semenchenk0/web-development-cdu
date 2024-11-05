<?php

require_once 'app/models/Weather.php';

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

        $cityName = $xpath->query("//div[@class='page-title']/h1")->item(0)->nodeValue;

        $this->weather = new Weather($cityName);


    }
}