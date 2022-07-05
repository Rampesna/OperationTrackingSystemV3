<?php

namespace App\Http\Controllers\Api\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Employee\FoodListCheckController\GetDateBetweenRequest;
use App\Http\Requests\Api\Employee\FoodListCheckController\GetByIdRequest;
use App\Http\Requests\Api\Employee\FoodListCheckController\UpdateRequest;
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

    public function getById(GetByIdRequest $request)
    {
        $foodListCheck = $this->foodListCheckService->getById(
            $request->id
        );

        if (!$foodListCheck || $foodListCheck->employee_id != $request->user()->id) {
            return $this->error('Food list check not found');
        }

        return $this->success('Employee food list checks', $foodListCheck);
    }

    public function update(UpdateRequest $request)
    {
        $foodListCheck = $this->foodListCheckService->getById(
            $request->id
        );

        if (!$foodListCheck || $foodListCheck->employee_id != $request->user()->id) {
            return $this->error('Food list check not found');
        }

        return $this->success('Employee food list check updated', $this->foodListCheckService->update(
            $request->id,
            $request->checked,
            $request->liked,
            $request->count,
            $request->description
        ));
    }
}
