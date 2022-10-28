<?php

namespace Small\Eventer\Model\Log\Source;

use Magento\Framework\Data\OptionSourceInterface;
use Small\Eventer\Model\Log;

/**
 * Class IsActive
 */
class IsActive implements OptionSourceInterface
{

    /**
     * @var Log
     */
    protected Log $cmsPage;

    /**
     * @param Log $cmsPage
     */
    public function __construct(\Small\Eventer\Model\Log $cmsPage)
    {
        $this->cmsPage = $cmsPage;
    }

    /**
     * Get options
     *
     * @return array
     */
    public function toOptionArray()
    {
        $availableOptions = $this->cmsPage->getAvailableStatuses();
        $options = [];
        foreach ($availableOptions as $key => $value) {
            $options[] = [
                'label' => $value,
                'value' => $key,
            ];
        }
        return $options;
    }
}
