<?php
declare(strict_types=1);

class CategoryResourcePlugin
{
    /**
     * @param EventLogCategoryService $eventLogCategoryService
     */
    public function __construct(EventLogCategoryService $eventLogCategoryService)
    {
        $this->eventLogCategoryService = $eventLogCategoryService;
    }

    /**
     * @param $subject
     * @param $category
     * @return void
     */
    private function afterSave($subject, $category)
    {
        $eventData = [$subject, $category];
        $this->eventLogCategoryService->execute($eventData);
    }
}
