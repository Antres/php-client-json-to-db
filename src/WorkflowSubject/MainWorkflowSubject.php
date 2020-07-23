<?php
namespace App\WorkflowSubject;

class  MainWorkflowSubject extends GenericWorkflowSubject
{
    private $clientJson = null;
    private $data = null;

    public function __construct(string $currentPlace = null, \Symfony\Contracts\HttpClient\HttpClientInterface $clientJson = null)
    {
        parent::__construct($currentPlace);
        $this->clientJson = $clientJson;
    }

    public function getClientJson()
    {
        return $this->clientJson;
    }

    public function setClientJson(\Symfony\Contracts\HttpClient\HttpClientInterface $clientJson) : MainWorkflowSubject
    {
        $this->clientJson = $clientJson;

        return $this;
    }

    public function getData()
    {
        return $this->data;
    }

    public function setData($data) : MainWorkflowSubject
    {
        $this->data = $data;

        return $this;
    }
}
