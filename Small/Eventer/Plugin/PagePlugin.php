<?php

declare(strict_types=1);

namespace Small\Eventer\Plugin;

use Magento\Cms\Model\ResourceModel\Page;
use Magento\Framework\Exception\NoSuchEntityException;
use Small\Eventer\Model\EventLogService;

class PagePlugin
{
    public function __construct(private EventLogService $eventLogCategoryService)
    {
    }


    /**
     * @param Page $subject
     * @param Page $result
     * @param $page
     * @return Page
     * @throws NoSuchEntityException
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
        if($objectData === null)
        {
            $eventData['action'] = 'Create';
        }
        else {
            $eventData['action'] = 'Update';
        }
        $eventData['entity'] = $entityType;
        $eventData['entity_id'] = $eventData['page_id'];
        $eventData['name'] = $eventData['title'];
        $this->eventLogCategoryService->execute($eventData);

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
        $this->eventLogCategoryService->execute($eventData);

        return $result;
    }
}
