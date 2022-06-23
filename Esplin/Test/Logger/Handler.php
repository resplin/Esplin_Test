<?php

declare(strict_types=1);

namespace Esplin\Test\Logger;

use Magento\Framework\Filesystem\Driver\File as FileDriver;
use Magento\Framework\Logger\Handler\Base as LoggerHandlerBase;
use Monolog\Logger;

/**
 * Logger handler
 */
class Handler extends LoggerHandlerBase
{
    protected $loggerType = Logger::INFO;

    protected $fileName = '/var/log/Esplin_Test.log';

    protected $filesystem = FileDriver::class;
}
