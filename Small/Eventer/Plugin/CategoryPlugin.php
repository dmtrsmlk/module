<?php

declare(strict_types=1);

namespace Small\Eventer\Plugin;

use Magento\Catalog\Model\ResourceModel\Category;
use Magento\Framework\Exception\NoSuchEntityException;
use Small\Eventer\Model\EventLogCategoryService;

class CategoryPlugin
{
    public function __construct(private EventLogCategoryService $eventLogCategoryService)
    {}

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
    ): Category {
        $eventData = $category->getData(); //some data from category
        $this->eventLogCategoryService->execute($eventData);

        return $result;
    }
}
