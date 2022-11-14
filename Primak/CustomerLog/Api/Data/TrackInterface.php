<?php

declare(strict_types=1);

namespace Primak\CustomerLog\Api\Data;

/**
 * @api
 */
interface TrackInterface
{
    /**
     * @return int
     */
    public function getCustomerId(): int;

    /**
     * @return string
     */
    public function getIp(): string;

    /**
     * @return string
     */
    public function getCreatedAt(): string;

    /**
     * @return string
     */
    public function getUpdatedAt(): string;
}
