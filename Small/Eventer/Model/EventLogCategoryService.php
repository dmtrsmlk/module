<?php
declare(strict_types=1);

namespace Small\Eventer\Model;

use Magento\Framework\Model\AbstractModel;
use Small\Eventer\Model\ResourceModel\Log as LogResource;

class EventLogCategoryService extends AbstractModel
{
    /**
     * @param LogFactory $logFactory
     * @param LogResource $logResource
     */
    public function __construct(
        \Small\Eventer\Model\LogFactory $logFactory,
        LogResource $logResource
    )
    {
        $this->logFactory = $logFactory;
        $this->logResource = $logResource;
    }


    public function execute($eventData)
    {
        //extract data from $eventData and set to $log object
        $log = $this->logFactory->create();
        $log->setId(0);
        $log->setName('test1');
        $this->logResource->save($log);
    }

}
