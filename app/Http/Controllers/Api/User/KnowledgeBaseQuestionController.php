<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\KnowledgeBaseQuestionController\GetAllRequest;
use App\Http\Requests\Api\User\KnowledgeBaseQuestionController\SearchRequest;
use App\Http\Requests\Api\User\KnowledgeBaseQuestionController\GetByIdRequest;
use App\Http\Requests\Api\User\KnowledgeBaseQuestionController\CreateRequest;
use App\Http\Requests\Api\User\KnowledgeBaseQuestionController\UpdateRequest;
use App\Http\Requests\Api\User\KnowledgeBaseQuestionController\DeleteRequest;
use App\Interfaces\Eloquent\IKnowledgeBaseQuestionService;
use App\Traits\Response;

class KnowledgeBaseQuestionController extends Controller
{
    use Response;

    /**
     * @var $knowledgeBaseQuestionService
     */
    private $knowledgeBaseQuestionService;

    /**
     * @param IKnowledgeBaseQuestionService $knowledgeBaseQuestionService
     */
    public function __construct(IKnowledgeBaseQuestionService $knowledgeBaseQuestionService)
    {
        $this->knowledgeBaseQuestionService = $knowledgeBaseQuestionService;
    }

    /**
     * @param GetAllRequest $request
     */
    public function getAll(GetAllRequest $request)
    {
        $getAllResponse = $this->knowledgeBaseQuestionService->getAll();
        if ($getAllResponse->isSuccess()) {
            return $this->success(
                $getAllResponse->getMessage(),
                $getAllResponse->getData(),
                $getAllResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getAllResponse->getMessage(),
                $getAllResponse->getStatusCode()
            );
        }
    }

    /**
     * @param SearchRequest $request
     */
    public function search(SearchRequest $request)
    {
        $searchResponse = $this->knowledgeBaseQuestionService->search(
            $request->pageIndex,
            $request->pageSize,
            $request->categoryIds,
            $request->keyword
        );
        if ($searchResponse->isSuccess()) {
            return $this->success(
                $searchResponse->getMessage(),
                $searchResponse->getData(),
                $searchResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $searchResponse->getMessage(),
                $searchResponse->getStatusCode()
            );
        }
    }

    /**
     * @param GetByIdRequest $request
     */
    public function getById(GetByIdRequest $request)
    {
        $getByIdResponse = $this->knowledgeBaseQuestionService->getById(
            $request->id
        );
        if ($getByIdResponse->isSuccess()) {
            return $this->success(
                $getByIdResponse->getMessage(),
                $getByIdResponse->getData(),
                $getByIdResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getByIdResponse->getMessage(),
                $getByIdResponse->getStatusCode()
            );
        }
    }

    /**
     * @param CreateRequest $request
     */
    public function create(CreateRequest $request)
    {
        $createResponse = $this->knowledgeBaseQuestionService->create(
            'App\\Models\\Eloquent\\User',
            $request->user()->id,
            $request->categoryId,
            $request->question,
            $request->description,
            $request->answer
        );
        if ($createResponse->isSuccess()) {
            return $this->success(
                $createResponse->getMessage(),
                $createResponse->getData(),
                $createResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $createResponse->getMessage(),
                $createResponse->getStatusCode()
            );
        }
    }

    /**
     * @param UpdateRequest $request
     */
    public function update(UpdateRequest $request)
    {
        $updateResponse = $this->knowledgeBaseQuestionService->update(
            $request->id,
            $request->categoryId,
            $request->question,
            $request->description,
            $request->answer
        );
        if ($updateResponse->isSuccess()) {
            return $this->success(
                $updateResponse->getMessage(),
                $updateResponse->getData(),
                $updateResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $updateResponse->getMessage(),
                $updateResponse->getStatusCode()
            );
        }
    }

    /**
     * @param DeleteRequest $request
     */
    public function delete(DeleteRequest $request)
    {
        $deleteResponse = $this->knowledgeBaseQuestionService->delete(
            $request->id
        );
        if ($deleteResponse->isSuccess()) {
            return $this->success(
                $deleteResponse->getMessage(),
                $deleteResponse->getData(),
                $deleteResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $deleteResponse->getMessage(),
                $deleteResponse->getStatusCode()
            );
        }
    }
}
