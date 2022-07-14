<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\IDepartmentService;
use App\Models\Eloquent\Department;
use App\Services\ServiceResponse;

class DepartmentService implements IDepartmentService
{
    /**
     * @return ServiceResponse
     */
    public function getAll(): ServiceResponse
    {
        return new ServiceResponse(
            true,
            'All departments',
            200,
            Department::all()
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
        $department = Department::find($id);
        if ($department) {
            return new ServiceResponse(
                true,
                'Department',
                200,
                $department
            );
        } else {
            return $department;
        }
    }

    /**
     * @param int $branchId
     *
     * @return ServiceResponse
     */
    public function getByBranchId(
        int $branchId
    ): ServiceResponse
    {
        return new ServiceResponse(
            true,
            'Departments found',
            200,
            Department::where('branch_id', $branchId)->get()
        );
    }

    /**
     * @param int $branchId
     * @param string $name
     *
     * @return ServiceResponse
     */
    public function create(
        int    $branchId,
        string $name
    ): ServiceResponse
    {
        $department = new Department;
        $department->branch_id = $branchId;
        $department->name = $name;
        $department->save();

        return new ServiceResponse(
            true,
            'Department created',
            201,
            $department
        );
    }

    /**
     * @param int $id
     * @param string $name
     *
     * @return ServiceResponse
     */
    public function update(
        int    $id,
        string $name
    ): ServiceResponse
    {
        $department = $this->getById($id);
        if ($department->isSuccess()) {
            $department->getData()->name = $name;
            $department->getData()->save();

            return new ServiceResponse(
                true,
                'Department updated',
                200,
                $department->getData()
            );
        } else {
            return $department;
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
        $department = $this->getById($id);
        if ($department->isSuccess()) {
            return new ServiceResponse(
                true,
                'Department deleted',
                200,
                $department->getData()->delete()
            );
        } else {
            return $department;
        }
    }

}
