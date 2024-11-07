<?php

namespace App\Services;

use App\Models\Region;

class RegionService
{
    private array $regions = [];

    public function readRegionsFromFile($filePath) : void
    {
        $myFile = fopen($filePath, "r") or die("Unable to open file!");
        while (!feof($myFile)) {
            $name = trim(fgets($myFile));
            $population = trim(fgets($myFile));
            $higherEducationInstitutions = trim(fgets($myFile));

            if (!empty($name) && !empty($population) && !empty($higherEducationInstitutions)) {
                $this->regions[] = new Region($name, $population, $higherEducationInstitutions);
            }
        }
        fclose($myFile);
    }

    public function getRegions(): array
    {
        return $this->regions;
    }
}