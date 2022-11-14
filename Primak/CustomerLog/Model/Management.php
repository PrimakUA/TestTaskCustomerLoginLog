<?php

declare(strict_types=1);

namespace Primak\CustomerLog\Model;

use Primak\CustomerLog\Api\Data\TrackInterface;
use Primak\CustomerLog\Api\ManagementInterface;
use Primak\CustomerLog\Model\TrackFactory;
use Primak\CustomerLog\Model\TrackResource;
use Magento\Framework\DataObject;
use Primak\CustomerLog\Model\TrackCollectionFactory;
use Magento\Framework\Stdlib\DateTime\DateTime;

/**
 * class Management
 */
class Management implements ManagementInterface
{
    /**
     * @var TrackResource
     */
    private TrackResource $resource;

    /**
     * @var TrackFactory
     */
    private TrackFactory $factory;

    /**
     * @var TrackCollectionFactory
     */
    protected TrackCollectionFactory $trackCollectionFactory;

    /**
     * @var DateTime
     */
    protected DateTime $date;

    /**
     * Management constructor.
     * @param \Primak\CustomerLog\Model\TrackResource $resource
     * @param \Primak\CustomerLog\Model\TrackFactory $trackFactory
     * @param \Primak\CustomerLog\Model\TrackCollectionFactory $trackCollectionFactory
     * @param DateTime $date
     */
    public function __construct(
        TrackResource          $resource,
        TrackFactory           $trackFactory,
        TrackCollectionFactory $trackCollectionFactory,
        DateTime               $date
    )
    {
        $this->resource = $resource;
        $this->factory = $trackFactory;
        $this->trackCollectionFactory = $trackCollectionFactory;
        $this->date = $date;
    }

    /**
     * @param int $customerId
     * @return TrackInterface
     */
    public function getByCustomerId(int $customerId): TrackInterface
    {
        $object = $this->getNewInstance();
        $this->resource->load($object, $customerId, 'customer_id');

        return $object;
    }

    /**
     * @return TrackInterface
     */
    public function getNewInstance(): TrackInterface
    {
        return $this->factory->create();
    }

    /**
     * @param $customerId
     * @param $ip
     * @return void
     */
    public function saveTrack($customerId, $ip)
    {
        $data[] = ['customer_id' => (int)$customerId, 'ip' => (string)$ip];

        $this->resource->getConnection()->insertMultiple($this->resource->getTable('customer_connexion_logs'), $data);
    }

    /**
     * @return int
     */
    public function getTrackLogsQty(): int
    {
        $todayDateTime = $this->date->gmtDate();
        $period = strtotime('-1 day', strtotime($todayDateTime));
        $periodDate = date('Y-m-d H:i:s', $period);

        $collection = $this->trackCollectionFactory->create();
        $collection->addFieldToFilter('created_at', ['from' => $periodDate, 'to' => $todayDateTime]);

        return $collection->count();
    }

    /**
     * @param $customerId
     * @return DataObject
     */
    public function getLastIp($customerId): DataObject
    {
        $collection = $this->trackCollectionFactory->create();
        $collection->addFieldToFilter('customer_id', $customerId);

        return $collection->getLastItem();
    }
}
