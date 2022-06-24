<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\ICompanyService;
use App\Models\Eloquent\Company;

class CompanyService implements ICompanyService
{
    public function getAll()
    {
        return Company::all();
    }

    /**
     * @param int $id
     */
    public function getById(
        int $id
    )
    {
        return Company::find($id);
    }

    /**
     * @param int $companyId
     */
    public function delete(
        int $id
    )
    {
        return Company::destroy($id);
    }

    /**
     * @param array $companyIds
     * @param int $pageIndex
     * @param int $pageSize
     * @param string|null $keyword
     */
    public function getUsersByCompanyIds(
        array   $companyIds,
        int     $pageIndex = 0,
        int     $pageSize = 10,
        ?string $keyword = null
    )
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

        return [
            'totalCount' => $users->count(),
            'pageIndex' => $pageIndex,
            'pageSize' => $pageSize,
            'users' => $users->skip($pageSize * $pageIndex)
                ->take($pageSize)
                ->all()
        ];
    }

    public function tree(
        int $id
    )
    {
        return Company::with([
            'branches' => function ($branches) {
                $branches->with([
                    'departments' => function ($departments) {
                        $departments->with([
                            'titles'
                        ]);
                    }
                ]);
            }
        ])->find($id);
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
        ?string $activeYear
    )
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
        $company->save();

        return $company;
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
        ?string $activeYear
    )
    {
        $company = $this->getById($id);
        $company->title = $title;
        $company->tax_office = $taxOffice;
        $company->tax_number = $taxNumber;
        $company->record_number = $recordNumber;
        $company->commercial_company_id = $commercialCompanyId;
        $company->uyum_crm_company_id = $uyumCrmCompanyId;
        $company->uyum_crm_branch_id = $uyumCrmBranchId;
        $company->uyum_crm_branch_code = $uyumCrmBranchCode;
        $company->active_year = $activeYear;
        $company->save();

        return $company;
    }
}
