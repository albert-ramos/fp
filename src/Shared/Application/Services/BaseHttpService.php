<?php

namespace src\Shared\Application\Services;

use Illuminate\Container\Container;
use Illuminate\Http\Request;
use src\Client\Application\Http\Responses\JSONResponse;
use src\Client\Application\Services\AddClientsPointsService;
use src\Shared\Application\Http\Exceptions\ErrorWhileProcessingHttpException;

class BaseHttpService
{
    const SUCCESS_CODE = 200;
    const ERROR_FALLBACK_CODE = 400;

    protected $container;


    /**
     * Client repository
     *
     * @var ClientRepository
     */
    protected $service;

    public function __construct(Container $container)
    {

        $this->container = $container;
        $this->setService();
    }

    protected function setService() {
        $this->service = $this->container->make(AddClientsPointsService::class);
    }

    public function response(Request $request) {
        try {
            return $this->handleSuccess($request);
        } catch(ErrorWhileProcessingHttpException $e) {
            return $this->handleException($e);
        }
    }

    protected function getInputsFromRequest(Request $request)
    {
        return $request->all();
    }

    protected function handleSuccess(Request $request)
    {
        return JSONResponse::send($this->service->handleInput($this->getInputsFromRequest($request)), self::SUCCESS_CODE);
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