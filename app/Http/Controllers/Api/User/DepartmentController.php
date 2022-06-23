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

    private $departmentService;

    public function __construct(IDepartmentService $departmentService)
    {
        $this->departmentService = $departmentService;
    }

    public function getAll(GetAllRequest $request)
    {
        return $this->success('Departments', $this->departmentService->getAll());
    }

    public function getById(GetByIdRequest $request)
    {
        return $this->success('Department', $this->departmentService->getById(
            $request->id
        ));
    }

    public function getByBranchId(GetByBranchIdRequest $request)
    {
        return $this->success('Departments', $this->departmentService->getByBranchId(
            $request->branchId
        ));
    }

    public function create(CreateRequest $request)
    {
        return $this->success('Department created', $this->departmentService->create(
            $request->branchId,
            $request->name
        ));
    }

    public function update(UpdateRequest $request)
    {
        return $this->success('Department updated', $this->departmentService->update(
            $request->id,
            $request->name
        ));
    }

    public function delete(DeleteRequest $request)
    {
        return $this->success('Department deleted', $this->departmentService->delete(
            $request->id
        ));
    }
}
