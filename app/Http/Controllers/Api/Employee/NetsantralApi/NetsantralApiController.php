<?php

namespace App\Http\Controllers\Api\Employee\NetsantralApi;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Employee\NetsantralApi\NetsantralApiController\AbandonsRequest;
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
     * @param AbandonsRequest $request
     */
    public function abandons(AbandonsRequest $request)
    {
        $abandonsResponse = $this->netsantralApiService->abandons(
            $request->queueShort
        );
        if ($abandonsResponse->isSuccess()) {
            return $this->success(
                $abandonsResponse->getMessage(),
                $abandonsResponse->getData(),
                $abandonsResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $abandonsResponse->getMessage(),
                $abandonsResponse->getStatusCode()
            );
        }
    }
}
