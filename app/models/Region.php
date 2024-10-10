<?php

class Region {

    public int $id;
    public string $name;
    public int $population;
    public string $higherEducationInstitutions;

    public float $institutionsBy100000Population;

    public function __construct($id, $region, $population, $higherEducationInstitutions) {
        $this->id = $id;
        $this->name = $region;
        $this->population = $population;
        $this->higherEducationInstitutions = $higherEducationInstitutions;
        $this->institutionsBy100000Population =$this->calcInstitutionsBy100000Population();
    }

    private function calcInstitutionsBy100000Population(): float {
        return round($this->higherEducationInstitutions / ($this->population * 10000) * 1000000, 2);
    }
    public function __toString() {
        return "Region name is: " . $this->name ."; ".
            "Population in region is: " . $this->population ."; ".
            "Count of higher education institutions: " . $this->higherEducationInstitutions .";";
    }

    public static function getAllRegionsFromFile($filePath) {
        $id = 0;
        $regions = array();
        $myFile = fopen($filePath, "r") or die("Unable to open file!");

        while (!feof($myFile)) {
            $name = trim(fgets($myFile));
            $population = trim(fgets($myFile));
            $higherEducationInstitutions = trim(fgets($myFile));

            if (!empty($name) && !empty($population) && !empty($higherEducationInstitutions)) {
                $id++;
                $regions[] = new Region($id, $name, $population, $higherEducationInstitutions);
            }
        }
        fclose($myFile);

        return $regions;
    }
}