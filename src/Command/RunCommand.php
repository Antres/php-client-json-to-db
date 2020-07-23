<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class RunCommand extends Command
{
    protected static $defaultName = 'app:run';

    protected $workflowsRegistry = null;
    protected $workflowSubject = null;

    public function __construct(\Symfony\Component\Workflow\Registry $workflowsRegistry, \App\WorkflowSubject\MainWorkflowSubject $mainWorkflowSubject)
    {
        $this->workflowsRegistry = $workflowsRegistry;
        $this->workflowSubject = $mainWorkflowSubject;

        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDescription('Start a workflow')
            ->addArgument('workflow_name', InputArgument::REQUIRED, 'Name of workflow to start')
            ->addOption('state', 's', InputOption::VALUE_REQUIRED, 'Set the initial state', 'start')
            ->addOption('transition', 't', InputOption::VALUE_REQUIRED, 'Set the transition to exectute', 'init')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $workflowName = $input->getArgument('workflow_name');

        $subject = $this->workflowSubject;
        $subject->setCurrentPlace($input->getOption('state'));
        $workflow = $this->workflowsRegistry->get($subject, $workflowName);
        $workflow->apply($subject, $input->getOption('transition'));

	$workflow->getEnabledTransitions($subject);

        return 0;
    }
}
