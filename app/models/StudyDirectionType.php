<?php

class StudyDirectionType
{
    private string $directionTypeName;
    private string $hash;

    public function __construct($directionName)
    {
        $this->directionTypeName = $directionName;
        $this->hash = $this->generateHash($directionName);
    }

    public static function compareDirectionTypeByName(StudyDirectionType $a, StudyDirectionType $b): int
    {
        return strcmp($a->getDirectionTypeName(), $b->getDirectionTypeName());
    }

    private function generateHash($value): string
    {
        return hash("sha256", $value);
    }

    public function isEqual(StudyDirectionType $type): bool
    {
        return $this->getHash() === $type->getHash();
    }

    public function getDirectionTypeName(): string
    {
        return $this->directionTypeName;
    }

    public function getHash(): string
    {
        return $this->hash;
    }
}
