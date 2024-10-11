<?php

class HigherEducationInstitution
{
    private string $name;
    private float $budgetStateAverageMark;
    private int $budgetStudentsCount;
    private int $contractStudentsCount;
    private int $shortage;

    public function __construct(
        string $name,
        float $budgetStateAverageMark,
        int $budgetStudentsCount,
        int $contractStudentsCount,
    )
    {
        $this->name = $name;
        $this->budgetStateAverageMark = round($budgetStateAverageMark, 2);
        $this->budgetStudentsCount = $budgetStudentsCount;
        $this->contractStudentsCount = $contractStudentsCount;
        $this->shortage = $contractStudentsCount < 0 ? abs($contractStudentsCount) : 0;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getBudgetStateAverageMark(): float
    {
        return $this->budgetStateAverageMark;
    }

    public function getBudgetStudentsCount(): int
    {
        return $this->budgetStudentsCount;
    }

    public function getContractStudentsCount(): int
    {
        return $this->contractStudentsCount;
    }

    public function getShortage(): int
    {
        return $this->shortage;
    }
}