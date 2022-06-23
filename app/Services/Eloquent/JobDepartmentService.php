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
        return JobDepartment::find(
            $id
        );
    }

    public function delete(
        int $id
    )
    {
        return JobDepartment::destroy($id);
    }

    /**
     * @param array $companyIds
     * @param int $pageIndex
     * @param int $companyIds
     * @param string $keyword
     */
    public function getByCompanyIds(
        array  $companyIds,
        int    $pageIndex = 0,
        int    $pageSize = 10,
        string $keyword = null
    )
    {
        $jobDepartments = JobDepartment::with([
            'company',
            'type',
            'employees',
        ])->whereIn('company_id', $companyIds);

        if ($keyword) {
            $jobDepartments->where(function ($query) use ($keyword) {
                $query->where('name', 'like', '%' . $keyword . '%');
            });
        }

        return [
            'totalCount' => $jobDepartments->count(),
            'pageIndex' => $pageIndex,
            'pageSize' => $pageSize,
            'jobDepartments' => $jobDepartments->skip($pageSize * $pageIndex)
                ->take($pageSize)
                ->get()
        ];
    }

    public function getByTypeIds(
        array $typeIds
    )
    {
        return JobDepartment::with([
            'company',
            'type',
            'employees',
        ])->whereIn('type_id', $typeIds)->get();
    }

    /**
     * @param int $companyId
     * @param string $name
     * @param int|null $typeId
     */
    public function create(
        int    $companyId,
        string $name,
        ?int   $typeId = null
    )
    {
        $jobDepartment = new JobDepartment;
        $jobDepartment->company_id = $companyId;
        $jobDepartment->name = $name;
        $jobDepartment->type_id = $typeId;
        $jobDepartment->save();

        return $jobDepartment;
    }

    /**
     * @param int $id
     * @param int $companyId
     * @param string $name
     * @param int|null $typeId
     */
    public function update(
        int    $id,
        int    $companyId,
        string $name,
        ?int   $typeId = null
    )
    {
        $jobDepartment = $this->getById($id);
        $jobDepartment->company_id = $companyId;
        $jobDepartment->name = $name;
        $jobDepartment->type_id = $typeId;
        $jobDepartment->save();

        return $jobDepartment;
    }
}
