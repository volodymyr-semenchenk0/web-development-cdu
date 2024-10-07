<?php

class Region {

    public $id;
    public $name;
    public $population;
    public $higherEducationInstitutions;

    public function __construct($id, $region, $population, $higherEducationInstitutions) {
        $this->id = $id;
        $this->name = $region;
        $this->population = $population;
        $this->higherEducationInstitutions = $higherEducationInstitutions;
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
            $id += $id;
            $regions[] = new Region($id, $name, $population, $higherEducationInstitutions);
        }
        fclose($myFile);

        return $regions;
    }
}