<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\PrResultController\GetResultRequest;
use App\Interfaces\Eloquent\IPrResultService;
use App\Traits\Response;

class PrResultController extends Controller
{
    use Response;

    /**
     * @var $prResultService
     */
    private $prResultService;

    /**
     * @param IPrResultService $prResultService
     */
    public function __construct(IPrResultService $prResultService)
    {
        $this->prResultService = $prResultService;
    }

    public function getResult(GetResultRequest $request)
    {
        $response = $this->prResultService->getResult($request->cardId, $request->date);
        if ($response->isSuccess()) {
            return $this->success(
                $response->getMessage(),
                $response->getData(),
                $response->getStatusCode()
            );
        } else {
            return $this->error(
                $response->getMessage(),
                $response->getStatusCode()
            );
        }
    }



}
