<?php

namespace App\Http\Controllers\External\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\ConsumeClientPointsRequest;
use src\Client\Application\Services\ConsumeClientPointsHttpService;

class ConsumeClientPointsController extends Controller
{

    protected $httpService;

    public function __construct(ConsumeClientPointsHttpService $httpService)
    {
        $this->httpService = $httpService;
    }
 
    public function __invoke(ConsumeClientPointsRequest $request)
    {
        return $this->httpService->response($request);
    }
}
