<?php

namespace App\Http\Controllers\Api\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Employee\KnowledgeBaseQuestionController\SearchRequest;
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
}
