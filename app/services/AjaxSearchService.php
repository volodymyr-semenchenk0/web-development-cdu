<?php

namespace App\services;

use DOMDocument;
use DOMXPath;
use Exception;

class AjaxSearchService
{
    /**
     *
     * @throws Exception
     */
    public function getResults(string $query): string
    {
        $url = 'https://www.foxtrot.com.ua/uk/search?query=' . urlencode($query);

        $response = $this->fetchUrl($url);

        $results = $this->parseHtml($response);

        return $results ?: '<p>Результатів не знайдено.</p>';
    }

    /**
     *
     * @throws Exception
     */
    private function fetchUrl(string $url): string
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36');

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if (!$response || $httpCode !== 200) {
            error_log('Не вдалося отримати дані з сайту: ' . $url . ' Код: ' . $httpCode);
            throw new Exception('Не вдалося отримати дані з сайту. Код відповіді: ' . $httpCode);
        }

        return $response;
    }

    /**
     *
     * @throws Exception
     */
    private function parseHtml(string $html): string
    {
        $dom = new DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML($html);
        libxml_clear_errors();

        $xpath = new DOMXPath($dom);
        $nodes = $xpath->query('//div[contains(@class, "listing__body-wrap")]');

        if ($nodes->length === 0) {
            return '';
        }

        $output = '';
        foreach ($nodes as $node) {
            $output .= $dom->saveHTML($node);
        }

        return $output;
    }
}