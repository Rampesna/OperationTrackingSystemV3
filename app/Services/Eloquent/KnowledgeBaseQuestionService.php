<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\IKnowledgeBaseQuestionService;
use App\Models\Eloquent\KnowledgeBaseQuestion;
use App\Services\ServiceResponse;

class KnowledgeBaseQuestionService implements IKnowledgeBaseQuestionService
{
    /**
     * @return ServiceResponse
     */
    public function getAll(): ServiceResponse
    {
        return new ServiceResponse(
            true,
            'All knowledge base questions',
            200,
            KnowledgeBaseQuestion::all()
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
        $knowledgeBaseQuestion = KnowledgeBaseQuestion::with([
            'category',
        ])->find($id);
        if ($knowledgeBaseQuestion) {
            return new ServiceResponse(
                true,
                'Knowledge base question',
                200,
                $knowledgeBaseQuestion
            );
        } else {
            return new ServiceResponse(
                false,
                'Knowledge base question not found',
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
        $knowledgeBaseQuestion = $this->getById($id);
        if ($knowledgeBaseQuestion->isSuccess()) {
            return new ServiceResponse(
                true,
                'Knowledge base question deleted',
                200,
                $knowledgeBaseQuestion->getData()->delete()
            );
        } else {
            return $knowledgeBaseQuestion;
        }
    }

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
    ): ServiceResponse
    {
        $knowledgeBaseQuestions = KnowledgeBaseQuestion::with([
            'category'
        ])->orderBy('id', 'desc');

        if ($categoryIds && count($categoryIds) > 0) {
            $knowledgeBaseQuestions->whereIn('category_id', $categoryIds);
        }

        if ($keyword) {
            $knowledgeBaseQuestions->where(function ($knowledgeBaseQuestions) use ($keyword) {
                $knowledgeBaseQuestions->where('question', 'like', "%$keyword%")->orWhere('description', 'like', "%$keyword%")->orWhere('answer', 'like', "%$keyword%");
            });
        }

        return new ServiceResponse(
            true,
            'Knowledge base questions',
            200,
            [
                'totalCount' => $knowledgeBaseQuestions->count(),
                'pageIndex' => $pageIndex,
                'pageSize' => $pageSize,
                'knowledgeBaseQuestions' => $knowledgeBaseQuestions->skip($pageSize * $pageIndex)
                    ->take($pageSize)
                    ->get()
            ]
        );
    }

    /**
     * @param string $creatorType
     * @param int $creatorId
     * @param int|null $categoryId
     * @param string $question
     * @param string|null $description
     * @param string|null $answer
     *
     * @return ServiceResponse
     */
    public function create(
        string  $creatorType,
        int     $creatorId,
        ?int    $categoryId,
        string  $question,
        ?string $description,
        ?string $answer
    ): ServiceResponse
    {
        $knowledgeBaseQuestion = new KnowledgeBaseQuestion();
        $knowledgeBaseQuestion->creator_type = $creatorType;
        $knowledgeBaseQuestion->creator_id = $creatorId;
        $knowledgeBaseQuestion->category_id = $categoryId;
        $knowledgeBaseQuestion->question = $question;
        $knowledgeBaseQuestion->answer = $answer;
        $knowledgeBaseQuestion->save();

        return new ServiceResponse(
            true,
            'Knowledge base question created',
            200,
            $knowledgeBaseQuestion
        );
    }

    /**
     * @param int $id
     * @param int|null $categoryId
     * @param string $question
     * @param string|null $description
     * @param string|null $answer
     *
     * @return ServiceResponse
     */
    public function update(
        int     $id,
        ?int    $categoryId,
        string  $question,
        ?string $description,
        ?string $answer
    ): ServiceResponse
    {
        $knowledgeBaseQuestion = $this->getById($id);
        if ($knowledgeBaseQuestion->isSuccess()) {
            $knowledgeBaseQuestion = $knowledgeBaseQuestion->getData();
            $knowledgeBaseQuestion->category_id = $categoryId;
            $knowledgeBaseQuestion->question = $question;
            $knowledgeBaseQuestion->description = $description;
            $knowledgeBaseQuestion->answer = $answer;
            $knowledgeBaseQuestion->save();

            return new ServiceResponse(
                true,
                'Knowledge base question updated',
                200,
                $knowledgeBaseQuestion
            );
        } else {
            return $knowledgeBaseQuestion;
        }
    }
}
