<?php

namespace App\Http\Controllers\External\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\ClientAddPointsRequest;
use src\Client\Application\Services\AddClientsPointsHttpService;

class AddPointsToClientController extends Controller
{

    protected $httpService;

    public function __construct(AddClientsPointsHttpService $httpService)
    {
        $this->httpService = $httpService;
    }
 
    public function __invoke(ClientAddPointsRequest $request)
    {
        return $this->httpService->response($request);
    }
}
