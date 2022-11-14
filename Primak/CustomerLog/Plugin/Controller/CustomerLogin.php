<?php

declare(strict_types=1);

namespace Primak\CustomerLog\Plugin\Controller;

use Primak\CustomerLog\Api\ManagementInterface as Management;
use Magento\Customer\Controller\Account\LoginPost;
use Magento\Customer\Model\Session;
use Magento\Framework\HTTP\PhpEnvironment\RemoteAddress;

/**
 * class CustomerLogin
 */
class CustomerLogin
{
    /**
     * @var Session
     */
    protected Session $session;

    /**
     * @var Management
     */
    protected Management $management;

    /**
     * @var RemoteAddress
     */
    protected RemoteAddress $remoteAddress;

    /**
     * @param Session $session
     * @param Management $management
     * @param RemoteAddress $remoteAddress
     */
    public function __construct(
        Session       $session,
        Management    $management,
        RemoteAddress $remoteAddress
    )
    {
        $this->session = $session;
        $this->management = $management;
        $this->remoteAddress = $remoteAddress;
    }

    /**
     * @param LoginPost $subject
     * @param $result
     * @return mixed
     */
    public function afterExecute(LoginPost $subject, $result)
    {
        if ($this->session->isLoggedIn()) {
            $this->management->saveTrack($this->session->isLoggedIn(), $this->remoteAddress->getRemoteAddress());
        }
        return $result;
    }
}
