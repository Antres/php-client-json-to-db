<?php
namespace App\WorkflowSubject;

class GenericWorkflowSubject
{
    private $currentPlace = null;

    public function __construct(string $currentPlace = null)
    {
        $this->currentPlace = $currentPlace;
    }

    public function getCurrentPlace() : string
    {
        return $this->currentPlace;
    }

    public function setCurrentPlace(string $currentPlace, array $context = []) : GenericWorkflowSubject
    {
        $this->currentPlace = $currentPlace;

        return $this;
    }
}
