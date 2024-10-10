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
            $this->studyDirectionService->getDirectionsFromFile("storage/napr.txt");
            $this->studyDirectionService->sort();
            $studyDirections = $this->studyDirectionService->getStudyDirections();

            // Pass the $studyDirections to the view
            require_once 'app/views/studyDirections.php';
        } catch (Exception $e) {
            echo "An error occurred: " . $e->getMessage();
        }
    }
}