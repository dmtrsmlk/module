<?php

declare(strict_types=1);

namespace Small\Eventer\Plugin;

use Magento\Cms\Model\ResourceModel\Block;
use Magento\Framework\Exception\NoSuchEntityException;
use Small\Eventer\Model\EventLogService;

class BlockPlugin
{
    public function __construct(private EventLogService $eventLogService)
    {
    }

    /**
     * @param Block $subject
     * @param Block $result
     * @param $block
     * @return Block
     * @throws NoSuchEntityException
     */
    public function afterSave(
        Block $subject,
        Block $result,
        $block
    ): Block
    {

        $eventData = $block->getData();
        $objectData = $block->getOrigData();
        $entityType = 'block';
        $objectData['update_time'] = null;

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
                $eventData['entity_id'] = $eventData['block_id'];
                $eventData['name'] = $eventData['title'];
                $this->eventLogService->execute($eventData);
        }
        return $result;
    }

    /**
     * @param Block $subject
     * @param Block $result
     * @param $block
     * @return Block
     * @throws NoSuchEntityException
     */
    public function afterDelete(
        Block $subject,
        Block $result,
        $block
    ): Block
    {
        $eventData = $block->getData();
        $objectData = $block->getOrigData();
        $entityType = 'block';
        $eventData['action'] = 'Delete';
        $eventData['entity'] = $entityType;
        $eventData['entity_id'] = $eventData['block_id'];
        $eventData['name'] = $eventData['title'];
        $this->eventLogService->execute($eventData);

        return $result;
    }
}
