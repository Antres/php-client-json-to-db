<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class WorkflowNextStepSubscriber extends AbstractWorkflowSubscriber implements EventSubscriberInterface
{

    public function onWorkflowEntered($event)
    {
        $workflow = $this->workflowsRegistry->get($event->getSubject(), $event->getWorkflowName());
        $transitions = $workflow->getEnabledTransitions($event->getSubject());

        if( count($transitions) == 1 )
        {
            $workflow->apply($event->getSubject(), $transitions[0]->getName());
        }

        $workflow->getMetadataStore()->getWorkflowMetadata();
    }

    public static function getSubscribedEvents()
    {
        return [
            'workflow.entered' => 'onWorkflowEntered',
        ];
    }
}
