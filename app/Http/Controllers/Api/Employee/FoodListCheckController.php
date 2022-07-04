<?php

namespace App\Http\Controllers\Api\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Employee\FoodListCheckController\GetDateBetweenRequest;
use App\Interfaces\Eloquent\IFoodListCheckService;
use App\Traits\Response;

class FoodListCheckController extends Controller
{
    use Response;

    private $foodListCheckService;

    public function __construct(IFoodListCheckService $foodListCheckService)
    {
        $this->foodListCheckService = $foodListCheckService;
    }

    public function getDateBetween(GetDateBetweenRequest $request)
    {
        return $this->success('Employee food list checks', $this->foodListCheckService->getDateBetween(
            $request->user()->id,
            $request->startDate,
            $request->endDate
        ));
    }
}
