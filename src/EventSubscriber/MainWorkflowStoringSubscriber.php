<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\ExpressionLanguage\ExpressionLanguage;

class MainWorkflowStoringSubscriber extends AbstractWorkflowSubscriber
{
    protected $entityManager = null;
    protected $propertyAccessor = null;
    protected $expressionLanguage = null;

    public function __construct(\Symfony\Component\Workflow\Registry $workflowsRegistry, \Doctrine\ORM\EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->propertyAccessor = PropertyAccess::createPropertyAccessor();
        $this->expressionLanguage = new ExpressionLanguage();

        parent::__construct($workflowsRegistry);
    }

    public function onWorkflowMainTransitionStoring($event)
    {

        $data = $event->getSubject()->getData();
        $dataMap = $event->getWorkflow()->getMetadataStore()->getWorkflowMetadata()['data_map'];

        foreach($dataMap as $entityName => $attributes)
        {
            $entity = new $entityName();
            foreach($attributes as $key => $value)
            {
                $this->propertyAccessor->setValue($entity, $key,
                    $this->expressionLanguage->evaluate($value, ['json' => $data])
                );
            }
            $this->entityManager->persist($entity);
        }

        $this->entityManager->flush();
    }

    public static function getSubscribedEvents()
    {
        return [
            'workflow.main.transition.storing' => 'onWorkflowMainTransitionStoring',
        ];
    }
}
