<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\IAcademyEducationPlanParticipantService;
use App\Models\Eloquent\AcademyEducationPlanParticipant;
use App\Services\ServiceResponse;

class AcademyEducationPlanParticipantService implements IAcademyEducationPlanParticipantService
{
    /**
     * @return ServiceResponse
     */
    public function getAll(): ServiceResponse
    {
        return new ServiceResponse(
            true,
            'All academy education plan participants',
            200,
            AcademyEducationPlanParticipant::all()
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
        $academyEducationPlanParticipant = AcademyEducationPlanParticipant::with([
            'employee'
        ])->find($id);
        if ($academyEducationPlanParticipant) {
            return new ServiceResponse(
                true,
                'Academy education plan participant',
                200,
                $academyEducationPlanParticipant
            );
        } else {
            return new ServiceResponse(
                false,
                'Academy education plan participant not found',
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
        $academyEducationPlanParticipant = $this->getById($id);
        if ($academyEducationPlanParticipant->isSuccess()) {
            return new ServiceResponse(
                true,
                'Academy education plan participant deleted',
                200,
                $academyEducationPlanParticipant->getData()->delete()
            );
        } else {
            return $academyEducationPlanParticipant;
        }
    }

    /**
     * @param int $academyEducationPlanId
     *
     * @return ServiceResponse
     */
    public function getByAcademyEducationPlanId(
        int $academyEducationPlanId
    ): ServiceResponse
    {
        $academyEducationPlanParticipants = AcademyEducationPlanParticipant::with([
            'employee'
        ])->where('academy_education_plan_id', $academyEducationPlanId)->get();
        return new ServiceResponse(
            true,
            'Academy education plan participants',
            200,
            $academyEducationPlanParticipants
        );
    }

    /**
     * @param int $academyEducationPlanId
     * @param int $employeeId
     *
     * @return ServiceResponse
     */
    public function create(
        int $academyEducationPlanId,
        int $employeeId
    ): ServiceResponse
    {
        $academyEducationPlanParticipant = new AcademyEducationPlanParticipant;
        $academyEducationPlanParticipant->academy_education_plan_id = $academyEducationPlanId;
        $academyEducationPlanParticipant->employee_id = $employeeId;
        $academyEducationPlanParticipant->save();

        return new ServiceResponse(
            true,
            'Academy education plan participant created',
            201,
            $academyEducationPlanParticipant
        );
    }

    /**
     * @param int $academyEducationPlanId
     * @param array $employeeIds
     *
     * @return ServiceResponse
     */
    public function syncAcademyEducationPlanParticipants(
        int   $academyEducationPlanId,
        array $employeeIds
    ): ServiceResponse
    {
        AcademyEducationPlanParticipant::
        whereNotIn('employee_id', $employeeIds)->
        where('academy_education_plan_id', $academyEducationPlanId)->
        delete();

        foreach ($employeeIds as $employeeId) {
            $academyEducationPlanParticipant = AcademyEducationPlanParticipant::
            where('academy_education_plan_id', $academyEducationPlanId)->
            where('employee_id', $employeeId)->first();
            if (!$academyEducationPlanParticipant) {
                $this->create(
                    $academyEducationPlanId,
                    $employeeId
                );
            }
        }
        return new ServiceResponse(
            true,
            'Academy education plan participants synced',
            200,
            true
        );
    }

    /**
     * @param int $id
     * @param int $attendance
     *
     * @return ServiceResponse
     */
    public function setAttendance(
        int $id,
        int $attendance
    ): ServiceResponse
    {
        $academyEducationPlanParticipant = $this->getById($id);
        if ($academyEducationPlanParticipant->isSuccess()) {
            $academyEducationPlanParticipant->getData()->attendance = $attendance;
            $academyEducationPlanParticipant->getData()->save();
            return new ServiceResponse(
                true,
                'Academy education plan participant attendance set',
                200,
                $academyEducationPlanParticipant->getData()
            );
        } else {
            return $academyEducationPlanParticipant;
        }
    }
}
