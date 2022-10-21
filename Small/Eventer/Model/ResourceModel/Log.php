<?php
declare(strict_types=1);
namespace Small\Eventer\Model\ResourceModel;

use Magento\Framework\EntityManager\EntityManager;
use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Magento\Framework\Model\ResourceModel\Db\Context;

class Log extends AbstractDb
{
    /**
     * @var EntityManager
     */
    private EntityManager $entityManager;

    private const TABLE = 'admin_log';

    private const PRIMARY_KEY = 'log_id';

    public function __construct(
        Context $context,
        EntityManager $entityManager
    )
    {
        parent::__construct($context);
        $this->entityManager = $entityManager;
    }

    protected function _construct()
    {
        $this->_init(self::TABLE, self::PRIMARY_KEY);
    }

    /**
     * @param AbstractModel $object
     * @param $value
     * @param $field
     * @return $this|Log
     */
    public function load(AbstractModel $object, $value, $field = null)
    {
        //@TODO: Fix the "Unknown entity type: Small\Eventer\Model\Log requested", caused by EntityManager
        $this->entityManager->load($object, $value);
        return $this;
    }

    /**
     * @param AbstractModel $object
     * @return $this|Log
     * @throws \Exception
     */
    public function save(\Magento\Framework\Model\AbstractModel $object)
    {
        $this->entityManager->save($object);
        return $this;
    }

    /**
     * @param AbstractModel $object
     * @return $this|Log
     * @throws \Exception
     */
    public function delete(AbstractModel $object)
    {
        $this->entityManager->delete($object);
        return $this;
    }

}
