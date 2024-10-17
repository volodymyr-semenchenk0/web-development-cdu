<?php

class StudyDirectionsCollection
{
    private StudyDirectionType $studyDirectionType;

    private array $higherStudyInstitutions = [];

    public function __construct(StudyDirectionType $studyDirectionType)
    {
        $this->studyDirectionType = $studyDirectionType;
    }

    public function addInstitutionToArray(HigherEducationInstitution $higherEducationInstitution): void
    {
        $this->higherStudyInstitutions[] = $higherEducationInstitution;
    }

    public function getHigherStudyInstitutions(): array
    {
        return $this->higherStudyInstitutions;
    }

    public function getStudyDirectionType(): StudyDirectionType
    {
        return $this->studyDirectionType;
    }
}
