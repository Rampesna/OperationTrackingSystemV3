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

    /**
     * @var $foodListCheckService
     */
    private $foodListCheckService;

    /**
     * @param IFoodListCheckService $foodListCheckService
     */
    public function __construct(IFoodListCheckService $foodListCheckService)
    {
        $this->foodListCheckService = $foodListCheckService;
    }

    /**
     * @param GetDateBetweenRequest $request
     */
    public function getDateBetween(GetDateBetweenRequest $request)
    {
        $employeeFoodListChecks = $this->foodListCheckService->getDateBetween(
            $request->user()->id,
            $request->start_date,
            $request->end_date
        );
        if ($employeeFoodListChecks->isSuccess()) {
            return $this->success(
                $employeeFoodListChecks->getMessage(),
                $employeeFoodListChecks->getData(),
                $employeeFoodListChecks->getStatusCode()
            );
        } else {
            return $this->error(
                $employeeFoodListChecks->getMessage(),
                $employeeFoodListChecks->getStatusCode()
            );
        }
    }

    /**
     * @param GetByIdRequest $request
     */
    public function getById(GetByIdRequest $request)
    {
        $foodListCheck = $this->foodListCheckService->getById(
            $request->id
        );
        if ($foodListCheck->isSuccess()) {
            if (!$foodListCheck->getData() || $foodListCheck->getData()->employee_id != $request->user()->id) {
                return $this->error('Food list check not found', 404);
            }
            return $this->success(
                $foodListCheck->getMessage(),
                $foodListCheck->getData(),
                $foodListCheck->getStatusCode()
            );
        } else {
            return $this->error(
                $foodListCheck->getMessage(),
                $foodListCheck->getStatusCode()
            );
        }
    }

    /**
     * @param UpdateRequest $request
     */
    public function update(UpdateRequest $request)
    {
        $foodListCheck = $this->foodListCheckService->getById(
            $request->id
        );
        if ($foodListCheck->isSuccess()) {
            if (!$foodListCheck->getData() || $foodListCheck->getData()->employee_id != $request->user()->id) {
                return $this->error('Food list check not found', 404);
            }
            $updateResponse = $this->foodListCheckService->update(
                $request->id,
                $request->checked,
                $request->liked,
                $request->count,
                $request->description
            );
            if ($updateResponse->isSuccess()) {
                return $this->success(
                    $updateResponse->getMessage(),
                    $updateResponse->getData(),
                    $updateResponse->getStatusCode()
                );
            } else {
                return $this->error(
                    $updateResponse->getMessage(),
                    $updateResponse->getStatusCode()
                );
            }
        } else {
            return $this->error(
                $foodListCheck->getMessage(),
                $foodListCheck->getStatusCode()
            );
        }
    }
}
