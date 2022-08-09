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

    /**
     * @var $companyService
     */
    private $companyService;

    /**
     * @param ICompanyService $companyService
     */
    public function __construct(ICompanyService $companyService)
    {
        $this->companyService = $companyService;
    }

    /**
     * @param GetUsersByCompanyIdsRequest $request
     */
    public function getUsersByCompanyIds(GetUsersByCompanyIdsRequest $request)
    {
        $userCompanies = $request->user()->companies()->pluck('id')->toArray();

        foreach ($request->companyIds as $companyId) {
            if (!in_array($companyId, $userCompanies)) {
                return $this->error('Company not found', 404);
            }
        }

        $getUsersByCompanyIdsResponse = $this->companyService->getUsersByCompanyIds(
            $request->companyIds,
            $request->pageIndex,
            $request->pageSize,
            $request->keyword
        );
        if ($getUsersByCompanyIdsResponse->isSuccess()) {
            return $this->success(
                $getUsersByCompanyIdsResponse->getMessage(),
                $getUsersByCompanyIdsResponse->getData(),
                $getUsersByCompanyIdsResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getUsersByCompanyIdsResponse->getMessage(),
                $getUsersByCompanyIdsResponse->getStatusCode()
            );
        }
    }

    /**
     * @param TreeRequest $request
     */
    public function tree(TreeRequest $request)
    {
        $treeResponse = $this->companyService->tree(
            $request->id
        );
        if ($treeResponse->isSuccess()) {
            return $this->success(
                $treeResponse->getMessage(),
                $treeResponse->getData(),
                $treeResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $treeResponse->getMessage(),
                $treeResponse->getStatusCode()
            );
        }
    }

    /**
     * @param GetByIdRequest $request
     */
    public function getById(GetByIdRequest $request)
    {
        $getByIdResponse = $this->companyService->getById(
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
     * @param CreateRequest $request
     */
    public function create(CreateRequest $request)
    {
        $createResponse = $this->companyService->create(
            $request->title,
            $request->taxOffice,
            $request->taxNumber,
            $request->recordNumber,
            $request->commercialCompanyId,
            $request->uyumCrmCompanyId,
            $request->uyumCrmBranchId,
            $request->uyumCrmBranchCode,
            $request->activeYear,
            $request->saturdayPermitService,
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
        $updateResponse = $this->companyService->update(
            $request->id,
            $request->title,
            $request->taxOffice,
            $request->taxNumber,
            $request->recordNumber,
            $request->commercialCompanyId,
            $request->uyumCrmCompanyId,
            $request->uyumCrmBranchId,
            $request->uyumCrmBranchCode,
            $request->activeYear,
            $request->saturdayPermitService
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
}
