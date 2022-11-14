<?php

declare(strict_types=1);

namespace Primak\CustomerLog\Model;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 * class TrackCollection
 */
class TrackCollection extends AbstractCollection
{
    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init(Track::class, TrackResource::class);
    }
}
