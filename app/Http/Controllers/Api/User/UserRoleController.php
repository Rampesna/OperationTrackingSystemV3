<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Interfaces\Eloquent\IUserRoleService;
use App\Http\Requests\Api\User\UserRoleController\GetAllRequest;
use App\Http\Requests\Api\User\UserRoleController\GetAllUserRolesRequest;
use App\Http\Requests\Api\User\UserRoleController\GetByIdRequest;
use App\Http\Requests\Api\User\UserRoleController\GetUserPermissionsRequest;
use App\Http\Requests\Api\User\UserRoleController\SetUserPermissionsRequest;
use App\Http\Requests\Api\User\UserRoleController\CreateRequest;
use App\Http\Requests\Api\User\UserRoleController\UpdateRequest;
use App\Http\Requests\Api\User\UserRoleController\DeleteRequest;
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

    public function getUserPermissions(GetUserPermissionsRequest $request)
    {
        return $this->success('User role user permissions', $this->userRoleService->getUserPermissions(
            $request->roleId
        ));
    }

    public function setUserPermissions(SetUserPermissionsRequest $request)
    {
        return $this->success('Set user role user permissions', $this->userRoleService->setUserPermissions(
            $request->roleId,
            $request->userPermissionIds
        ));
    }

    public function create(CreateRequest $request)
    {
        return $this->success('User role created', $this->userRoleService->create(
            $request->name
        ));
    }

    public function update(UpdateRequest $request)
    {
        return $this->success('User role updated', $this->userRoleService->update(
            $request->id,
            $request->name
        ));
    }

    public function delete(DeleteRequest $request)
    {
        return $this->success('User role deleted', $this->userRoleService->delete(
            $request->id
        ));
    }
}
