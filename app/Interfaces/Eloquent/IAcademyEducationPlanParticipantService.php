<?php

namespace App\Interfaces\Eloquent;

use App\Services\ServiceResponse;

interface IAcademyEducationPlanParticipantService extends IEloquentService
{
    /**
     * @param int $academyEducationPlanId
     *
     * @return ServiceResponse
     */
    public function getByAcademyEducationPlanId(
        int $academyEducationPlanId
    ): ServiceResponse;

    /**
     * @param int $academyEducationPlanId
     * @param int $employeeId
     *
     * @return ServiceResponse
     */
    public function create(
        int $academyEducationPlanId,
        int $employeeId
    ): ServiceResponse;

    /**
     * @param int $academyEducationPlanId
     * @param array $employeeIds
     *
     * @return ServiceResponse
     */
    public function syncAcademyEducationPlanParticipants(
        int   $academyEducationPlanId,
        array $employeeIds
    ): ServiceResponse;

    /**
     * @param int $id
     * @param int $attendance
     *
     * @return ServiceResponse
     */
    public function setAttendance(
        int $id,
        int $attendance
    ): ServiceResponse;
}
