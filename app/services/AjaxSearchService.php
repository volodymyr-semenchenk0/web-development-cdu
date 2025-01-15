<?php

namespace App\services;

use DOMDocument;
use DOMXPath;
use Exception;

class AjaxSearchService
{
    /**
     * @throws Exception
     */
    public function getResults(string $query): string
    {
        $url = 'https://www.foxtrot.com.ua/uk/search?query=' . urlencode($query);

        // Налаштування CURL
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36');
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if (!$response || $httpCode !== 200) {
            throw new Exception('Не вдалося отримати дані з сайту Foxtrot. Код відповіді: ' . $httpCode);
        }

        $dom = new DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML($response);
        libxml_clear_errors();

        $xpath = new DOMXPath($dom);
        $nodes = $xpath->query('//div[contains(@class, "listing__body-wrap")]');

        $output = '';
        foreach ($nodes as $node) {
            $output .= $dom->saveHTML($node);
        }

        return $output ?: '<p>Результатів не знайдено.</p>';
    }
}