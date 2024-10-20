<?php

require_once 'app/services/StudyDirectionService.php';
require_once 'app/services/HigherEducationInstitutionService.php';

class StudyDirectionController
{
    private StudyDirectionService $studyDirectionService;
    private HigherEducationInstitutionService $higherEducationInstitutionService;
    private array $studyDirectionTypes = [];
    private InstitutionsCollection $selectedIstitution;

    private StudyDirectionType $institutionDirectionType;
    private const string DIRECTION_TYPES_FILEPATH = "storage/study_direction_types.txt";
    private const string HIGHER_INSTITUTIONS_FILEPATH = "storage/study_directions_info.txt";

    public function __construct() {
        $this->higherEducationInstitutionService = new HigherEducationInstitutionService();
        $this->studyDirectionService = new StudyDirectionService();

        $this->studyDirectionTypes = $this->prepareStudyDirectionTypes();
    }

    public function displayStudyDirectionTypes(): void
    {
        require_once 'app/views/studyDirectionTypes.php';
    }

    public function displayInstitutionInfo(): void
    {
        $response = $_GET['studyDirectionId'] ?? '';

        if (isset($response) && $response !== "" && array_key_exists($response, $this->studyDirectionTypes)) {
            $this->higherEducationInstitutionService->readInstitutionsByTypeFromFile(self::HIGHER_INSTITUTIONS_FILEPATH);
            $this->selectedIstitution = $this->higherEducationInstitutionService->getInstitutionByDirection($this->studyDirectionTypes[$response]);

            require_once 'app/views/higherEducationInstitution.php';
        }
        else {
            http_response_code(400);
            echo "Invalid study direction ID.";
        }
    }

    private function prepareStudyDirectionTypes(): array
    {
        $this->studyDirectionService->readStudyDirectionTypesFromFile(self::DIRECTION_TYPES_FILEPATH);
        $this->studyDirectionService->sortByStudyDirectionTypeName();
        return $this->studyDirectionService->getStudyDirectionTypes();
    }

    public function getStudyDirectionTypes() :array
    {
        return $this->studyDirectionTypes;
    }

    public function getSelectedInstitution(): InstitutionsCollection
    {
        return $this->selectedIstitution;
    }
}