<?php

namespace App\controllers;

use App\services\IPService;

class IPController
{
    protected IPService $ipService;

    public function __construct()
    {
        $this->ipService = new IPService();
    }

    public function showIpSearch(): void
    {
        require_once __DIR__ . '/../views/ipSearch.php';
    }

    public function getJson(): void
    {
        $ip = trim($_POST['ip']);
        $jsonData = $this->ipService->getJsonData($ip);
        header("Content-Type: application/json");
        echo $jsonData;
    }
}