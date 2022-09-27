<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\KnowledgeBaseQuestionCategoryController\GetAllRequest;
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
}
