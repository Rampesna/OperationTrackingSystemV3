<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Interfaces\Eloquent\IFoodListService;
use App\Http\Requests\Api\User\FoodListController\GetDateBetweenRequest;
use App\Http\Requests\Api\User\FoodListController\GetByIdRequest;
use App\Http\Requests\Api\User\FoodListController\ReportRequest;
use App\Http\Requests\Api\User\FoodListController\CreateRequest;
use App\Http\Requests\Api\User\FoodListController\UpdateRequest;
use App\Http\Requests\Api\User\FoodListController\DeleteRequest;
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
        $getDateBetweenResponse = $this->foodListService->getDateBetween(
            $request->companyIds,
            $request->startDate,
            $request->endDate
        );
        if ($getDateBetweenResponse->isSuccess()) {
            return $this->success(
                $getDateBetweenResponse->getMessage(),
                $getDateBetweenResponse->getData(),
                $getDateBetweenResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getDateBetweenResponse->getMessage(),
                $getDateBetweenResponse->getStatusCode()
            );
        }
    }

    /**
     * @param GetByIdRequest $request
     */
    public function getById(GetByIdRequest $request)
    {
        $getByIdResponse = $this->foodListService->getById(
            $request->id
        );
        if ($getByIdResponse->isSuccess()) {
            return $this->success(
                $getByIdResponse->getMessage(),
                $getByIdResponse->getData(),
                $getByIdResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getByIdResponse->getMessage(),
                $getByIdResponse->getStatusCode()
            );
        }
    }

    /**
     * @param ReportRequest $request
     */
    public function report(ReportRequest $request)
    {
        $reportResponse = $this->foodListService->report(
            $request->companyIds,
            $request->startDate,
            $request->endDate
        );
        if ($reportResponse->isSuccess()) {
            return $this->success(
                $reportResponse->getMessage(),
                $reportResponse->getData(),
                $reportResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $reportResponse->getMessage(),
                $reportResponse->getStatusCode()
            );
        }
    }

    /**
     * @param CreateRequest $request
     */
    public function create(CreateRequest $request)
    {
        $createResponse = $this->foodListService->create(
            $request->companyId,
            $request->name,
            $request->description,
            $request->date,
            $request->count
        );
        if ($createResponse->isSuccess()) {
            return $this->success(
                $createResponse->getMessage(),
                $createResponse->getData(),
                $createResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $createResponse->getMessage(),
                $createResponse->getStatusCode()
            );
        }
    }

    /**
     * @param UpdateRequest $request
     */
    public function update(UpdateRequest $request)
    {
        $updateResponse = $this->foodListService->update(
            $request->id,
            $request->name,
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
    }

    /**
     * @param DeleteRequest $request
     */
    public function delete(DeleteRequest $request)
    {
        $deleteResponse = $this->foodListService->delete(
            $request->id
        );
        if ($deleteResponse->isSuccess()) {
            return $this->success(
                $deleteResponse->getMessage(),
                $deleteResponse->getData(),
                $deleteResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $deleteResponse->getMessage(),
                $deleteResponse->getStatusCode()
            );
        }
    }
}
