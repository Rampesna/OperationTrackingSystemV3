<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\PunishmentController\GetByEmployeeIdRequest;
use App\Http\Requests\Api\User\PunishmentController\GetByIdRequest;
use App\Http\Requests\Api\User\PunishmentController\CreateRequest;
use App\Http\Requests\Api\User\PunishmentController\UpdateRequest;
use App\Http\Requests\Api\User\PunishmentController\DeleteRequest;
use App\Interfaces\Eloquent\IPunishmentService;
use App\Traits\Response;

class PunishmentController extends Controller
{
    use Response;

    /**
     * @var $punishmentService
     */
    private $punishmentService;

    /**
     * @param IPunishmentService $punishmentService
     */
    public function __construct(IPunishmentService $punishmentService)
    {
        $this->punishmentService = $punishmentService;
    }

    /**
     * @param GetByEmployeeIdRequest $request
     */
    public function getByEmployeeId(GetByEmployeeIdRequest $request)
    {
        $getByEmployeeIdResponse = $this->punishmentService->getByEmployeeId(
            $request->employeeId,
            $request->pageIndex,
            $request->pageSize
        );
        if ($getByEmployeeIdResponse->isSuccess()) {
            return $this->success(
                $getByEmployeeIdResponse->getMessage(),
                $getByEmployeeIdResponse->getData(),
                $getByEmployeeIdResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getByEmployeeIdResponse->getMessage(),
                $getByEmployeeIdResponse->getStatusCode()
            );
        }
    }

    /**
     * @param GetByIdRequest $request
     */
    public function getById(GetByIdRequest $request)
    {
        $getByIdResponse = $this->punishmentService->getById(
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
     * @param CreateRequest $request
     */
    public function create(CreateRequest $request)
    {
        $createResponse = $this->punishmentService->create(
            $request->employeeId,
            $request->categoryId,
            $request->date,
            $request->description,
            $request->moneyDeduction
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
        $updateResponse = $this->punishmentService->update(
            $request->id,
            $request->categoryId,
            $request->date,
            $request->description,
            $request->moneyDeduction
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
        $updateResponse = $this->punishmentService->delete(
            $request->id
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
}
