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

    /**
     * @var $userRoleService
     */
    private $userRoleService;

    /**
     * @param IUserRoleService $userRoleService
     */
    public function __construct(IUserRoleService $userRoleService)
    {
        $this->userRoleService = $userRoleService;
    }

    /**
     * @param GetAllRequest $request
     */
    public function getAll(GetAllRequest $request)
    {
        $getAllResponse = $this->userRoleService->getAll();
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
     * @param GetAllUserRolesRequest $request
     */
    public function getAllUserRoles(GetAllUserRolesRequest $request)
    {
        $getAllUserRolesResponse = $this->userRoleService->getAllUserRoles(
            $request->pageIndex,
            $request->pageSize,
            $request->keyword
        );
        if ($getAllUserRolesResponse->isSuccess()) {
            return $this->success(
                $getAllUserRolesResponse->getMessage(),
                $getAllUserRolesResponse->getData(),
                $getAllUserRolesResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getAllUserRolesResponse->getMessage(),
                $getAllUserRolesResponse->getStatusCode()
            );
        }
    }

    /**
     * @param GetByIdRequest $request
     */
    public function getById(GetByIdRequest $request)
    {
        $getByIdResponse = $this->userRoleService->getById(
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
     * @param GetUserPermissionsRequest $request
     */
    public function getUserPermissions(GetUserPermissionsRequest $request)
    {
        $getUserPermissionsResponse = $this->userRoleService->getUserPermissions(
            $request->roleId
        );
        if ($getUserPermissionsResponse->isSuccess()) {
            return $this->success(
                $getUserPermissionsResponse->getMessage(),
                $getUserPermissionsResponse->getData(),
                $getUserPermissionsResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getUserPermissionsResponse->getMessage(),
                $getUserPermissionsResponse->getStatusCode()
            );
        }
    }

    /**
     * @param SetUserPermissionsRequest $request
     */
    public function setUserPermissions(SetUserPermissionsRequest $request)
    {
        $setUserPermissionsResponse = $this->userRoleService->setUserPermissions(
            $request->roleId,
            $request->userPermissionIds
        );
        if ($setUserPermissionsResponse->isSuccess()) {
            return $this->success(
                $setUserPermissionsResponse->getMessage(),
                $setUserPermissionsResponse->getData(),
                $setUserPermissionsResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $setUserPermissionsResponse->getMessage(),
                $setUserPermissionsResponse->getStatusCode()
            );
        }
    }

    /**
     * @param CreateRequest $request
     */
    public function create(CreateRequest $request)
    {
        $createResponse = $this->userRoleService->create(
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
        $updateResponse = $this->userRoleService->update(
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

    public function delete(DeleteRequest $request)
    {
        $deleteResponse = $this->userRoleService->delete(
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
