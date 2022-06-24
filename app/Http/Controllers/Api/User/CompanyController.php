<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\CompanyController\GetUsersByCompanyIdsRequest;
use App\Http\Requests\Api\User\CompanyController\TreeRequest;
use App\Http\Requests\Api\User\CompanyController\GetByIdRequest;
use App\Http\Requests\Api\User\CompanyController\CreateRequest;
use App\Http\Requests\Api\User\CompanyController\UpdateRequest;
use App\Interfaces\Eloquent\ICompanyService;
use App\Traits\Response;

class CompanyController extends Controller
{
    use Response;

    private $companyService;

    public function __construct(ICompanyService $companyService)
    {
        $this->companyService = $companyService;
    }

    public function getUsersByCompanyIds(GetUsersByCompanyIdsRequest $request)
    {
        $userCompanies = $request->user()->companies()->pluck('id')->toArray();

        foreach ($request->companyIds as $companyId) {
            if (!in_array($companyId, $userCompanies)) {
                return $this->error('Company not found', 404);
            }
        }

        return $this->success('Users', $this->companyService->getUsersByCompanyIds(
            $request->companyIds,
            $request->pageIndex,
            $request->pageSize,
            $request->keyword
        ));
    }

    public function tree(TreeRequest $request)
    {
        return $this->success('Company tree', $this->companyService->tree(
            $request->id
        ));
    }

    public function getById(GetByIdRequest $request)
    {
        return $this->success('Company', $this->companyService->getById(
            $request->id
        ));
    }

    public function create(CreateRequest $request)
    {
        return $this->success('Company created', $this->companyService->create(
            $request->title,
            $request->taxOffice,
            $request->taxNumber,
            $request->recordNumber,
            $request->commercialCompanyId,
            $request->uyumCrmCompanyId,
            $request->uyumCrmBranchId,
            $request->uyumCrmBranchCode,
            $request->activeYear
        ));
    }

    public function update(UpdateRequest $request)
    {
        return $this->success('Company updated', $this->companyService->update(
            $request->id,
            $request->title,
            $request->taxOffice,
            $request->taxNumber,
            $request->recordNumber,
            $request->commercialCompanyId,
            $request->uyumCrmCompanyId,
            $request->uyumCrmBranchId,
            $request->uyumCrmBranchCode,
            $request->activeYear
        ));
    }
}
