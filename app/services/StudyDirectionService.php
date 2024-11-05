<?php

require_once 'app/models/StudyDirectionType.php';

class StudyDirectionService
{
    private const string DIRECTION_TYPES_FILEPATH = "storage/study_direction_types.txt";
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
        usort($this->studyDirectionTypes, array('StudyDirectionType', 'compareDirectionTypeByName'));
    }

    public function getStudyDirectionTypes(): array
    {
        return $this->studyDirectionTypes;
    }
}