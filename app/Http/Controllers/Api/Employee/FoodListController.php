<?php

namespace App\Http\Controllers\Api\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Employee\FoodListController\GetDateBetweenRequest;
use App\Interfaces\Eloquent\IFoodListService;
use App\Traits\Response;

class FoodListController extends Controller
{
    use Response;

    /**
     * @var $foodListService
     */
    private $foodListService;

    /**
     * @param IFoodListService $foodListService
     */
    public function __construct(IFoodListService $foodListService)
    {
        $this->foodListService = $foodListService;
    }

    /**
     * @param GetDateBetweenRequest $request
     */
    public function getDateBetween(GetDateBetweenRequest $request)
    {
        return $this->success('Employee food list checks', $this->foodListService->getDateBetween(
            $request->companyIds,
            $request->startDate,
            $request->endDate
        ));
    }
}
