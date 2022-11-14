<?php

declare(strict_types=1);

namespace Primak\CustomerLog\Block\Adminhtml;

use Magento\Backend\Block\Template;
use Primak\CustomerLog\Api\ManagementInterface as Management;

/**
 * class CustomerLogData
 */
class CustomerLogData extends Template
{
    /**
     * @var Management
     */
    protected Management $management;

    /**
     * @param Template\Context $context
     * @param Management $management
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        Management       $management,
        array            $data = [])
    {
        $this->management = $management;
        parent::__construct($context, $data);
    }

    /**
     * @param $customerId
     * @return string
     */
    public function returnIp($customerId): string
    {
        $data = $this->management->getLastIp((int)$customerId);
        $ip = '';
        foreach ($data as $item) {
            if (isset($item['ip'])) {
                $ip = $item['ip'];
            }
        }
        return $ip;
    }
}
