<?php

declare(strict_types=1);

namespace Small\Eventer\Plugin;

use Magento\Framework\Model\AbstractModel;
use Magento\Catalog\Model\ResourceModel\Category;
use Magento\Framework\Exception\NoSuchEntityException;
use Small\Eventer\Model\EventLogCategoryService;

class CategoryPlugin
{
    public function __construct(private EventLogCategoryService $eventLogCategoryService)
    {
    }


//    /**
//     * @param Category $subject
//     * @param AbstractModel $object
//     * @return AbstractModel
//     */
//    public function beforeSave(
//        Category $subject,
//        AbstractModel $object
//    ): AbstractModel
//    {
//        $objectData = $object->getOrigData();
////        $this->eventLogCategoryService->compare($objectData);
//
//        return $objectData;
//    }

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
        $eventData = $category->getData(); //some data from category
        $objectData = $category->getOrigData();
        if($objectData === null)
        {
            $eventData['action'] = 'Create';
        }
        else {
            $eventData['action'] = 'Update';
        }
        $this->eventLogCategoryService->execute($eventData); //compare() w/o execute()

        return $result;
    }

    public function afterDelete(
        Category $subject,
        Category $result,
                 $category
    )
    {
//        $eventData = $category->getData(); //some data from category
//        $objectData = $category->getOrigData();
//        $this->eventLogCategoryService->execute($eventData); //compare() w/o execute()
        return $result;
    }
}
