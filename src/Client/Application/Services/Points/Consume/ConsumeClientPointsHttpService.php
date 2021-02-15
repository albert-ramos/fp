<?php

namespace src\Client\Application\Services;

use Illuminate\Http\Request;
use Illuminate\Container\Container;
use src\Shared\Application\Services\BaseHttpService;

class ConsumeClientPointsHttpService extends BaseHttpService
{
    /**
     * Consume client points repo
     *
     * @var ClientRepository
     */
    protected $service;

    public function __construct(Container $container)
    {
        parent::__construct($container);
    }

    protected function setService() {
        $this->service = $this->container->make(ConsumeClientPointsService::class);
    }

    protected function getInputsFromRequest(Request $request)
    {
        return $request->only(['pharmacy_id', 'client_id', 'points']);
    }
}