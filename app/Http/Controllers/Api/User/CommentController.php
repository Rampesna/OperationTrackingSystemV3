<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Interfaces\Eloquent\ICommentService;
use App\Http\Requests\Api\User\CommentController\GetByRelationRequest;
use App\Http\Requests\Api\User\CommentController\CreateRequest;
use App\Traits\Response;

class CommentController extends Controller
{
    use Response;

    /**
     * @var $commentService
     */
    private $commentService;

    /**
     * @param ICommentService $commentService
     */
    public function __construct(ICommentService $commentService)
    {
        $this->commentService = $commentService;
    }

    /**
     * @param GetByRelationRequest $request
     */
    public function getByRelation(GetByRelationRequest $request)
    {
        $getByRelationResponse = $this->commentService->getByRelation(
            $request->relationType,
            $request->relationId
        );
        if ($getByRelationResponse->isSuccess()) {
            return $this->success(
                $getByRelationResponse->getMessage(),
                $getByRelationResponse->getData(),
                $getByRelationResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getByRelationResponse->getMessage(),
                $getByRelationResponse->getStatusCode()
            );
        }
    }

    /**
     * @param CreateRequest $request
     */
    public function create(CreateRequest $request)
    {
        $createResponse = $this->commentService->create(
            $request->relationType,
            $request->relationId,
            'App\\Models\\Eloquent\\User',
            $request->user()->id,
            $request->comment
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
}
