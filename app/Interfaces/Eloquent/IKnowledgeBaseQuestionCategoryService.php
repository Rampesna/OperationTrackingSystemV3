<?php

namespace App\Interfaces\Eloquent;

use App\Services\ServiceResponse;

interface IKnowledgeBaseQuestionCategoryService extends IEloquentService
{
    /**
     * @param int|null $topCategoryId
     * @param string $name
     *
     * @return ServiceResponse
     */
    public function create(
        ?int   $topCategoryId,
        string $name
    ): ServiceResponse;

    /**
     * @param int $id
     * @param int|null $topCategoryId
     * @param string $name
     *
     * @return ServiceResponse
     */
    public function update(
        int    $id,
        ?int   $topCategoryId,
        string $name
    ): ServiceResponse;
}
