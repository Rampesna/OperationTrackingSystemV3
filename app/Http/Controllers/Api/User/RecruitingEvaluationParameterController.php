<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Interfaces\Eloquent\IRecruitingEvaluationParameterService;
use App\Http\Requests\Api\User\RecruitingEvaluationParameterController\GetAllByRecruitingIdRequest;
use App\Http\Requests\Api\User\RecruitingEvaluationParameterController\CreateRequest;
use App\Http\Requests\Api\User\RecruitingEvaluationParameterController\CheckRequest;
use App\Http\Requests\Api\User\RecruitingEvaluationParameterController\DeleteRequest;
use App\Traits\Response;

class RecruitingEvaluationParameterController extends Controller
{
    use Response;

    /**
     * @var $recruitingEvaluationParameterService
     */
    private $recruitingEvaluationParameterService;

    /**
     * @param IRecruitingEvaluationParameterService $recruitingEvaluationParameterService
     */
    public function __construct(IRecruitingEvaluationParameterService $recruitingEvaluationParameterService)
    {
        $this->recruitingEvaluationParameterService = $recruitingEvaluationParameterService;
    }

    /**
     * @param GetAllByRecruitingIdRequest $request
     */
    public function getAllByRecruitingId(GetAllByRecruitingIdRequest $request)
    {
        $getAllByRecruitingIdResponse = $this->recruitingEvaluationParameterService->getAllByRecruitingId(
            $request->recruitingId
        );
        if ($getAllByRecruitingIdResponse->isSuccess()) {
            return $this->success(
                $getAllByRecruitingIdResponse->getMessage(),
                $getAllByRecruitingIdResponse->getData(),
                $getAllByRecruitingIdResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getAllByRecruitingIdResponse->getMessage(),
                $getAllByRecruitingIdResponse->getStatusCode()
            );
        }
    }

    /**
     * @param CreateRequest $request
     */
    public function create(CreateRequest $request)
    {
        $createResponse = $this->recruitingEvaluationParameterService->create(
            $request->recruitingId,
            $request->parameter
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
     * @param CheckRequest $request
     */
    public function check(CheckRequest $request)
    {
        $checkResponse = $this->recruitingEvaluationParameterService->check(
            $request->id
        );
        if ($checkResponse->isSuccess()) {
            return $this->success(
                $checkResponse->getMessage(),
                $checkResponse->getData(),
                $checkResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $checkResponse->getMessage(),
                $checkResponse->getStatusCode()
            );
        }
    }

    /**
     * @param DeleteRequest $request
     */
    public function delete(DeleteRequest $request)
    {
        $deleteResponse = $this->recruitingEvaluationParameterService->delete(
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
