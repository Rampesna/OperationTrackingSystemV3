<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Interfaces\Eloquent\IEvaluationParameterService;
use App\Http\Requests\Api\User\EvaluationParameterController\IndexRequest;
use App\Http\Requests\Api\User\EvaluationParameterController\GetByIdRequest;
use App\Http\Requests\Api\User\EvaluationParameterController\CreateRequest;
use App\Http\Requests\Api\User\EvaluationParameterController\UpdateRequest;
use App\Http\Requests\Api\User\EvaluationParameterController\DeleteRequest;
use App\Traits\Response;

class EvaluationParameterController extends Controller
{
    use Response;

    /**
     * @var $evaluationParameterService
     */
    private $evaluationParameterService;

    /**
     * @param IEvaluationParameterService $evaluationParameterService
     */
    public function __construct(IEvaluationParameterService $evaluationParameterService)
    {
        $this->evaluationParameterService = $evaluationParameterService;
    }

    /**
     * @param IndexRequest $request
     */
    public function index(IndexRequest $request)
    {
        $indexResponse = $this->evaluationParameterService->index(
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
        $getByIdResponse = $this->evaluationParameterService->getById(
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
        $createResponse = $this->evaluationParameterService->create(
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
        $updateResponse = $this->evaluationParameterService->update(
            $request->id,
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
        $deleteResponse = $this->evaluationParameterService->delete(
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
