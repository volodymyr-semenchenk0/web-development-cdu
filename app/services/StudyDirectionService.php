<?php

require_once 'app/models/StudyDirectionType.php';

class StudyDirectionService
{
    private array $studyDirectionTypes = [];
    public function readStudyDirectionTypesFromFile($filePath) : void
    {
        try {
            $myFile = fopen($filePath, "r");

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

    public function findStudyDirectionTypeByHash($studyDirectionHash) : StudyDirectionType
    {
        $studyDirectionType = null;
        foreach ($this->studyDirectionTypes as $directionType) {
            if ($directionType->getHash() === $studyDirectionHash) {
                $studyDirectionType = $directionType;
                break;
            }
        }
        return $studyDirectionType;
    }
}