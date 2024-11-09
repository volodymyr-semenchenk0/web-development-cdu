<?php

namespace App\models;

class Region {
    private string $name;
    private int $population;
    private string $higherEducationInstitutions;
    private float $institutionsBy100000Population;

    public function __construct( $region, $population, $higherEducationInstitutions)
    {
        $this->name = $region;
        $this->population = $population;
        $this->higherEducationInstitutions = $higherEducationInstitutions;
        $this->institutionsBy100000Population =$this->calcInstitutionsBy100000Population();
    }

    private function calcInstitutionsBy100000Population(): float
    {
        return round($this->higherEducationInstitutions / ($this->population * 10000) * 1000000, 2);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPopulation(): int
    {
        return $this->population;
    }

    public function getHigherEducationInstitutions(): string
    {
        return $this->higherEducationInstitutions;
    }

    public function getInstitutionsBy100000Population(): float
    {
        return $this->institutionsBy100000Population;
    }
}