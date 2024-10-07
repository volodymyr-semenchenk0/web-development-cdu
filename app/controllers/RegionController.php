<?php

require_once 'app/models/RegionModel.php';

class RegionController
{
    public function index()
    {
        $regions = Region::getAllRegionsFromFile("storage/oblinfo.txt");

        require_once 'app/views/regions.php';
    }
}