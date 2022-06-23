<?php

namespace Esplin\Test\Model;

use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;
use Esplin\Test\Api\Data\TestInterface;

class Test extends AbstractModel implements IdentityInterface, TestInterface
{
    const CACHE_TAG = 'esplin_test_test';

    protected $_cacheTag    = 'esplin_test_test';

    protected $_eventPrefix = 'esplin_test_test';

    protected $_eventObject = 'test';

    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(ResourceModel\Test::class);
    }

    /**
     * @inheritDoc
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    public function getId()
    {
        return $this->getData(self::COLUMN_ID);
    }

    public function getName()
    {
        return $this->getData(self::COLUMN_NAME);
    }

    public function getCreatedAt()
    {
        return $this->getData(self::COLUMN_CREATED_AT);
    }

    public function getUpdatedAt()
    {
        return $this->getData(self::COLUMN_UPDATED_AT);
    }
}