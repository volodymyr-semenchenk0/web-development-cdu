<?php

class StudyDirection
{
    private int $id;
    private string $directionName;

    public function __construct($id,$directionName)
    {
        $this->id = $id;
        $this->directionName = $directionName;
    }

    public function getDirectionName(): string
    {
        return $this->directionName;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public static function compareDirectionsByName(StudyDirection $a, StudyDirection $b): int
    {
        return strcmp($a->directionName, $b->directionName);
    }
}
