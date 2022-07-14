<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Interfaces\Eloquent\ITitleService;
use App\Http\Requests\Api\User\TitleController\GetAllRequest;
use App\Http\Requests\Api\User\TitleController\GetByIdRequest;
use App\Http\Requests\Api\User\TitleController\GetByDepartmentIdRequest;
use App\Http\Requests\Api\User\TitleController\CreateRequest;
use App\Http\Requests\Api\User\TitleController\UpdateRequest;
use App\Http\Requests\Api\User\TitleController\DeleteRequest;
use App\Traits\Response;

class TitleController extends Controller
{
    use Response;

    /**
     * @var $titleService
     */
    private $titleService;

    /**
     * @param ITitleService $titleService
     */
    public function __construct(ITitleService $titleService)
    {
        $this->titleService = $titleService;
    }

    /**
     * @param GetAllRequest $request
     */
    public function getAll(GetAllRequest $request)
    {
        $getAllResponse = $this->titleService->getAll();
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
        $getByIdResponse = $this->titleService->getById(
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
     * @param GetByDepartmentIdRequest $request
     */
    public function getByDepartmentId(GetByDepartmentIdRequest $request)
    {
        $getByDepartmentIdResponse = $this->titleService->getByDepartmentId(
            $request->departmentId
        );
        if ($getByDepartmentIdResponse->isSuccess()) {
            return $this->success(
                $getByDepartmentIdResponse->getMessage(),
                $getByDepartmentIdResponse->getData(),
                $getByDepartmentIdResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getByDepartmentIdResponse->getMessage(),
                $getByDepartmentIdResponse->getStatusCode()
            );
        }
    }

    /**
     * @param CreateRequest $request
     */
    public function create(CreateRequest $request)
    {
        $createResponse = $this->titleService->create(
            $request->departmentId,
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
        $updateResponse = $this->titleService->update(
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
        $deleteResponse = $this->titleService->delete(
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
