<?php

namespace App\Controllers;

use App\Services\RegionService;

class RegionController
{
    private RegionService $regionService;
    private array $regions = [];
    private const string REGIONS = "storage/oblinfo.txt";

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
        require_once 'app/views/regionsList.php';
    }
    public function getRegionsNames() : void
    {
        require_once 'app/views/regionSearch.php';
    }

    public function getRegions(): array
    {
        return $this->regions;
    }
}