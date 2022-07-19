<?php

namespace App\Interfaces\Eloquent;

use App\Services\ServiceResponse;

interface IAcademyEducationLessonService extends IEloquentService
{
    /**
     * @param int $academyEducationId
     *
     * @return ServiceResponse
     */
    public function getByAcademyEducationId(
        int $academyEducationId
    ): ServiceResponse;

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
    ): ServiceResponse;

    /**
     * @param int $id
     * @param array $parameters
     *
     * @return ServiceResponse
     */
    public function updateByParameters(
        int   $id,
        array $parameters
    ): ServiceResponse;
}
