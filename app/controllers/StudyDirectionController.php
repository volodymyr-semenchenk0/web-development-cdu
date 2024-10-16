<?php

require_once 'app/services/StudyDirectionService.php';
require_once 'app/services/HigherEducationInstitutionService.php';

class StudyDirectionController
{
    private StudyDirectionService $studyDirectionService;
    private HigherEducationInstitutionService $higherEducationInstitutionService;
    private const string DIRECTION_TYPES_FILEPATH = "storage/study_direction_types.txt";
    private const string HIGHER_INSTITUTIONS_FILEPATH = "storage/study_directions_info.txt";

    public function __construct() {
        $this->higherEducationInstitutionService = new HigherEducationInstitutionService();
        $this->studyDirectionService = new StudyDirectionService();
    }

    public function index(): void
    {
        $this->prepareStudyDirectionTypes();
        $studyDirectionTypes = $this->studyDirectionService->getStudyDirectionTypes();

        require_once 'app/views/studyDirectionTypes.php';
    }

    public function getInstitutionInfo(): void
    {
        $response = $_GET['studyDirectionId'] ?? '';

        if (isset($response) && $response !== "") {
            $this->prepareStudyDirectionTypes();
            $studyDirection = $this->studyDirectionService->getStudyDirectionTypes()[$response];

            $this->higherEducationInstitutionService->readInstitutionsByTypeFromFile(self::HIGHER_INSTITUTIONS_FILEPATH);
            $institution = $this->higherEducationInstitutionService->getInstitutionByDirection($studyDirection);

            $institutionDirectionType = $institution->getStudyDirectionType();
            $institutionsList = $institution->getHigherStudyInstitutions();

            require_once 'app/views/higherEducationInstitution.php';
        }
        else {
            http_response_code(400);
            echo "Invalid study direction ID.";
        }
    }

    private function prepareStudyDirectionTypes(): void
    {
        $this->studyDirectionService->readStudyDirectionTypesFromFile(self::DIRECTION_TYPES_FILEPATH);
        $this->studyDirectionService->sortByStudyDirectionTypeName();
    }
}