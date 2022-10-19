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

    public function afterSave(\Magento\Catalog\Model\ResourceModel\Category $subject, $category)
    /*@TODO Add smth to get values */
    {
        $eventData = $subject; //some data from category
        $this->eventLogCategoryService->execute($eventData);
    }
}
