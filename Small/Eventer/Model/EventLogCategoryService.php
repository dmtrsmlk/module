<?php
declare(strict_types=1);

namespace Small\Eventer\Model;

use Magento\Framework\Model\AbstractModel;


class EventLogCategoryService extends AbstractModel
{
    /**
     * @var \Magento\Backend\Model\Auth\Session
     */
    private \Magento\Backend\Model\Auth\Session $_authSession;

    /**
     * @var LogFactory
     */
    private $logFactory;

    /**
     * @var ResourceModel\Log
     */
    private $logResource;

    /**
     * @var \Magento\Framework\Stdlib\DateTime\TimezoneInterface
     */
    private $timezone;

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    private $storeManager;

    public function __construct(
        \Small\Eventer\Model\LogFactory $logFactory,
        \Small\Eventer\Model\ResourceModel\Log $logResource,
        \Magento\Framework\Stdlib\DateTime\TimezoneInterface $timezone,
        \Magento\Backend\Model\Auth\Session $authSession,
        \Magento\Store\Model\StoreManagerInterface $storeManager
    )
    {
        $this->_authSession = $authSession;
        $this->logFactory = $logFactory;
        $this->logResource = $logResource;
        $this->timezone = $timezone;
        $this->storeManager = $storeManager;
    }


    /**
     * @param $eventData
     * @return void
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function execute($eventData) :void
    {
        //@TODO: Add values at setStore() and setAction(), split getUsername() and getTimestamp()
        //extract data from $eventData and set to $log object
        $storeName = $this->storeManager->getStore()->getName();
        $date = $this->timezone->date()->format('Y-m-d H:m:s');
        $username = $this->_authSession->getUser()->getUserName();
        $log = $this->logFactory->create();
        $log->setId($eventData['entity_id']+60);
        $log->setEntityId($eventData['entity_id']);
        $log->setEntity('category');
        $log->setName($eventData['name']);
        $log->setCreatedAt($date);
        $log->setUsername($username);
        $log->setStore($storeName.' Store');
        $log->setAction('create');
        $this->logResource->save($log);
    }

}
