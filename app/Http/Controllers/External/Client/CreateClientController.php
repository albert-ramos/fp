<?php

namespace App\Http\Controllers\External\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\CreateClientRequest;
use src\Client\Application\Services\CreateClientHttpService;

class CreateClientController extends Controller
{

    protected $httpService;

    public function __construct(CreateClientHttpService $httpService)
    {
        $this->httpService = $httpService;
    }
 
    public function __invoke(CreateClientRequest $request)
    {
        return $this->httpService->response($request);
    }
}
