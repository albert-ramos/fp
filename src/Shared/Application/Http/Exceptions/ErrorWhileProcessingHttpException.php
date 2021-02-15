<?php

namespace src\Shared\Application\Http\Exceptions;

use Exception;

class ErrorWhileProcessingHttpException extends Exception
{
    protected $code = 100;
    protected $message = 'Something went wrong while processing your request';
    protected const HTTP_STATUS = 400;
}