<?php

declare(strict_types=1);

namespace Small\Eventer\Plugin;

use Magento\Cms\Model\ResourceModel\Page;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Small\Eventer\Model\EventLogService;

class PagePlugin
{
    public function __construct(private EventLogService $eventLogService)
    {
    }


    /**
     * @param Page $subject
     * @param Page $result
     * @param $page
     * @return Page
     * @throws NoSuchEntityException
     * @throws LocalizedException
     */
    public function afterSave(
        Page $subject,
        Page $result,
        $page
    ): Page
    {
        $eventData = $page->getData();
        $objectData = $page->getOrigData();
        $entityType = 'page';

        if($objectData!==null){
            $objectData = array_merge($eventData, $objectData);
            $objectData['update_time'] = null;
        }

        if ($objectData!==$eventData) {
            if ($objectData === null) {
                $eventData['action'] = 'Create';
            } else {
                $eventData['action'] = 'Update';
            }
            $eventData['entity'] = $entityType;
            $eventData['entity_id'] = $eventData['page_id'];
            $eventData['name'] = $eventData['title'];

            $this->eventLogService->execute($eventData);
        }

        return $result;
    }

    /**
     * @param Page $subject
     * @param Page $result
     * @param $page
     * @return Page
     * @throws NoSuchEntityException
     */
    public function afterDelete(
        Page $subject,
        Page $result,
                 $page
    ): Page
    {
        $eventData = $page->getData();
        $objectData = $page->getOrigData();
        $entityType = 'page';
        $eventData['action'] = 'Delete';
        $eventData['entity'] = $entityType;
        $eventData['entity_id'] = $eventData['page_id'];
        $eventData['name'] = $eventData['title'];
        $this->eventLogService->execute($eventData);

        return $result;
    }
}
