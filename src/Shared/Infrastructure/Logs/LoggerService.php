<?php

namespace src\Shared\Infrastructure;

use Illuminate\Log\Logger;

class LoggerService
{
    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }

    /**
     * Writes log 
     *
     * @param [type] $exception
     * @return void
     */
    public function debug($exception)
    {
        $this->logger->debug($exception, debug_backtrace());
    }
    
}
