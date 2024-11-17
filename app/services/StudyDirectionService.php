<?php

namespace App\services;

use App\models\StudyDirectionType;
use Exception;

class StudyDirectionService
{
    private const string DIRECTION_TYPES_FILEPATH = __DIR__ . "/../../storage/study_direction_types.txt";
    private array $studyDirectionTypes = [];
    public function readStudyDirectionTypesFromFile() : void
    {
        try {
            $myFile = fopen(self::DIRECTION_TYPES_FILEPATH, "r");

            while (!feof($myFile)) {
                $line = trim(fgets($myFile));
                if (!empty($line)) {
                    $this->studyDirectionTypes[] = new StudyDirectionType($line);
                }
            }
            fclose($myFile);

        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function sortByStudyDirectionTypeName(): void
    {
        usort($this->studyDirectionTypes, array('App\Models\StudyDirectionType', 'compareDirectionTypeByName'));
    }

    public function getStudyDirectionTypes(): array
    {
        return $this->studyDirectionTypes;
    }
}