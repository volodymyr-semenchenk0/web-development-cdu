<?php

namespace App\services;

use Exception;
class IPService
{
    public function getXmlData(string $ip)
    {
        $url = "http://ip-api.com/xml/{$ip}";
        return @simplexml_load_file($url);
    }

    public function getJsonData(string $ip)
    {
        $url = "http://ip-api.com/json/{$ip}";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $json = curl_exec($ch);

        if (curl_errno($ch)) {
            curl_close($ch);
            return false;
        }

        curl_close($ch);
        return $json;
    }
}