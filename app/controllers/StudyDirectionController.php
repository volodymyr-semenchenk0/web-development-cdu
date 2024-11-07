<?php

namespace App\Controllers;


use App\
{
    Services\StudyDirectionService,
    Services\HigherEducationInstitutionService
};
use App\Models\InstitutionsCollection;

class StudyDirectionController
{
    private StudyDirectionService $studyDirectionService;
    private HigherEducationInstitutionService $higherEducationInstitutionService;
    private array $studyDirectionTypes = [];
    public InstitutionsCollection $selectedInstitution;

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
            $this->higherEducationInstitutionService->
            readInstitutionsByTypeFromFile();
            $this->selectedInstitution =
                $this->higherEducationInstitutionService->
                getInstitutionByDirection($this->studyDirectionTypes[$response]);

            require_once 'app/views/higherEducationInstitution.php';
        }
        else {
            http_response_code(400);
            echo "Invalid study direction ID.";
        }
    }

    private function prepareStudyDirectionTypes(): array
    {
        $this->studyDirectionService->readStudyDirectionTypesFromFile();
        $this->studyDirectionService->sortByStudyDirectionTypeName();
        return $this->studyDirectionService->getStudyDirectionTypes();
    }
}