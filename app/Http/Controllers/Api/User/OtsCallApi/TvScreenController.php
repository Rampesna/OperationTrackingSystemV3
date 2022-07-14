<?php

namespace App\Http\Controllers\Api\User\OtsCallApi;

use App\Http\Controllers\Controller;
use App\Interfaces\OtsCallApi\ITvScreenService;
use App\Http\Requests\Api\User\OtsCallApi\TvScreenController\GetSantralRequest;
use App\Traits\Response;

class TvScreenController extends Controller
{
    use Response;

    /**
     * @var $tvScreenService
     */
    private $tvScreenService;

    /**
     * @param ITvScreenService $tvScreenService
     */
    public function __construct(ITvScreenService $tvScreenService)
    {
        $this->tvScreenService = $tvScreenService;
    }

    /**
     * @param GetSantralRequest $request
     */
    public function getSantral(GetSantralRequest $request)
    {
        $getSantralResponse = $this->tvScreenService->GetSantral();
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
