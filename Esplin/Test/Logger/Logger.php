<?php

declare(strict_types=1);

namespace Esplin\Test\Logger;

/**
 * Logger channel
 */
class Logger extends \Monolog\Logger
{
    /**
     * @inheritDoc
     */
    public function addRecord($level, $message, array $context = [])
    {
        return parent::addRecord($level, $message, $context);
    }
}
