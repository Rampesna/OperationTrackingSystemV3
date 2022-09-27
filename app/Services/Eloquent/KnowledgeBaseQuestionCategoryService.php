<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\IKnowledgeBaseQuestionCategoryService;
use App\Models\Eloquent\KnowledgeBaseQuestionCategory;
use App\Services\ServiceResponse;

class KnowledgeBaseQuestionCategoryService implements IKnowledgeBaseQuestionCategoryService
{
    /**
     * @return ServiceResponse
     */
    public function getAll(): ServiceResponse
    {
        return new ServiceResponse(
            true,
            'All knowledge base question categories',
            200,
            KnowledgeBaseQuestionCategory::all()
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
        $knowledgeBaseQuestionCategory = KnowledgeBaseQuestionCategory::find($id);
        if ($knowledgeBaseQuestionCategory) {
            return new ServiceResponse(
                true,
                'Knowledge base question category',
                200,
                $knowledgeBaseQuestionCategory
            );
        } else {
            return new ServiceResponse(
                false,
                'Knowledge base question category not found',
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
        $knowledgeBaseQuestionCategory = $this->getById($id);
        if ($knowledgeBaseQuestionCategory->isSuccess()) {
            return new ServiceResponse(
                true,
                'Knowledge base question category deleted',
                200,
                $knowledgeBaseQuestionCategory->getData()->delete()
            );
        } else {
            return $knowledgeBaseQuestionCategory;
        }
    }

    /**
     * @param int|null $topCategoryId
     * @param string $name
     *
     * @return ServiceResponse
     */
    public function create(
        ?int   $topCategoryId,
        string $name
    ): ServiceResponse
    {
        $knowledgeBaseQuestionCategory = new KnowledgeBaseQuestionCategory();
        $knowledgeBaseQuestionCategory->top_category_id = $topCategoryId;
        $knowledgeBaseQuestionCategory->name = $name;
        $knowledgeBaseQuestionCategory->save();

        return new ServiceResponse(
            true,
            'Knowledge base question category created',
            200,
            $knowledgeBaseQuestionCategory
        );
    }

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
    ): ServiceResponse
    {
        $knowledgeBaseQuestionCategory = $this->getById($id);
        if ($knowledgeBaseQuestionCategory->isSuccess()) {
            $knowledgeBaseQuestionCategory = $knowledgeBaseQuestionCategory->getData();
            $knowledgeBaseQuestionCategory->top_category_id = $topCategoryId;
            $knowledgeBaseQuestionCategory->name = $name;
            $knowledgeBaseQuestionCategory->save();

            return new ServiceResponse(
                true,
                'Knowledge base question category updated',
                200,
                $knowledgeBaseQuestionCategory
            );
        } else {
            return $knowledgeBaseQuestionCategory;
        }
    }
}
