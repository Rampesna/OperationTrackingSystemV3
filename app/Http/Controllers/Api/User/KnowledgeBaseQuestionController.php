<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\KnowledgeBaseQuestionController\GetAllRequest;
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
}
