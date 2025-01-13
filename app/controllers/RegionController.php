<?php

namespace App\controllers;

use App\services\RegionService;

class RegionController
{
    private RegionService $regionService;
    private array $regions = [];
    private const string REGIONS = __DIR__ . "/../../storage/oblinfo.txt";

    public function __construct()
    {
        $this->regionService = new RegionService();
        $this->regionService->readRegionsFromFile(self::REGIONS);
        $this->regions = $this->regionService->getRegions();
    }
    public function displayRegions(): void
    {
        $response = $_POST['selectedRegionId'] ?? '';
        if (isset($response) && $response != null && array_key_exists($response, $this->regions)) {
            $this->regions = [$response => $this->regions[$response]];
        }
        require_once __DIR__ . '/../views/regionsList.php';
    }
    public function getRegionsNames() : void
    {
        require_once __DIR__ . '/../views/regionSearch.php';
    }

    public function getRegions(): array
    {
        return $this->regions;
    }
}