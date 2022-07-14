<?php

namespace App\Http\Controllers\Api\User\NetsantralApi;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\NetsantralApi\NetsantralApiController\GetSantralRequest;
use App\Interfaces\NetsantralApi\INetsantralApiService;
use App\Traits\Response;

class NetsantralApiController extends Controller
{
    use Response;

    /**
     * @var $netsantralApiService
     */
    private $netsantralApiService;

    /**
     * @param INetsantralApiService $netsantralApiService
     */
    public function __construct(INetsantralApiService $netsantralApiService)
    {
        $this->netsantralApiService = $netsantralApiService;
    }

    /**
     * @param GetSantralRequest $request
     */
    public function getSantral(GetSantralRequest $request)
    {
        $getSantralResponse = $this->netsantralApiService->callQueues();
        if ($getSantralResponse->isSuccess()) {
            return $this->success(
                $getSantralResponse->getMessage(),
                $getSantralResponse->getData(),
                $getSantralResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getSantralResponse->getMessage(),
                $getSantralResponse->getStatusCode()
            );
        }
    }
}
