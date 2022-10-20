<?php
declare(strict_types=1);

namespace Small\Eventer\Model;

use Magento\Framework\Model\AbstractModel;


class EventLogCategoryService extends AbstractModel
{
    /**
     * @var \Magento\Backend\Model\Auth\Session
     */
    protected \Magento\Backend\Model\Auth\Session $_authSession;

    /**
     * @var LogFactory
     */
    protected $logFactory;

    /**
     * @var ResourceModel\Log
     */
    protected $logResource;

    /**
     * @var \Magento\Framework\Stdlib\DateTime\TimezoneInterface
     */
    protected $timezone;

    public function __construct(
        \Small\Eventer\Model\LogFactory $logFactory,
        \Small\Eventer\Model\ResourceModel\Log $logResource,
        \Magento\Framework\Stdlib\DateTime\TimezoneInterface $timezone,
        \Magento\Backend\Model\Auth\Session $authSession
    )
    {
        $this->_authSession = $authSession;
        $this->logFactory = $logFactory;
        $this->logResource = $logResource;
        $this->timezone = $timezone;
    }


    public function execute($eventData)
    {
        //@TODO: Add values at setStore() and setAction(), split getUsername() and getTimestamp()
        //extract data from $eventData and set to $log object
        $date = $this->timezone->date()->format('Y-m-d H:m:s');
        $username = $this->_authSession->getUser()->getUserName();
        $log = $this->logFactory->create();
        $log->setEntityId($eventData['entity_id']);
        $log->setEntity('category');
        $log->setName($eventData['name']);
        $log->setCreatedAt($date);
        $log->setUsername($username);
        $log->setStore('default store');
        $log->setAction('create');
        $this->logResource->save($log);
        return $log;
    }

}
