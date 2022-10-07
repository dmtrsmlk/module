<?php
declare(strict_types=1);
namespace Small\Eventer\Model;

use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;

class Log extends AbstractModel implements IdentityInterface
{
    const CACHE_TAG = 'custom_log';

    protected $_cacheTag = 'custom_log';

    protected $_eventPrefix = 'custom_log';

    protected function _construct()
    {
        $this->_init('\Small\Eventer\Model\ResourceModel\Log');
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG.'_'.$this->getId()];
    }

    public function getDefaultValues()
    {
        $values = [];

        return $values;
    }
}
