<?php

namespace App\services;

use App\models\
{
    HigherEducationInstitution,
    InstitutionsCollection,
    StudyDirectionType
};
use Exception;

class HigherEducationInstitutionService
{
    private const string HIGHER_INSTITUTIONS_FILEPATH = __DIR__ . "/../../storage/study_directions_info.txt";
    private array $studyDirectionsCollection = [];

    public function readInstitutionsByTypeFromFile() : void
    {
        try {
            $myFile = fopen(self::HIGHER_INSTITUTIONS_FILEPATH, "r");

            while (!feof($myFile)) {
                $studyDirectionTypeLine = trim(fgets($myFile));
                if (!empty($studyDirectionTypeLine)) {
                    $collectionItem =  new InstitutionsCollection(
                        new StudyDirectionType($studyDirectionTypeLine)
                    );
                    $this->studyDirectionsCollection[] = $collectionItem;

                    $institutionCount = (int)trim(fgets($myFile));
                    while($institutionCount > 0) {
                        $collectionItem->addInstitutionToArray($this->prepareInstitution($myFile));
                        $institutionCount--;
                    }
                }
            }
            fclose($myFile);

        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    private function prepareInstitution($myFile) : HigherEducationInstitution
    {
        $budgetStateAverageMark = (float)trim(fgets($myFile));
        $budgetStudentsCount = (int)trim(fgets($myFile));
        $contractStudentsCount = (int)trim(fgets($myFile));
        $name = trim(fgets($myFile));

        return new HigherEducationInstitution (
            $name,
            $budgetStateAverageMark,
            $budgetStudentsCount,
            $contractStudentsCount
        );
    }

    public function getInstitutionByDirection(StudyDirectionType $studyDirection) : ?InstitutionsCollection
    {
        $studyDirectionObject = null;
        foreach ($this->studyDirectionsCollection as $collectionItem)
        {
            if ($collectionItem->getStudyDirectionType()->getHash() === $studyDirection->getHash())
            {
                $studyDirectionObject = $collectionItem;
                break;
            }
        }
        return $studyDirectionObject;
    }

    public function getStudyDirectionsCollection(): array
    {
        return $this->studyDirectionsCollection;
    }
}