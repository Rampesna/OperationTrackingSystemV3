<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\IJobDepartmentTypeService;
use App\Models\Eloquent\JobDepartmentType;

class JobDepartmentTypeService implements IJobDepartmentTypeService
{
    public function getAll()
    {
        return JobDepartmentType::all();
    }

    public function getById(int $id)
    {
        return JobDepartmentType::with([])->find($id);
    }

    public function delete(
        int $id
    )
    {
        return JobDepartmentType::destroy($id);
    }

    public function getByCompanyIds(
        array $companyIds
    )
    {
        return JobDepartmentType::with([
            'company',
        ])->whereIn('company_id', $companyIds)->get();
    }

}
