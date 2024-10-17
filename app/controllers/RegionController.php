<?php

require_once 'app/models/Region.php';
require_once 'app/services/RegionService.php';

class RegionController
{
    private RegionService $regionService;
    private const string REGIONS = "storage/oblinfo.txt";

    public function __construct()
    {
        $this->regionService = new RegionService();
    }
    public function getRegions(): void
    {
        $this->regionService->readRegionsFromFile(self::REGIONS);
        $regions = $this->regionService->getRegions();
        require_once 'app/views/regions.php';
    }
}