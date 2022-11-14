<?php

declare(strict_types=1);

namespace Primak\CustomerLog\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;

/**
 * class Config
 */
class Config
{
    /**
     * @var ScopeConfigInterface
     */
    protected ScopeConfigInterface $scopeConfig;

    /**
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig
    )
    {
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * @return mixed
     */
    public function getSendEmailStatus()
    {
        return $this->scopeConfig->getValue(
            'customer_connexions/track_customer/track_customer_connexions',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * @return mixed
     */
    public function getEmailForSend()
    {
        return $this->scopeConfig->getValue(
            'customer_connexions/track_customer/email',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * @return mixed
     */
    public function getStoreEmailAddress()
    {
        return $this->scopeConfig->getValue(
            'trans_email/ident_support/email',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }
}
