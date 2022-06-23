<?php

declare(strict_types=1);

namespace Esplin\Test\Api\Data;

interface TestInterface
{
    const COLUMN_ID          = 'entity_id';

    const COLUMN_CREATED_AT  = 'created_at';

    const COLUMN_UPDATED_AT  = 'updated_at';

    const COLUMN_NAME        = 'name';

    /**
     * Get Id
     *
     * @return mixed
     */
    public function getId();

    /**
     * @return string
     */
    public function getCreatedAt();

    /**
     * @return string
     */
    public function getUpdatedAt();

    /**
     * @return string
     */
    public function getName();

}
