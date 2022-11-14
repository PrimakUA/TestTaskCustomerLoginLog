<?php

declare(strict_types=1);

namespace Primak\CustomerLog\Model;

use Magento\Framework\Model\AbstractModel;
use Primak\CustomerLog\Api\Data\TrackInterface;

/**
 * class Track
 */
class Track extends AbstractModel implements TrackInterface
{

    public const CUSTOMER_ID = 'customer_id';

    public const IP = 'ip';

    public const CREATED_AT = 'created_at';

    public const UPDATED_AT = 'updated_at';

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init(TrackResource::class);
    }

    /**
     * @return int
     */
    public function getCustomerId(): int
    {
        return (int)$this->getData(self::CUSTOMER_ID);
    }

    /**
     * @return string
     */
    public function getIp(): string
    {
        return (string)$this->getData(self::IP);
    }

    /**
     * @return string
     */
    public function getCreatedAt(): string
    {
        return (string)$this->getData(self::CREATED_AT);
    }

    /**
     * @return string
     */
    public function getUpdatedAt(): string
    {
        return (string)$this->getData(self::UPDATED_AT);
    }
}
