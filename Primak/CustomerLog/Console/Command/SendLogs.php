<?php

declare(strict_types=1);

namespace Primak\CustomerLog\Console\Command;

use Primak\CustomerLog\Cron\SendLogs as Logs;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * class SendLogs
 */
class SendLogs extends Command
{
    /**
     * @var Logs
     */
    public Logs $logs;

    /**
     * @param Logs $logs
     * @param null $name
     */
    public function __construct(
        Logs $logs,
             $name = null
    )
    {
        $this->logs = $logs;
        parent::__construct($name);
    }

    /**
     * @return void
     */
    protected function configure()
    {
        $this->setName('login:send')
            ->setDescription(__('Send Email with qty logins'));

        parent::configure();
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln(__('Start Email sends')->getText());
        $this->logs->execute();
        $output->writeln(__('Done!')->getText());
    }
}
