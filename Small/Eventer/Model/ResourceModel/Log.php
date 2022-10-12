<?php
declare(strict_types=1);
namespace Small\Eventer\Model\ResourceModel;

use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Magento\Framework\Model\ResourceModel\Db\Context;

class Log extends AbstractDb
{
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

    public function load(AbstractModel $object, $value, $field = null)
    {

//        $this->entityManager->load($object);
        return $this;
    }

    public function save(AbstractModel $object)
    {
        $this->entityManager->save($object);
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function delete(AbstractModel $object)
    {
        $this->entityManager->delete($object);
        return $this;
    }

}
