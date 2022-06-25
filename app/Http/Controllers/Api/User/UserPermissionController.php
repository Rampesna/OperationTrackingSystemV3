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

    private $userPermissionService;

    public function __construct(IUserPermissionService $userPermissionService)
    {
        $this->userPermissionService = $userPermissionService;
    }

    public function getAll(GetAllRequest $request)
    {
        return $this->success('User permissions', $this->userPermissionService->getAll());
    }

    public function getById(GetByIdRequest $request)
    {
        return $this->success('User permissions', $this->userPermissionService->getById(
            $request->id
        ));
    }

    public function getByTopId(GetByTopIdRequest $request)
    {
        return $this->success('User permissions', $this->userPermissionService->getByTopId(
            $request->topId
        ));
    }
}
