<?php
declare(strict_types=1);
namespace Small\Eventer\Model;

use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;
use Small\Eventer\Model\ResourceModel\Log as LogResource;

class Log extends AbstractModel implements IdentityInterface
{
    private const CACHE_TAG = 'custom_log';

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

    private function _construct()
    {
        $this->_init(LogResource::class);
    }

    /**
     * @return string[]
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG.'_'.$this->getId()];
    }

    /**
     * @return array
     */
    public function getDefaultValues()
    {
        $values = [];
        return $values;
    }

    /**
     * @return array
     */
    public function getEntityId()
    {
        return $this->getData(self::ENTITY_ID);
    }

    /**
     * @return array
     */
    public function getEntity()
    {
        return $this->getData(self::ENTITY);
    }

    /**
     * @return array
     */
    public function getName()
    {
        return $this->getData(self::NAME);
    }

    /**
     * @return Log
     */
    public function getCreatedAt()
    {
        return $this->setData(self::KEY_CREATED_AT);
    }

    /**
     * @return array
     */
    public function getUsername()
    {
        return $this->getData(self::USERNAME);
    }

    /**
     * @return Log
     */
    public function getStore()
    {
        return $this->setData(self::KEY_STORE);
    }

    /**
     * @return Log
     */
    public function getAction()
    {
        return $this->setData(self::ACTION);
    }
    /**
     * @param $entity_id
     * @return Log
     */
    public function setEntityId($entity_id)
    {
        return $this->setData(self::ENTITY_ID, $entity_id);
    }

    /**
     * @param $entity
     * @return Log
     */
    public function setEntity($entity)
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

