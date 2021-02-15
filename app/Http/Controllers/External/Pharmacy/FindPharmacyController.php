<?php

namespace App\Http\Controllers\External\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use src\Client\Application\Services\FindPharmacyHttpService;

class FindPharmacyController extends Controller
{

    protected $httpService;

    public function __construct(FindPharmacyHttpService $httpService)
    {
        $this->httpService = $httpService;
    }
 
    public function __invoke(Request $request)
    {
        return $this->httpService->response($request);
    }
}
