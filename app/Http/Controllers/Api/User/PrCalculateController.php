<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\PrCalculateController\CalculateRequest;

use App\Interfaces\Eloquent\IPRCalculate;

use App\Traits\Response;

class PrCalculateController extends Controller
{
    use Response;

    /**
     * @var $prCalculateService
     */
    private $prCalculateService;

    /**
     * @param IPRCalculate $prCalculateService
     */
    public function __construct(IPRCalculate $prCalculateService)
    {
        $this->prCalculateService = $prCalculateService;
    }


    public function calculate(CalculateRequest $request)
    {
        $response = $this->prCalculateService->calculate(
            $request->prCardId,
            $request->date,
            $request->calculateType
        );
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
