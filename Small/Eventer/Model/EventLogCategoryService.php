<?php
declare(strict_types=1);

namespace Small\Eventer\Model;

use Magento\Framework\Exception\AlreadyExistsException;
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
    private LogFactory $logFactory;

    /**
     * @var ResourceModel\Log
     */
    private ResourceModel\Log $logResource;

    /**
     * @var \Magento\Framework\Stdlib\DateTime\TimezoneInterface
     */
    private \Magento\Framework\Stdlib\DateTime\TimezoneInterface $timezone;

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    private \Magento\Store\Model\StoreManagerInterface $storeManager;

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
        //extract data from $eventData and set to $log object
        $store = $this->storeManager->getStore();
        $storeName = $store ? $store->getName() : null;
        $date = new \DateTime();
        $username = $this->_authSession->getUser()->getUserName();
        $log = $this->logFactory->create();
        $log->setEntityId($eventData['entity_id']);
        $log->setEntity($eventData['_eventPrefix']);
        $log->setName($eventData['name']);
        $log->setCreatedAt($date); // can use $eventData['created_at']
        $log->setUsername($username);
        $log->setStore($storeName . ' Store');
        $log->setAction('Create');
        try {
            $this->logResource->save($log);
        } catch (AlreadyExistsException|\Exception $e) {
            __('Unknown Error');
        }
    }

}
