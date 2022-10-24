<?php

declare(strict_types=1);

namespace Small\Eventer\Model;

use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;
use Small\Eventer\Model\ResourceModel\Log as LogResource;

class Log extends AbstractModel implements IdentityInterface
{
    private const CACHE_TAG = 'custom_log';
    private const LOG_ID = 'log_id';
    private const ENTITY_ID = 'entity_id';
    private const ENTITY = 'entity';
    private const NAME = 'name';
    private const USERNAME = 'username';
    private const KEY_CREATED_AT = 'created_at';
    private const KEY_UPDATED_AT = 'updated_at';
    private const KEY_STORE = 'store';
    private const ACTION = 'action';
    protected $_cacheTag = 'custom_log';
    protected $_eventPrefix = 'custom_log';

    protected function _construct()
    {
        $this->_init(LogResource::class);
    }

    /**
     * @return string[]
     */
    public function getIdentities(): array
    {
        return [self::CACHE_TAG.'_'.$this->getId()];
    }

    /**
     * @return int
     */
    public function getLogId(): int
    {
        return $this->getData(self::LOG_ID);
    }

    /**
     * @return array
     */
    public function getDefaultValues(): array
    {
        return [];
    }

    /**
     * @return array
     */
    public function getEntityId(): array
    {
        return $this->getData(self::ENTITY_ID);
    }

    /**
     * @return array
     */
    public function getEntity(): array
    {
        return $this->getData(self::ENTITY);
    }

    /**
     * @return array
     */
    public function getName(): array
    {
        return $this->getData(self::NAME);
    }

    /**
     * @return Log
     */
    public function getCreatedAt(): Log
    {
        return $this->setData(self::KEY_CREATED_AT);
    }

    /**
     * @return array
     */
    public function getUsername(): array
    {
        return $this->getData(self::USERNAME);
    }

    /**
     * @return Log
     */
    public function getStore(): Log
    {
        return $this->setData(self::KEY_STORE);
    }

    /**
     * @return Log
     */
    public function getAction(): Log
    {
        return $this->setData(self::ACTION);
    }

    /**
     * @param $logId
     * @return Log
     */
    public function setLogId($logId): Log
    {
        return $this->setData(self::LOG_ID, $logId);
    }

    /**
     * @param $entityId
     * @return Log
     */
    public function setEntityId($entityId): Log
    {
        return $this->setData(self::ENTITY_ID, $entityId);
    }

    /**
     * @param string $entity
     * @return Log
     */
    public function setEntity(string $entity): Log
    {
        return $this->setData(self::ENTITY, $entity);
    }

    /**
     * @param $name
     * @return Log
     */
    public function setName($name)
    {
        return $this->setData(self::NAME, $name);
    }

    /**
     * Set created at
     *
     * @param string $createdAt
     * @return $this
     */
    public function setCreatedAt($createdAt)
    {
        return $this->setData(self::KEY_CREATED_AT, $createdAt);
    }

    /**
     * @param $username
     * @return Log
     */
    public function setUsername($username)
    {
        return $this->setData(self::USERNAME, $username);
    }

    /**
     * @param $store
     * @return Log
     */
    public function setStore($store)
    {
        return $this->setData(self::KEY_STORE, $store);
    }

    /**
     * @param $action
     * @return Log
     */
    public function setAction($action)
    {
        return $this->setData(self::ACTION, $action);
    }

}

