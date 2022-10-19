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
    protected $entityManager;

    private const TABLE = 'admin_log';

    private const PRIMARY_KEY = 'log_id';

    public function __construct(Context $context)
    {
        parent::__construct($context);
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
        //@TODO: Fix the shitty method
        $this->entityManager->load($object, $value);
        return $this;
    }

    /**
     * @param AbstractModel $object
     * @return $this|Log
     * @throws \Exception
     */
    public function save(AbstractModel $object)
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
