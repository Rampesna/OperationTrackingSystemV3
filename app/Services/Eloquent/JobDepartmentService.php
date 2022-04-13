<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\IJobDepartmentService;
use App\Models\Eloquent\JobDepartment;

class JobDepartmentService implements IJobDepartmentService
{
    public function getAll()
    {
        return JobDepartment::all();
    }

    public function getById(int $id)
    {
        return JobDepartment::find($id);
    }

    public function delete(int $id)
    {
        return JobDepartment::destroy($id);
    }

    public function getByCompanyId($companyId)
    {
        return JobDepartment::where('company_id', $companyId)->get();
    }

}
