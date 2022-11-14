<?php

declare(strict_types=1);

namespace Primak\CustomerLog\Model;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * class TrackResource
 */
class TrackResource extends AbstractDb
{
    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init('customer_connexion_logs', 'entity_id');
    }
}
