<?php

declare(strict_types=1);

namespace Primak\CustomerLog\Api;

use Primak\CustomerLog\Api\Data\TrackInterface;

/**
 * @api
 */
interface ManagementInterface
{

    /**
     * @param int $customerId
     * @return TrackInterface
     */
    public function getByCustomerId(int $customerId): TrackInterface;

    /**
     * @param $customerId
     * @param $ip
     */
    public function saveTrack($customerId, $ip);
}
