<?php

declare(strict_types=1);

namespace Primak\CustomerLog\Cron;

use Primak\CustomerLog\Model\Config;
use Primak\CustomerLog\Model\EmailSender;
use Primak\CustomerLog\Api\ManagementInterface as Management;

/**
 * class SendLogs
 */
class SendLogs
{
    /**
     * @var Config
     */
    protected Config $config;

    /**
     * @var EmailSender
     */
    protected EmailSender $emailSender;

    /**
     * @var Management
     */
    protected Management $management;

    /**
     * @param Config $config
     * @param EmailSender $emailSender
     * @param Management $management
     */
    public function __construct(
        Config $config,
        EmailSender $emailSender,
        Management $management
    )
    {
        $this->config = $config;
        $this->emailSender = $emailSender;
        $this->management = $management;
    }

    /**
     * @return void
     */
    public function execute()
    {
        if ($this->config->getSendEmailStatus())
        {
            $this->emailSender->sendEmail($this->management->getTrackLogsQty());
        }
    }
}
