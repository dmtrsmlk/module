<?php
declare(strict_types=1);

namespace Small\Eventer\Model\ResourceModel\Log;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Small\Eventer\Model\ResourceModel\Log;


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
        $this->_init('Small\Eventer\Model\Log', Log::class);
    }
}
