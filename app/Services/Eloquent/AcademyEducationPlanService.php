<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\IAcademyEducationPlanService;
use App\Models\Eloquent\AcademyEducationPlan;
use App\Services\ServiceResponse;

class AcademyEducationPlanService implements IAcademyEducationPlanService
{
    /**
     * @return ServiceResponse
     */
    public function getAll(): ServiceResponse
    {
        return new ServiceResponse(
            true,
            'All academy education lessons',
            200,
            AcademyEducationPlan::all()
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
        $academyEducationPlan = AcademyEducationPlan::find($id);
        if ($academyEducationPlan) {
            return new ServiceResponse(
                true,
                'Academy education lesson',
                200,
                $academyEducationPlan
            );
        } else {
            return new ServiceResponse(
                false,
                'Academy education not found',
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
        $academyEducationPlan = $this->getById($id);
        if ($academyEducationPlan->isSuccess()) {
            return new ServiceResponse(
                true,
                'Academy education deleted',
                200,
                $academyEducationPlan->getData()->delete()
            );
        } else {
            return $academyEducationPlan;
        }
    }

    /**
     * @param array $academyEducationPlans {
     * @param int $academyEducationLessonId
     * @param string $educationist
     * @param string $startDatetime
     * @param int $academyEducationPlanTypeId
     * @param string $location
     * @param  }
     *
     * @return ServiceResponse
     */
    public function createBatch(
        array $academyEducationPlans
    ): ServiceResponse
    {
        $academyEducationPlansForCreate = [];
        foreach ($academyEducationPlans as $academyEducationPlan) {
            $academyEducationPlansForCreate[] = [
                'academy_education_lesson_id' => $academyEducationPlan['academyEducationLessonId'],
                'educationist' => $academyEducationPlan['educationist'],
                'start_datetime' => $academyEducationPlan['startDatetime'],
                'academy_education_plan_type_id' => $academyEducationPlan['academyEducationPlanTypeId'],
                'location' => $academyEducationPlan['location'],
            ];
        }

        return new ServiceResponse(
            true,
            'Academy education plans created',
            200,
            AcademyEducationPlan::insert($academyEducationPlansForCreate)
        );
    }
}
