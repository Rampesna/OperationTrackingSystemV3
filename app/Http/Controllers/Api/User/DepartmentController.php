<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Interfaces\Eloquent\IDepartmentService;
use App\Http\Requests\Api\User\DepartmentController\GetAllRequest;
use App\Http\Requests\Api\User\DepartmentController\GetByIdRequest;
use App\Http\Requests\Api\User\DepartmentController\GetByBranchIdRequest;
use App\Http\Requests\Api\User\DepartmentController\CreateRequest;
use App\Http\Requests\Api\User\DepartmentController\UpdateRequest;
use App\Http\Requests\Api\User\DepartmentController\DeleteRequest;
use App\Traits\Response;

class DepartmentController extends Controller
{
    use Response;

    /**
     * @var $departmentService
     */
    private $departmentService;

    /**
     * @param IDepartmentService $departmentService
     */
    public function __construct(IDepartmentService $departmentService)
    {
        $this->departmentService = $departmentService;
    }

    /**
     * @param GetAllRequest $request
     */
    public function getAll(GetAllRequest $request)
    {
        $getAllResponse = $this->departmentService->getAll();
        if ($getAllResponse->isSuccess()) {
            return $this->success(
                $getAllResponse->getMessage(),
                $getAllResponse->getData(),
                $getAllResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getAllResponse->getMessage(),
                $getAllResponse->getStatusCode()
            );
        }
    }

    /**
     * @param GetByIdRequest $request
     */
    public function getById(GetByIdRequest $request)
    {
        $getByIdResponse = $this->departmentService->getById(
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
     * @param GetByBranchIdRequest $request
     */
    public function getByBranchId(GetByBranchIdRequest $request)
    {
        $getByBranchIdResponse = $this->departmentService->getByBranchId(
            $request->branchId
        );
        if ($getByBranchIdResponse->isSuccess()) {
            return $this->success(
                $getByBranchIdResponse->getMessage(),
                $getByBranchIdResponse->getData(),
                $getByBranchIdResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getByBranchIdResponse->getMessage(),
                $getByBranchIdResponse->getStatusCode()
            );
        }
    }

    /**
     * @param CreateRequest $request
     */
    public function create(CreateRequest $request)
    {
        $createResponse = $this->departmentService->create(
            $request->branchId,
            $request->name
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
        $updateResponse = $this->departmentService->update(
            $request->id,
            $request->name
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
        $deleteResponse = $this->departmentService->delete(
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
