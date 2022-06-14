<?php

namespace App\Http\Controllers\Api\User\NetsantralApi;

use App\Http\Controllers\Controller;
use App\Interfaces\NetsantralApi\INetsantralApiService;
use App\Traits\Response;

class NetsantralApiController extends Controller
{
    use Response;

    private $netsantralApiService;

    public function __construct(INetsantralApiService $netsantralApiService)
    {
        $this->netsantralApiService = $netsantralApiService;
    }

    public function getSantral()
    {
        return $this->success('Santral', $this->netsantralApiService->callQueues());
    }
}
