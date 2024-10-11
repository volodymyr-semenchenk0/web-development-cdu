<?php

require_once 'app/models/StudyDirectionType.php';
require_once 'app/models/HigherEducationInstitution.php';

class StudyDirectionService {

    private const string DIRECTION_TYPES_FILEPATH = "storage/study_direction_types.txt";
    private const string DIRECTIONS_INFO_FILEPATH = "storage/study_directions_info.txt";
    private array $studyDirectionTypes = [];
    private array $studyDirectionsInfo = [];

    private HigherEducationInstitution $higherEducationInstitution;

    public function __construct()
    {
        $this->getDirectionTypesFromFile();
        $this->getDirectionsInfoFromFile();
    }

    private function getDirectionTypesFromFile() : void
    {
        $fileLineNumber = 0;

        if(file_exists(self::DIRECTION_TYPES_FILEPATH)){
            try {

                $myFile = fopen(self::DIRECTION_TYPES_FILEPATH, "r");
                if ($myFile === false) {
                    throw new Exception("Unable to open file!");
                }

                while (!feof($myFile)) {
                    $name = trim(fgets($myFile));
                    if (!empty($name)) {
                        $this->studyDirectionTypes[] = new StudyDirectionType($fileLineNumber, $name);
                    }
                    $fileLineNumber++;
                }
                fclose($myFile);
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        }

    }

    private function getDirectionsInfoFromFile() : void
    {
        $typesNumber = 0;

        if(file_exists(self::DIRECTIONS_INFO_FILEPATH)) {
            try {

                $myFile = fopen(self::DIRECTIONS_INFO_FILEPATH, "r");
                if ($myFile === false) {
                    throw new Exception("Unable to open file!");
                }

                while (!feof($myFile)) {
                    $line = trim(fgets($myFile));
                    if (!empty($line)) {
                        $studyDirectionType = new StudyDirectionType($typesNumber, $line);
                        $this->studyDirectionsInfo[$studyDirectionType->getId()] = [];

                        $institutionCount = (int)trim(fgets($myFile));

                        while($institutionCount >= 0) {
                            $budgetStateAverageMark = (float)fgets($myFile);
                            $budgetStudentsCount = (int)fgets($myFile);
                            $contractStudentsCount = (int)fgets($myFile);
                            $name = fgets($myFile);

                            $this->higherEducationInstitution = new HigherEducationInstitution(
                                $name,
                                $budgetStateAverageMark,
                                $budgetStudentsCount,
                                $contractStudentsCount);

                            $this->studyDirectionsInfo[$studyDirectionType->getId()][] =  $this->higherEducationInstitution;
                            $institutionCount--;
                        }
                    }
                    $typesNumber++;
                }
                fclose($myFile);
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        }

    }

    public function getStudyDirectionTypes(): array
    {
        return $this->studyDirectionTypes;
    }

    public function getStudyDirectionsInfo(): array
    {
        return $this->studyDirectionsInfo;
    }

    public function getHigherEductionInstitutionInfo(): HigherEducationInstitution
    {
        return $this->higherEducationInstitution;
    }

    public function sort(): void
    {
        usort($this->studyDirectionTypes, array('StudyDirectionType', 'compareDirectionTypeByName'));
    }
}