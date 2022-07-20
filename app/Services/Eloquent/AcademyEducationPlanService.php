<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\IAcademyEducationLessonService;
use App\Interfaces\Eloquent\IAcademyEducationPlanService;
use App\Interfaces\Eloquent\IAcademyEducationService;
use App\Models\Eloquent\AcademyEducationPlan;
use App\Services\ServiceResponse;

class AcademyEducationPlanService implements IAcademyEducationPlanService
{
    /**
     * @var IAcademyEducationService $academyEducationService
     */
    private $academyEducationService;

    /**
     * @var IAcademyEducationLessonService $academyEducationLessonService
     */
    private $academyEducationLessonService;

    /**
     * @param IAcademyEducationService $academyEducationService
     * @param IAcademyEducationLessonService $academyEducationLessonService
     */
    public function __construct(
        IAcademyEducationService       $academyEducationService,
        IAcademyEducationLessonService $academyEducationLessonService
    )
    {
        $this->academyEducationService = $academyEducationService;
        $this->academyEducationLessonService = $academyEducationLessonService;
    }

    /**
     * @return ServiceResponse
     */
    public function getAll(): ServiceResponse
    {
        return new ServiceResponse(
            true,
            'All academy education plans',
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
        $academyEducationPlan = AcademyEducationPlan::with([
            'participants' => function ($participants) {
                $participants->with([
                    'employee'
                ]);
            },
            'academyEducationLesson'
        ])->find($id);
        if ($academyEducationPlan) {
            return new ServiceResponse(
                true,
                'Academy education plan',
                200,
                $academyEducationPlan
            );
        } else {
            return new ServiceResponse(
                false,
                'Academy education plan not found',
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
                'Academy education plan deleted',
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
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
        }

        return new ServiceResponse(
            true,
            'Academy education plans created',
            200,
            AcademyEducationPlan::insert($academyEducationPlansForCreate)
        );
    }

    /**
     * @param int $id
     * @param int $academyEducationLessonId
     * @param string $educationist
     * @param string $startDatetime
     * @param int $academyEducationPlanTypeId
     * @param string $location
     *
     * @return ServiceResponse
     */
    public function update(
        int    $id,
        string $educationist,
        string $startDatetime,
        int    $academyEducationPlanTypeId,
        string $location
    ): ServiceResponse
    {
        $academyEducationPlan = $this->getById($id);
        if ($academyEducationPlan->isSuccess()) {
            $academyEducationPlan->getData()->educationist = $educationist;
            $academyEducationPlan->getData()->start_datetime = $startDatetime;
            $academyEducationPlan->getData()->academy_education_plan_type_id = $academyEducationPlanTypeId;
            $academyEducationPlan->getData()->location = $location;
            $academyEducationPlan->getData()->save();
            return new ServiceResponse(
                true,
                'Academy education plan updated',
                200,
                $academyEducationPlan->getData()
            );
        } else {
            return $academyEducationPlan;
        }
    }

    /**
     * @param array $companyIds
     * @param string $startDate
     * @param string $endDate
     *
     * @return ServiceResponse
     */
    public function getDateBetweenByCompanyIds(
        array  $companyIds,
        string $startDate,
        string $endDate
    ): ServiceResponse
    {
        $academyEducationPlans = AcademyEducationPlan::with([
            'academyEducationLesson',
            'academyEducationPlanType'
        ])->whereIn('academy_education_lesson_id',
            $this->academyEducationLessonService->getByAcademyEducationIds(
                $this->academyEducationService->getByCompanyIds(
                    $companyIds,
                    0,
                    1000
                )->getData()['academyEducations']->pluck('id')->toArray()
            )->getData()->pluck('id')->toArray())
            ->whereBetween('start_datetime', [$startDate, $endDate])
            ->get();
        return new ServiceResponse(
            true,
            'Academy education plans',
            200,
            $academyEducationPlans
        );
    }
}
