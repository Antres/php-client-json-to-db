<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class MainWorkflowFetchingSubscriber implements EventSubscriberInterface
{
    public function onWorkflowMainTransitionFetching($event)
    {
        $data = json_decode($event->getSubject()->getClientJson()->request('GET', '')->getContent());

        $event->getSubject()->setData($data);
        \dump($data);
    }

    public static function getSubscribedEvents()
    {
        return [
            'workflow.main.transition.fetching' => 'onWorkflowMainTransitionFetching',
        ];
    }
}
