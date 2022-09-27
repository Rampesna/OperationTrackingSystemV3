<?php

namespace App\Interfaces\Eloquent;

use App\Services\ServiceResponse;

interface IKnowledgeBaseQuestionService extends IEloquentService
{
    /**
     * @param int $pageIndex
     * @param int $pageSize
     * @param array|null $categoryIds
     * @param string|null $keyword
     *
     * @return ServiceResponse
     */
    public function search(
        int     $pageIndex,
        int     $pageSize,
        ?array  $categoryIds,
        ?string $keyword
    ): ServiceResponse;

    /**
     * @param string $creatorType
     * @param int $creatorId
     * @param int|null $categoryId
     * @param string $question
     * @param string|null $answer
     *
     * @return ServiceResponse
     */
    public function create(
        string  $creatorType,
        int     $creatorId,
        ?int    $categoryId,
        string  $question,
        ?string $answer
    ): ServiceResponse;

    /**
     * @param int $id
     * @param int|null $categoryId
     * @param string $question
     * @param string|null $answer
     *
     * @return ServiceResponse
     */
    public function update(
        int     $id,
        ?int    $categoryId,
        string  $question,
        ?string $answer
    ): ServiceResponse;
}
