<?php

require_once 'app/models/StudyDirectionType.php';
require_once 'app/models/HigherEducationInstitution.php';
require_once 'app/models/InstitutionsCollection.php';

class HigherEducationInstitutionService
{
    private array $studyDirectionsCollection = [];

    public function readInstitutionsByTypeFromFile($filePath) : void
    {
        try {
            $myFile = fopen($filePath, "r");

            while (!feof($myFile)) {
                $studyDirectionTypeLine = trim(fgets($myFile));
                if (!empty($studyDirectionTypeLine)) {
                    $collectionItem =  new InstitutionsCollection(
                        new StudyDirectionType($studyDirectionTypeLine)
                    );
                    $this->studyDirectionsCollection[] = $collectionItem;

                    $institutionCount = (int)trim(fgets($myFile));
                    while($institutionCount > 0)
                    {
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