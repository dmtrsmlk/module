<?php
declare(strict_types=1);

use Magento\Framework\Model\AbstractModel;

class EventLogCategoryService extends AbstractModel
{
    public function __construct(
        \Small\Eventer\Model\LogFactory $logFactory,
        \Small\Eventer\Model\ResourceModel\Log $log
    )
    {
        $this->logFactory = $logFactory;
        $this->log=$log;
    }

    /**
     * @param $eventData
     * @return void
     */
    public function execute($eventData)
    {
        //extract data from $eventData and set to $log object
        $log = $this->logFactory->create();
        $log->setId();
        $log->setName();
        $this->logResource->save($log);
    }

}
