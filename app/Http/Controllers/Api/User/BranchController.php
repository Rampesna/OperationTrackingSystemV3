<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Interfaces\Eloquent\IBranchService;
use App\Http\Requests\Api\User\BranchController\GetAllRequest;
use App\Http\Requests\Api\User\BranchController\GetByIdRequest;
use App\Http\Requests\Api\User\BranchController\GetByCompanyIdRequest;
use App\Http\Requests\Api\User\BranchController\CreateRequest;
use App\Http\Requests\Api\User\BranchController\UpdateRequest;
use App\Http\Requests\Api\User\BranchController\DeleteRequest;
use App\Traits\Response;

class BranchController extends Controller
{
    use Response;

    /**
     * @var $branchService
     */
    private $branchService;

    /**
     * @param IBranchService $branchService
     */
    public function __construct(IBranchService $branchService)
    {
        $this->branchService = $branchService;
    }

    /**
     * @param GetAllRequest $request
     */
    public function getAll(GetAllRequest $request)
    {
        $getAllResponse = $this->branchService->getAll();
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
        $getByIdResponse = $this->branchService->getById(
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
     * @param GetByCompanyIdRequest $request
     */
    public function getByCompanyId(GetByCompanyIdRequest $request)
    {
        $getByCompanyIdResponse = $this->branchService->getByCompanyId(
            $request->companyId
        );
        if ($getByCompanyIdResponse->isSuccess()) {
            return $this->success(
                $getByCompanyIdResponse->getMessage(),
                $getByCompanyIdResponse->getData(),
                $getByCompanyIdResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getByCompanyIdResponse->getMessage(),
                $getByCompanyIdResponse->getStatusCode()
            );
        }
    }

    /**
     * @param CreateRequest $request
     */
    public function create(CreateRequest $request)
    {
        $createResponse = $this->branchService->create(
            $request->companyId,
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
        $updateResponse = $this->branchService->update(
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
        $deleteResponse = $this->branchService->delete(
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
