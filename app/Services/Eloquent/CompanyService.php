<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\ICompanyService;
use App\Models\Eloquent\Company;
use App\Services\ServiceResponse;

class CompanyService implements ICompanyService
{
    /**
     * @return ServiceResponse
     */
    public function getAll(): ServiceResponse
    {
        return new ServiceResponse(
            true,
            'All companies',
            200,
            Company::all()
        );
    }

    /**
     * @param int $id
     *
     * @return ServiceResponse
     */
    public function getById(
        int $id
    ): ServiceResponse
    {
        $company = Company::find($id);
        if ($company) {
            return new ServiceResponse(
                true,
                'Company',
                200,
                $company
            );
        } else {
            return new ServiceResponse(
                false,
                'Company not found',
                404,
                null
            );
        }
    }

    /**
     * @param int $id
     *
     * @return ServiceResponse
     */
    public function delete(
        int $id
    ): ServiceResponse
    {
        $company = $this->getById($id);
        if ($company->isSuccess()) {
            return new ServiceResponse(
                true,
                'Company deleted',
                200,
                $company->getData()->delete()
            );
        } else {
            return $company;
        }
    }

    /**
     * @param array $companyIds
     * @param int $pageIndex
     * @param int $pageSize
     * @param string|null $keyword
     *
     * @return ServiceResponse
     */
    public function getUsersByCompanyIds(
        array   $companyIds,
        int     $pageIndex = 0,
        int     $pageSize = 10,
        ?string $keyword = null
    ): ServiceResponse
    {
        $users = Company::with([
            'users' => function ($users) use ($keyword) {
                $users->with([
                    'role'
                ])->where(function ($users) use ($keyword) {
                    $users->where('name', 'like', '%' . $keyword . '%')
                        ->orWhere('email', 'like', '%' . $keyword . '%');
                });
            }
        ])->whereIn('id', $companyIds)->get()->map(function ($company) {
            return $company->users;
        })->collapse()->unique('id');

        return new ServiceResponse(
            true,
            '',
            200,
            [
                'totalCount' => $users->count(),
                'pageIndex' => $pageIndex,
                'pageSize' => $pageSize,
                'users' => $users->skip($pageSize * $pageIndex)
                    ->take($pageSize)
                    ->all()
            ]
        );
    }

    /**
     * @param int $id
     *
     * @return ServiceResponse
     */
    public function tree(
        int $id
    ): ServiceResponse
    {
        return new ServiceResponse(
            true,
            'Company hierarchy',
            200,
            Company::with([
                'branches' => function ($branches) {
                    $branches->with([
                        'departments' => function ($departments) {
                            $departments->with([
                                'titles'
                            ]);
                        }
                    ]);
                }
            ])->find($id)
        );
    }

    /**
     * @param string $title
     * @param string|null $taxOffice
     * @param string|null $taxNumber
     * @param string|null $recordNumber
     * @param int|null $commercialCompanyId
     * @param int|null $uyumCrmCompanyId
     * @param int|null $uyumCrmBranchId
     * @param string|null $uyumCrmBranchCode
     * @param string|null $activeYear
     * @param int $saturdayPermitService
     *
     * @return ServiceResponse
     */
    public function create(
        string  $title,
        ?string $taxOffice,
        ?string $taxNumber,
        ?string $recordNumber,
        ?int    $commercialCompanyId,
        ?int    $uyumCrmCompanyId,
        ?int    $uyumCrmBranchId,
        ?string $uyumCrmBranchCode,
        ?string $activeYear,
        int     $saturdayPermitService
    ): ServiceResponse
    {
        $company = new Company;
        $company->title = $title;
        $company->tax_office = $taxOffice;
        $company->tax_number = $taxNumber;
        $company->record_number = $recordNumber;
        $company->commercial_company_id = $commercialCompanyId;
        $company->uyum_crm_company_id = $uyumCrmCompanyId;
        $company->uyum_crm_branch_id = $uyumCrmBranchId;
        $company->uyum_crm_branch_code = $uyumCrmBranchCode;
        $company->active_year = $activeYear;
        $company->saturday_permit_service = $saturdayPermitService;
        $company->save();

        return new ServiceResponse(
            true,
            'Company created',
            201,
            $company
        );
    }

    /**
     * @param int $id
     * @param string $title
     * @param string|null $taxOffice
     * @param string|null $taxNumber
     * @param string|null $recordNumber
     * @param int|null $commercialCompanyId
     * @param int|null $uyumCrmCompanyId
     * @param int|null $uyumCrmBranchId
     * @param string|null $uyumCrmBranchCode
     * @param string|null $activeYear
     * @param int $saturdayPermitService
     *
     * @return ServiceResponse
     */
    public function update(
        int     $id,
        string  $title,
        ?string $taxOffice,
        ?string $taxNumber,
        ?string $recordNumber,
        ?int    $commercialCompanyId,
        ?int    $uyumCrmCompanyId,
        ?int    $uyumCrmBranchId,
        ?string $uyumCrmBranchCode,
        ?string $activeYear,
        int     $saturdayPermitService
    ): ServiceResponse
    {
        $company = $this->getById($id);

        if ($company->isSuccess()) {
            $company->getData()->title = $title;
            $company->getData()->tax_office = $taxOffice;
            $company->getData()->tax_number = $taxNumber;
            $company->getData()->record_number = $recordNumber;
            $company->getData()->commercial_company_id = $commercialCompanyId;
            $company->getData()->uyum_crm_company_id = $uyumCrmCompanyId;
            $company->getData()->uyum_crm_branch_id = $uyumCrmBranchId;
            $company->getData()->uyum_crm_branch_code = $uyumCrmBranchCode;
            $company->getData()->active_year = $activeYear;
            $company->getData()->saturday_permit_service = $saturdayPermitService;
            $company->getData()->save();

            return new ServiceResponse(
                true,
                'Company updated',
                200,
                $company->getData()
            );
        } else {
            return $company;
        }
    }
}
