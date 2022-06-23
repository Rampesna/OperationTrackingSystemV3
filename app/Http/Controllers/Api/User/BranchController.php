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

    private $branchService;

    public function __construct(IBranchService $branchService)
    {
        $this->branchService = $branchService;
    }

    public function getAll(GetAllRequest $request)
    {
        return $this->success('Branches', $this->branchService->getAll());
    }

    public function getById(GetByIdRequest $request)
    {
        return $this->success('Branch', $this->branchService->getById(
            $request->id
        ));
    }

    public function getByCompanyId(GetByCompanyIdRequest $request)
    {
        return $this->success('Branches', $this->branchService->getByCompanyId(
            $request->companyId
        ));
    }

    public function create(CreateRequest $request)
    {
        return $this->success('Branch created', $this->branchService->create(
            $request->companyId,
            $request->name
        ));
    }

    public function update(UpdateRequest $request)
    {
        return $this->success('Branch updated', $this->branchService->update(
            $request->id,
            $request->name
        ));
    }

    public function delete(DeleteRequest $request)
    {
        return $this->success('Branch deleted', $this->branchService->delete(
            $request->id
        ));
    }
}
