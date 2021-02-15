<?php

namespace src\Client\Application\Services;

use Illuminate\Container\Container;
use Illuminate\Http\Request;
use src\Shared\Application\Services\BaseHttpService;

class FindPharmacyHttpService extends BaseHttpService
{
    const SUCCESS_CODE = 201;
    const ERROR_FALLBACK_CODE = 400;

    /**
     * Find pharmacy repository
     *
     * @var ClientRepository
     */
    protected $service;

    public function __construct(Container $container)
    {
        parent::__construct($container);
    }

    protected function setService() {
        $this->service = $this->container->make(FindPharmacyService::class);
    }

    protected function getInputsFromRequest(Request $request)
    {
        return $request->only(['name']);
    }
}