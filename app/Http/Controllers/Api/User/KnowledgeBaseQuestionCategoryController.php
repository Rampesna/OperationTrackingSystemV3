<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\KnowledgeBaseQuestionCategoryController\GetAllRequest;
use App\Http\Requests\Api\User\KnowledgeBaseQuestionCategoryController\IndexRequest;
use App\Http\Requests\Api\User\KnowledgeBaseQuestionCategoryController\GetByIdRequest;
use App\Http\Requests\Api\User\KnowledgeBaseQuestionCategoryController\CreateRequest;
use App\Http\Requests\Api\User\KnowledgeBaseQuestionCategoryController\UpdateRequest;
use App\Http\Requests\Api\User\KnowledgeBaseQuestionCategoryController\DeleteRequest;
use App\Interfaces\Eloquent\IKnowledgeBaseQuestionCategoryService;
use App\Traits\Response;

class KnowledgeBaseQuestionCategoryController extends Controller
{
    use Response;

    /**
     * @var $knowledgeBaseQuestionCategoryService
     */
    private $knowledgeBaseQuestionCategoryService;

    /**
     * @param IKnowledgeBaseQuestionCategoryService $knowledgeBaseQuestionCategoryService
     */
    public function __construct(IKnowledgeBaseQuestionCategoryService $knowledgeBaseQuestionCategoryService)
    {
        $this->knowledgeBaseQuestionCategoryService = $knowledgeBaseQuestionCategoryService;
    }

    /**
     * @param GetAllRequest $request
     */
    public function getAll(GetAllRequest $request)
    {
        $getAllResponse = $this->knowledgeBaseQuestionCategoryService->getAll();
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
     * @param IndexRequest $request
     */
    public function index(IndexRequest $request)
    {
        $indexResponse = $this->knowledgeBaseQuestionCategoryService->index(
            $request->pageIndex,
            $request->pageSize,
            $request->keyword
        );
        if ($indexResponse->isSuccess()) {
            return $this->success(
                $indexResponse->getMessage(),
                $indexResponse->getData(),
                $indexResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $indexResponse->getMessage(),
                $indexResponse->getStatusCode()
            );
        }
    }

    /**
     * @param GetByIdRequest $request
     */
    public function getById(GetByIdRequest $request)
    {
        $getByIdResponse = $this->knowledgeBaseQuestionCategoryService->getById(
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
        $createResponse = $this->knowledgeBaseQuestionCategoryService->create(
            $request->topCategoryId,
            $request->name
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
        $updateResponse = $this->knowledgeBaseQuestionCategoryService->update(
            $request->id,
            $request->topCategoryId,
            $request->name
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
        $deleteResponse = $this->knowledgeBaseQuestionCategoryService->delete(
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
