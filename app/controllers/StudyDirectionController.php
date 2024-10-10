<?php

require_once 'app/models/StudyDirection.php';

class StudyDirectionController
{
    public function index(): void
    {
        $studyDirections = StudyDirection::getAllStudyDirectionsFromFile("storage/napr.txt");


        require_once 'app/views/studyDirections.php';
    }
}