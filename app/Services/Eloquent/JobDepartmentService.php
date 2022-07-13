<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\IJobDepartmentService;
use App\Models\Eloquent\JobDepartment;
use App\Services\ServiceResponse;

class JobDepartmentService implements IJobDepartmentService
{
    /**
     * @return ServiceResponse
     */
    public function getAll(): ServiceResponse
    {
        return new ServiceResponse(
            true,
            'All job departments',
            200,
            JobDepartment::all()
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
        $jobDepartment = JobDepartment::find($id);
        if ($jobDepartment) {
            return new ServiceResponse(
                true,
                'Job department',
                200,
                $jobDepartment
            );
        } else {
            return new ServiceResponse(
                false,
                'Job department not found',
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
        $jobDepartment = $this->getById($id);
        if ($jobDepartment->isSuccess()) {
            return new ServiceResponse(
                true,
                'Job department deleted',
                200,
                $jobDepartment->getData()->delete()
            );
        } else {
            return new ServiceResponse(
                false,
                'Job department not found',
                404,
                null
            );
        }
    }

    /**
     * @param array $companyIds
     * @param int $pageIndex
     * @param int $companyIds
     * @param string $keyword
     *
     * @return ServiceResponse
     */
    public function getByCompanyIds(
        array  $companyIds,
        int    $pageIndex = 0,
        int    $pageSize = 10,
        string $keyword = null
    ): ServiceResponse
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

        return new ServiceResponse(
            true,
            'Job departments',
            200,
            [
                'totalCount' => $jobDepartments->count(),
                'pageIndex' => $pageIndex,
                'pageSize' => $pageSize,
                'jobDepartments' => $jobDepartments->skip($pageSize * $pageIndex)
                    ->take($pageSize)
                    ->get()
            ]
        );
    }

    /**
     * @param array $typeIds
     *
     * @return ServiceResponse
     */
    public function getByTypeIds(
        array $typeIds
    ): ServiceResponse
    {
        return new ServiceResponse(
            true,
            'Job departments',
            200,
            JobDepartment::with([
                'company',
                'type',
                'employees',
            ])->whereIn('type_id', $typeIds)->get()
        );
    }

    /**
     * @param int $companyId
     * @param string $name
     * @param int|null $typeId
     *
     * @return ServiceResponse
     */
    public function create(
        int    $companyId,
        string $name,
        ?int   $typeId = null
    ): ServiceResponse
    {
        $jobDepartment = new JobDepartment;
        $jobDepartment->company_id = $companyId;
        $jobDepartment->name = $name;
        $jobDepartment->type_id = $typeId;
        $jobDepartment->save();

        return new ServiceResponse(
            true,
            'Job department created',
            201,
            $jobDepartment
        );
    }

    /**
     * @param int $id
     * @param int $companyId
     * @param string $name
     * @param int|null $typeId
     *
     * @return ServiceResponse
     */
    public function update(
        int    $id,
        int    $companyId,
        string $name,
        ?int   $typeId = null
    ): ServiceResponse
    {
        $jobDepartment = $this->getById($id);
        if ($jobDepartment->isSuccess()) {
            $jobDepartment->getData()->company_id = $companyId;
            $jobDepartment->getData()->name = $name;
            $jobDepartment->getData()->type_id = $typeId;
            $jobDepartment->getData()->save();

            return new ServiceResponse(
                true,
                'Job department updated',
                200,
                $jobDepartment->getData()
            );
        } else {
            return new ServiceResponse(
                false,
                'Job department not found',
                404,
                null
            );
        }
    }
}
