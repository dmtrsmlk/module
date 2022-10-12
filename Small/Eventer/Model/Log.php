<?php
declare(strict_types=1);
namespace Small\Eventer\Model;

use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;
use Small\Eventer\Model\ResourceModel\Log as LogResource;

class Log extends AbstractModel implements IdentityInterface
{
    const CACHE_TAG = 'custom_log';

    const ENTITY_ID = 'entity_id';

    const ENTITY = 'entity';

    const NAME = 'name';

    const USERNAME = 'username';

    protected $_cacheTag = 'custom_log';

    protected $_eventPrefix = 'custom_log';

    protected function _construct()
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
     * @return array
     */
    public function getUsername()
    {
        return $this->getData(self::USERNAME);
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
     * @param $username
     * @return Log
     */
    public function setUsername($username)
    {
        return $this->setData(self::USERNAME, $username);
    }
}

