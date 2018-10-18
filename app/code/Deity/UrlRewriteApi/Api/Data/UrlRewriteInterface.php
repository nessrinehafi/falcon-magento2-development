<?php
declare(strict_types=1);

namespace Deity\UrlRewriteApi\Api\Data;

/**
 * Interface UrlRewriteInterface
 *
 * @package Deity\UrlRewriteApi\Api\Data
 */
interface UrlRewriteInterface
{
    const ENTITY_TYPE = 'entity_type';
    const ENTITY_ID   = 'entity_id';
    const CANONICAL_URL = 'canonical_url';

    /**
     * @return string
     */
    public function getEntityType(): string;

    /**
     * @param string $entityType
     * @return void
     */
    public function setEntityType($entityType): void;

    /**
     * @return int
     */
    public function getEntityId(): int;

    /**
     * @param int $id
     * @return void
     */
    public function setEntityId($id): void;

    /**
     * @return string
     */
    public function getCanonicalUrl(): string;

    /**
     * @param string $url
     * @return void
     */
    public function setCanonicalUrl(string $url): void;
}
