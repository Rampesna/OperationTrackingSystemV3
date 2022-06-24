<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Interfaces\Eloquent\IUserRoleService;
use App\Http\Requests\Api\User\UserRoleController\GetAllRequest;
use App\Http\Requests\Api\User\UserRoleController\GetAllUserRolesRequest;
use App\Http\Requests\Api\User\UserRoleController\GetByIdRequest;
use App\Traits\Response;

class UserRoleController extends Controller
{
    use Response;

    private $userRoleService;

    public function __construct(IUserRoleService $userRoleService)
    {
        $this->userRoleService = $userRoleService;
    }

    public function getAll(GetAllRequest $request)
    {
        return $this->success('User roles', $this->userRoleService->getAll());
    }

    public function getAllUserRoles(GetAllUserRolesRequest $request)
    {
        return $this->success('User roles', $this->userRoleService->getAllUserRoles(
            $request->pageIndex,
            $request->pageSize,
            $request->keyword
        ));
    }

    public function getById(GetByIdRequest $request)
    {
        return $this->success('User role', $this->userRoleService->getById(
            $request->id
        ));
    }
}
