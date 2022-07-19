<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\IAcademyEducationLessonService;
use App\Models\Eloquent\AcademyEducationLesson;
use App\Services\ServiceResponse;

class AcademyEducationLessonService implements IAcademyEducationLessonService
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
            AcademyEducationLesson::all()
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
        $academyEducationLesson = AcademyEducationLesson::find($id);
        if ($academyEducationLesson) {
            return new ServiceResponse(
                true,
                'Academy education lesson',
                200,
                $academyEducationLesson
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
        $academyEducationLesson = $this->getById($id);
        if ($academyEducationLesson->isSuccess()) {
            return new ServiceResponse(
                true,
                'Academy education deleted',
                200,
                $academyEducationLesson->getData()->delete()
            );
        } else {
            return $academyEducationLesson;
        }
    }

    /**
     * @param int $academyEducationId
     *
     * @return ServiceResponse
     */
    public function getByAcademyEducationId(
        int $academyEducationId
    ): ServiceResponse
    {
        return new ServiceResponse(
            true,
            'Academy education lessons',
            200,
            AcademyEducationLesson::where('academy_education_id', $academyEducationId)->get()
        );
    }

    /**
     * @param int $academyEducationId
     * @param string $name
     * @param int $durationInMinutes
     *
     * @return ServiceResponse
     */
    public function create(
        int    $academyEducationId,
        string $name,
        int    $durationInMinutes
    ): ServiceResponse
    {
        $academyEducationLesson = new AcademyEducationLesson();
        $academyEducationLesson->academy_education_id = $academyEducationId;
        $academyEducationLesson->name = $name;
        $academyEducationLesson->duration_in_minutes = $durationInMinutes;
        $academyEducationLesson->save();

        return new ServiceResponse(
            true,
            'Academy education lesson created',
            201,
            $academyEducationLesson
        );
    }

    /**
     * @param int $id
     * @param array $parameters
     *
     * @return ServiceResponse
     */
    public function updateByParameters(
        int   $id,
        array $parameters
    ): ServiceResponse
    {
        $academyEducationLesson = $this->getById($id);
        if ($academyEducationLesson->isSuccess()) {
            foreach ($parameters as $parameter) {
                $academyEducationLesson->getData()->{$parameter['attribute']} = $parameter['value'];
            }
            $academyEducationLesson->getData()->save();
            return new ServiceResponse(
                true,
                'Academy education lesson updated',
                200,
                $academyEducationLesson->getData()
            );
        } else {
            return $academyEducationLesson;
        }
    }
}
