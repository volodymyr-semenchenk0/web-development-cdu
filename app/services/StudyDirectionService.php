<?php

require_once 'app/models/StudyDirection.php';

class StudyDirectionService {

    private array $studyDirections;

    public function getDirectionsFromFile(string $filePath) : void
    {
        $fileLineNumber = 0;

        try {
            $myFile = fopen($filePath, "r");
            if ($myFile === false) {
                throw new Exception("Unable to open file!");
            }

            while (($name = fgets($myFile)) !== false) {
                $name = trim($name);
                if (!empty($name)) {
                    $this->studyDirections[] = new StudyDirection($fileLineNumber, $name);
                }
                $fileLineNumber++;
            }
            fclose($myFile);
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function getStudyDirections(): array
    {
        return $this->studyDirections;
    }

    public function sort(): void
    {
        usort($this->studyDirections, array('StudyDirection', 'compareDirectionsByName'));
    }

}