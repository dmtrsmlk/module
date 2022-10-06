<?php
declare(strict_types=1);

namespace Small\EventLogger\Model\ResourceModel\Log;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'log_id';
    protected $_eventPrefix = 'log_collection';
    protected $_eventObject = 'log_collection';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Small\EventLogger\Model\Log', 'Small\EventLogger\Model\ResourceModel\Log');
    }
}
