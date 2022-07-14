<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Interfaces\Eloquent\IUserPermissionService;
use App\Http\Requests\Api\User\UserPermissionController\GetAllRequest;
use App\Http\Requests\Api\User\UserPermissionController\GetByIdRequest;
use App\Http\Requests\Api\User\UserPermissionController\GetByTopIdRequest;
use App\Traits\Response;

class UserPermissionController extends Controller
{
    use Response;

    /**
     * @var $userPermissionService
     */
    private $userPermissionService;

    /**
     * @param IUserPermissionService $userPermissionService
     */
    public function __construct(IUserPermissionService $userPermissionService)
    {
        $this->userPermissionService = $userPermissionService;
    }

    /**
     * @param GetAllRequest $request
     */
    public function getAll(GetAllRequest $request)
    {
        $getAllResponse = $this->userPermissionService->getAll();
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
        $getByIdResponse = $this->userPermissionService->getById(
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
     * @param GetByTopIdRequest $request
     */
    public function getByTopId(GetByTopIdRequest $request)
    {
        $getByTopIdResponse = $this->userPermissionService->getByTopId(
            $request->topId
        );
        if ($getByTopIdResponse->isSuccess()) {
            return $this->success(
                $getByTopIdResponse->getMessage(),
                $getByTopIdResponse->getData(),
                $getByTopIdResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getByTopIdResponse->getMessage(),
                $getByTopIdResponse->getStatusCode()
            );
        }
    }
}
