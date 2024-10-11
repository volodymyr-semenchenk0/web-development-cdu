<?php

require_once 'app/services/StudyDirectionService.php';

class StudyDirectionController
{
    private StudyDirectionService $studyDirectionService;

    public function __construct() {
        $this->studyDirectionService = new StudyDirectionService();
    }
    public function index(): void
    {
        try {
            $this->studyDirectionService->sort();
            $studyDirectionTypes = $this->studyDirectionService->getStudyDirectionTypes();

            require_once 'app/views/studyDirectionTypes.php';
        } catch (Exception $e) {
            echo "An error occurred: " . $e->getMessage();
        }
    }
}