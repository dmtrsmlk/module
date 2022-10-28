<?php

declare(strict_types=1);

namespace Small\Eventer\Api\Data;

interface LogInterface
{
    const CACHE_TAG = 'custom_log';
    const LOG_ID = 'log_id';
    const ENTITY_ID = 'entity_id';
    const ENTITY = 'entity';
    const NAME = 'name';
    const USERNAME = 'username';
    const KEY_CREATED_AT = 'created_at';
    const KEY_UPDATED_AT = 'updated_at';
    const KEY_STORE = 'store';
    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 0;
    const ACTION = 'action';

    public function getLogId(): int;

    /**
     * @return array
     */
    public function getDefaultValues(): array;

    /**
     * @return array
     */
    public function getEntityId(): array;

    /**
     * @return array
     */
    public function getEntity(): array;

    /**
     * @return array
     */
    public function getName(): array;

    /**
     * @return object
     */
    public function getCreatedAt(): object;

    /**
     * @return array
     */
    public function getUsername(): array;

    /**
     * @return object
     */
    public function getStore(): object;

    public function getAvailableStatuses(): array;

    /**
     * @return object
     */
    public function getAction(): object;
    /**
     * @param $objectId
     * @return object
     */
    public function setLogId($objectId): object;

    /**
     * @param $entityId
     * @return object
     */
    public function setEntityId($entityId): object;

    /**
     * @param string $entity
     * @return object
     */
    public function setEntity(string $entity): object;
    /**
     * @param $name
     * @return object
     */
    public function setName($name): object;

    /**
     * Set created at
     *
     * @param string $createdAt
     * @return $this
     */
    public function setCreatedAt($createdAt): static;
    /**
     * @param $username
     * @return object
     */
    public function setUsername($username): object;

    /**
     * @param $store
     * @return object
     */
    public function setStore($store): object;

    /**
     * @param $action
     * @return object
     */
    public function setAction($action): object;
}
