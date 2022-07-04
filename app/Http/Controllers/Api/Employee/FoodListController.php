<?php

namespace App\Http\Controllers\Api\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Employee\FoodListController\GetDateBetweenRequest;
use App\Interfaces\Eloquent\IFoodListService;
use App\Traits\Response;

class FoodListController extends Controller
{
    use Response;

    private $foodListService;

    public function __construct(IFoodListService $foodListService)
    {
        $this->foodListService = $foodListService;
    }

    public function getDateBetween(GetDateBetweenRequest $request)
    {
        return $this->success('Employee food list checks', $this->foodListService->getDateBetween(
            $request->startDate,
            $request->endDate
        ));
    }
}
