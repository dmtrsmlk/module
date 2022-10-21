<?php
declare(strict_types=1);

namespace Small\Eventer\Plugin;

use Small\Eventer\Model\EventLogCategoryService;

class CategoryPlugin
{

    public function __construct(EventLogCategoryService $eventLogCategoryService)
    {
        $this->eventLogCategoryService = $eventLogCategoryService;
    }

    /**
     * @param \Magento\Catalog\Model\ResourceModel\Category $subject
     * @param $result
     * @param $category
     * @return void
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function afterSave(\Magento\Catalog\Model\ResourceModel\Category $subject, $result, $category) :void
    {
        $eventData = $category->getData(); //some data from category
        $this->eventLogCategoryService->execute($eventData);
    }
}
