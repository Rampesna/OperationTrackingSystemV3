<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\IJobDepartmentTypeService;
use App\Models\Eloquent\JobDepartmentType;
use App\Services\ServiceResponse;

class JobDepartmentTypeService implements IJobDepartmentTypeService
{
    /**
     * @return ServiceResponse
     */
    public function getAll(): ServiceResponse
    {
        return new ServiceResponse(
            true,
            'All job department types',
            200,
            JobDepartmentType::all()
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
        $jobDepartmentType = JobDepartmentType::find($id);
        if ($jobDepartmentType) {
            return new ServiceResponse(
                true,
                'Job department type',
                200,
                $jobDepartmentType
            );
        } else {
            return new ServiceResponse(
                false,
                'Job department type not found',
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
        $jobDepartmentType = $this->getById($id);
        if ($jobDepartmentType->isSuccess()) {
            return new ServiceResponse(
                true,
                'Job department type deleted',
                200,
                $jobDepartmentType->getData()->delete()
            );
        } else {
            return new ServiceResponse(
                false,
                'Job department type not found',
                404,
                null
            );
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
    public function getByCompanyIds(
        array       $companyIds,
        int         $pageIndex = 0,
        int         $pageSize = 10,
        string|null $keyword = null
    ): ServiceResponse
    {
        $jobDepartmentTypes = JobDepartmentType::with([
            'company',
        ])->whereIn('company_id', $companyIds);

        if ($keyword) {
            $jobDepartmentTypes->where(function ($query) use ($keyword) {
                $query->where('name', 'like', '%' . $keyword . '%');
            });
        }

        return new ServiceResponse(
            true,
            'Job department types',
            200,
            [
                'totalCount' => $jobDepartmentTypes->count(),
                'pageIndex' => $pageIndex,
                'pageSize' => $pageSize,
                'jobDepartmentTypes' => $jobDepartmentTypes->skip($pageSize * $pageIndex)
                    ->take($pageSize)
                    ->get()
            ]
        );
    }

    /**
     * @param int $companyId
     * @param string $name
     *
     * @return ServiceResponse
     */
    public function create(
        int    $companyId,
        string $name
    ): ServiceResponse
    {
        $jobDepartmentType = new JobDepartmentType;
        $jobDepartmentType->company_id = $companyId;
        $jobDepartmentType->name = $name;
        $jobDepartmentType->save();

        return new ServiceResponse(
            true,
            'Job department type created',
            201,
            $jobDepartmentType
        );
    }

    /**
     * @param int $id
     * @param int $companyId
     * @param string $name
     *
     * @return ServiceResponse
     */
    public function update(
        int    $id,
        int    $companyId,
        string $name
    ): ServiceResponse
    {
        $jobDepartmentType = $this->getById($id);
        if ($jobDepartmentType->isSuccess()) {
            $jobDepartmentType->getData()->company_id = $companyId;
            $jobDepartmentType->getData()->name = $name;
            $jobDepartmentType->getData()->save();

            return new ServiceResponse(
                true,
                'Job department type updated',
                200,
                $jobDepartmentType->getData()
            );
        } else {
            return new ServiceResponse(
                false,
                'Job department type not found',
                404,
                null
            );
        }
    }
}
