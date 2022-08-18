<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\IRecruitingDepartmentService;
use App\Models\Eloquent\RecruitingDepartment;
use App\Services\ServiceResponse;

class RecruitingDepartmentService implements IRecruitingDepartmentService
{
    /**
     * @return ServiceResponse
     */
    public function getAll(): ServiceResponse
    {
        return new ServiceResponse(
            true,
            'All recruiting departments',
            200,
            RecruitingDepartment::all()
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
        $recruitingDepartment = RecruitingDepartment::find($id);
        if ($recruitingDepartment) {
            return new ServiceResponse(
                true,
                'Recruiting department',
                200,
                $recruitingDepartment
            );
        } else {
            return new ServiceResponse(
                false,
                'Recruiting department not found',
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
        $recruitingDepartment = $this->getById($id);
        if ($recruitingDepartment->isSuccess()) {
            return new ServiceResponse(
                true,
                'Recruiting department deleted',
                200,
                $recruitingDepartment->getData()->delete()
            );
        } else {
            return $recruitingDepartment;
        }
    }
}
