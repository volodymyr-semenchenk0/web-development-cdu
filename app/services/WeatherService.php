<?php

namespace App\services;

use DateTime;
use DOMDocument;
use DOMXPath;
use Exception;
use App\models\
{
    Weather, DayLight
};

class WeatherService
{
    private string $url = 'https://meteofor.com.ua/';
    private DOMXPath $xpath;

    /**
     * @throws Exception
     */
    public function fetchWeatherData(string $weatherLocation) : Weather
    {
        try {
            $this->url .= $weatherLocation . '/';
            $ch = curl_init($this->url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($ch);
            curl_close($ch);

            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            if ($httpCode !== 200) {
                throw new Exception("Invalid response from the server: HTTP $httpCode");
            }

            return $this->parseWeatherData($response);

        } catch (Exception $e) {
            error_log($e->getMessage());
            throw new Exception('Error fetching weather data: ' . $e->getMessage());
        }
    }

    /**
     * @throws Exception
     */
    private function parseWeatherData($response) : Weather
    {
        try {
            $dom = new DOMDocument();
            @$dom->loadHTML($response);
            $this->xpath = new DOMXPath($dom);

            $cityName = $this->fetchWeatherLocationName();
            $dayLight = new DayLight(
                $this->fetchDayLightTime('Схід'),
                $this->fetchDayLightTime('Захід')
            );
            $currentDate = $this->fetchCurrentDate();
            $temperatureForecast = $this->fetchTemperatureForecast();

            return new Weather($cityName, $dayLight, $currentDate, $temperatureForecast);
        } catch (Exception $e) {
            error_log($e->getMessage());
            throw new Exception('Error parsing weather data: ' . $e->getMessage());
        }
    }

    /**
     * @throws Exception
     */
    private function fetchWeatherLocationName(): string
    {
        try {
            $node = $this->xpath->query("//div[@class='page-title']/h1")->item(0);
            if (!$node) {
                throw new Exception('Location name not found in the page content');
            }

            return $node->nodeValue;
        } catch (Exception $e) {
            error_log($e->getMessage());
            throw new Exception('Error fetching location name: ' . $e->getMessage());
        }
    }

    /**
     * @throws Exception
     */
    private function fetchDayLightTime($periodName): string
    {
        try {
            $sunriseNode = $this->xpath
                ->query("//div[@class='astro-times']/div[contains(text(), '$periodName')]");
            $sunriseText = $sunriseNode->item(0)->nodeValue ?? '';

            if (!$sunriseText) {
                throw new Exception("$periodName time not found in the page content");
            }

            preg_match('/' . $periodName . ' — ([0-9]{1,2}:[0-9]{2})/', $sunriseText, $matches);
            if (empty($matches[1])) {
                throw new Exception("Invalid $periodName time format");
            }

            return $matches[1];
        } catch (Exception $e) {
            error_log($e->getMessage());
            throw new Exception("Error fetching $periodName time: " . $e->getMessage());
        }
    }

    /**
     * @throws Exception
     */
    private function fetchCurrentDate() : string
    {
        try {
            $node = $this->xpath
                ->query("//div[contains(@class, 'date')]")->item(1);

            if (!$node) {
                throw new Exception('Current date not found in the page content');
            }

            return $node->nodeValue;
        } catch (Exception $e) {
            error_log($e->getMessage());
            throw new Exception('Error fetching current date: ' . $e->getMessage());
        }
    }

    /**
     * @throws Exception
     */
    private function fetchTemperatureForecast() : array
    {
        try {
            $temperatureForecast = [];

            $dateItems = $this->xpath->query('//div[@class="widget-row widget-row-datetime-time"]/div[@class="row-item"]');
            $tempItems = $this->xpath->query('//div[@data-row="temperature-air"]//div[@class="value"]/temperature-value');

            if ($dateItems->length === 0 || $tempItems->length === 0) {
                throw new Exception('Temperature forecast data not found');
            }

            foreach ($dateItems as $tempIndex => $item) {
                $title = $item->getAttribute('title');
                preg_match_all('/\d{4}-\d{2}-\d{2} \d{1,2}:\d{2}:\d{2}/', $title, $matches);
                $date = $matches[0][1] ?? $matches[0][0] ?? null;

                $temperatureNode = $tempItems->item($tempIndex);
                $temperature = $temperatureNode?->getAttribute('value');

                if (!$date || $temperature === null) {
                    throw new Exception('Invalid or missing data in temperature forecast');
                }

                $temperatureForecast[] = [
                    'date' => new DateTime($date),
                    'temperature' => (int)$temperature
                ];
            }

            return $temperatureForecast;
        } catch (Exception $e) {
            error_log($e->getMessage());
            throw new Exception('Error fetching temperature forecast: ' . $e->getMessage());
        }
    }
}