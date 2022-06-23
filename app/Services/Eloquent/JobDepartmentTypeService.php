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

    /**
     * @param array $companyIds
     * @param int $pageIndex
     * @param int $pageSize
     * @param string|null $keyword
     */
    public function getByCompanyIds(
        array       $companyIds,
        int         $pageIndex = 0,
        int         $pageSize = 10,
        string|null $keyword = null
    )
    {
        $jobDepartmentTypes = JobDepartmentType::with([
            'company',
        ])->whereIn('company_id', $companyIds);

        if ($keyword) {
            $jobDepartmentTypes->where(function ($query) use ($keyword) {
                $query->where('name', 'like', '%' . $keyword . '%');
            });
        }

        return [
            'totalCount' => $jobDepartmentTypes->count(),
            'pageIndex' => $pageIndex,
            'pageSize' => $pageSize,
            'jobDepartmentTypes' => $jobDepartmentTypes->skip($pageSize * $pageIndex)
                ->take($pageSize)
                ->get()
        ];
    }

    /**
     * @param int $companyId
     * @param string $name
     */
    public function create(
        int    $companyId,
        string $name
    )
    {
        $jobDepartmentType = new JobDepartmentType;
        $jobDepartmentType->company_id = $companyId;
        $jobDepartmentType->name = $name;
        $jobDepartmentType->save();

        return $jobDepartmentType;
    }

    /**
     * @param int $id
     * @param int $companyId
     * @param string $name
     */
    public function update(
        int    $id,
        int    $companyId,
        string $name
    )
    {
        $jobDepartmentType = $this->getById($id);
        $jobDepartmentType->company_id = $companyId;
        $jobDepartmentType->name = $name;
        $jobDepartmentType->save();

        return $jobDepartmentType;
    }
}
