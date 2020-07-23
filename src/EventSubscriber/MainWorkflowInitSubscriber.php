<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class MainWorkflowInitSubscriber extends AbstractWorkflowSubscriber implements EventSubscriberInterface
{
    public function onWorkflowMainTransitionInit($event)
    {
        $workflow = $this->workflowsRegistry->get($event->getSubject(), $event->getWorkflowName());
        
    }

    public static function getSubscribedEvents()
    {
        return [
            'workflow.main.transition.init' => 'onWorkflowMainTransitionInit',
        ];
    }
}
