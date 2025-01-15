<?php

namespace App\controllers;

use App\services\AjaxSearchService;
use Exception;

class AjaxSearchController
{
    private AjaxSearchService $ajaxSearchService;

    public function __construct()
    {
        $this->ajaxSearchService = new AjaxSearchService();
    }

    /**
     * Метод для пошуку в реальному часі
     * @throws Exception
     */
    public function liveSearch(): void
    {
        // Перевіряємо, чи передано параметр query
        $query = $_GET['query'] ?? '';
        $query = trim($query);

        if ($query === '') {
            require_once __DIR__ . '/../views/ajaxSearch.php';
            return;
        }

        try {
            $results = $this->ajaxSearchService->getResults($query);

            if (!empty($results)) {
                echo $results;
            } else {
                echo '<p>Результатів не знайдено.</p>';
            }
        } catch (Exception $e) {
            http_response_code(500);
            echo '<p>Помилка сервера: ' . htmlspecialchars($e->getMessage()) . '</p>';
        }
    }
}