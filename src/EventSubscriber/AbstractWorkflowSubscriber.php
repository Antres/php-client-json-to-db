<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

abstract class AbstractWorkflowSubscriber implements EventSubscriberInterface
{
    protected $workflowsRegistry = null;

    public function __construct(\Symfony\Component\Workflow\Registry $workflowsRegistry)
    {
       $this->workflowsRegistry = $workflowsRegistry;
    }
}
