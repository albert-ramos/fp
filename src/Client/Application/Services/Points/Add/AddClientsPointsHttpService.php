<?php

namespace src\Client\Application\Services;

use Illuminate\Http\Request;
use src\Client\Application\Http\Responses\JSONResponse;
use src\Shared\Application\Http\Exceptions\ErrorWhileProcessingHttpException;

class AddClientsPointsHttpService 
{
    const SUCCESS_CODE = 201;
    const ERROR_FALLBACK_CODE = 400;

    /**
     * Clients points service
     *
     * @var AddClientsPointsService
     */
    private $service;

    public function __construct(AddClientsPointsService $service)
    {
        $this->service = $service;
    }

    public function response(Request $request) {
        try {
            return $this->handleSuccess($request);
        } catch(ErrorWhileProcessingHttpException $e) {
            return $this->handleException($e);
        }
    }

    protected function handleSuccess(Request $request)
    {
        return JSONResponse::send($this->service->handleInput($request->all()), self::SUCCESS_CODE);
    }

    protected function handleException(ErrorWhileProcessingHttpException $exception)
    {
        return JSONResponse::send(
            [
            'message' => $exception->getMessage()
            ],
            boolval($exception->getCode()) ? $exception->getCode() : self::ERROR_FALLBACK_CODE
        );
    }

}