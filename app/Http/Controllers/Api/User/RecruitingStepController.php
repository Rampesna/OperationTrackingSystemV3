<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Interfaces\Eloquent\IRecruitingStepService;
use App\Http\Requests\Api\User\RecruitingStepController\IndexRequest;
use App\Http\Requests\Api\User\RecruitingStepController\GetByIdRequest;
use App\Http\Requests\Api\User\RecruitingStepController\CreateRequest;
use App\Http\Requests\Api\User\RecruitingStepController\UpdateRequest;
use App\Http\Requests\Api\User\RecruitingStepController\DeleteRequest;
use App\Traits\Response;

class RecruitingStepController extends Controller
{
    use Response;

    /**
     * @var $recruitingStepService
     */
    private $recruitingStepService;

    /**
     * @param IRecruitingStepService $recruitingStepService
     */
    public function __construct(IRecruitingStepService $recruitingStepService)
    {
        $this->recruitingStepService = $recruitingStepService;
    }

    /**
     * @param IndexRequest $request
     */
    public function index(IndexRequest $request)
    {
        $indexResponse = $this->recruitingStepService->index(
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
        $getByIdResponse = $this->recruitingStepService->getById(
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
        $createResponse = $this->recruitingStepService->create(
            $request->name,
            $request->color,
            $request->sms,
            $request->message
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
        $updateResponse = $this->recruitingStepService->update(
            $request->id,
            $request->name,
            $request->color,
            $request->sms,
            $request->message
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
        $deleteResponse = $this->recruitingStepService->delete(
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
