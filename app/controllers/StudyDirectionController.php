<?php

require_once 'app/services/StudyDirectionService.php';
require_once 'app/services/HigherEducationInstitutionService.php';

class StudyDirectionController
{
    private StudyDirectionService $studyDirectionService;
    private const string DIRECTION_TYPES_FILEPATH = "storage/study_direction_types.txt";
    private const string HIGHER_INSTITUTIONS_FILEPATH = "storage/study_directions_info.txt";

    public function __construct() {
        $this->studyDirectionService = new StudyDirectionService();
    }

    public function index(): void
    {
        $this->studyDirectionService->readStudyDirectionTypesFromFile(self::DIRECTION_TYPES_FILEPATH);
        $this->studyDirectionService->sortByStudyDirectionTypeName();
        $studyDirectionTypes = $this->studyDirectionService->getStudyDirectionTypes();

        require_once 'app/views/studyDirectionTypes.php';
    }

    public function getDirectionInfo(): void
    {
        $response = $_POST['studyDirection'] ?? '';

        if (isset($response) && $response !== "") {

            $higherEducationInstitutionService = new HigherEducationInstitutionService();
            $higherEducationInstitutionService->readInstitutionsByTypeFromFile(self::HIGHER_INSTITUTIONS_FILEPATH);

            $institution = $higherEducationInstitutionService->getInstitutionByDirectionHash($response);

            $institutionDirectionType = $institution->getStudyDirectionType();
            $institutionsList = $institution->getHigherStudyInstitutions();

            require_once 'app/views/higherEducationInstitution.php';
        }
        else {
            echo "Error";
        }
    }
}