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
     * If save(), load(), delete will be implemented, do:
     * 1. Create ReposioryInterface -> Small\Eventer\Api
     * 2. Create Repository -> Small\Eventer\Model
     * !!!DO NOT CREATE CRUD METHODS IN ResourceModel!!!
     */
    private const TABLE = 'admin_log';

    private const PRIMARY_KEY = 'log_id';

    public function __construct(
        Context $context
    )
    {
        parent::__construct($context);
    }

    protected function _construct()
    {
        $this->_init(self::TABLE, self::PRIMARY_KEY);
    }

}
