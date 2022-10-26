<?php

declare(strict_types=1);

namespace Small\Eventer\Plugin;

use Magento\Catalog\Model\ResourceModel\Category;
use Magento\Framework\Exception\NoSuchEntityException;
use Small\Eventer\Model\EventLogService;

class CategoryPlugin
{
    public function __construct(private EventLogService $eventLogCategoryService)
    {
    }

    /**
     * @param Category $subject
     * @param Category $result
     * @param $category
     * @return Category
     * @throws NoSuchEntityException
     */
    public function afterSave(
        Category $subject,
        Category $result,
                 $category
    ): Category
    {
        $eventData = $category->getData();
        $objectData = $category->getOrigData();
        $entityType = $result->getType();
        if($objectData === null)
        {
            $eventData['action'] = 'Create';
        }
        else {
            $eventData['action'] = 'Update';
        }
        $eventData['entity'] = $entityType;
        $this->eventLogCategoryService->execute($eventData);

        return $result;
    }

    /**
     * @param Category $subject
     * @param Category $result
     * @param $category
     * @return Category
     * @throws NoSuchEntityException
     */
    public function afterDelete(
        Category $subject,
        Category $result,
                 $category
    ): Category
    {
        $eventData = $category->getData();
        $objectData = $category->getOrigData();
        $entityType = $result->getType();
        $eventData['action'] = 'Delete';
        $eventData['entity'] = $entityType;
        $this->eventLogCategoryService->execute($eventData);

        return $result;
    }
}
