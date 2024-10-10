<?php

class StudyDirection
{
    private int $id;
    private string $directionName;

    public function __construct($id,$directionName) {
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
    public static function getAllStudyDirectionsFromFile($filePath) {
        $id = 0;
        $directions = array();
        $myFile = fopen($filePath, "r") or die("Unable to open file!");

        while (!feof($myFile)) {
            $name = trim(fgets($myFile));

            if (!empty($name)) {
                $id++;
                $directions[] = new StudyDirection($id, $name);
            }
        }
        fclose($myFile);

        return $directions;
    }

    public static function sortByName(StudyDirection $a, StudyDirection $b): int
    {
        return $a->getDirectionName() <=> $b->getDirectionName();
    }
}
