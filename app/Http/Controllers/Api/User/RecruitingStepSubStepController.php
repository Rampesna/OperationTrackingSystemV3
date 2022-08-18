<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\RecruitingStepSubStepController\CreateRequest;
use App\Http\Requests\Api\User\RecruitingStepSubStepController\DeleteRequest;
use App\Http\Requests\Api\User\RecruitingStepSubStepController\GetAllByRecruitingStepIdRequest;
use App\Http\Requests\Api\User\RecruitingStepSubStepController\GetByIdRequest;
use App\Http\Requests\Api\User\RecruitingStepSubStepController\UpdateRequest;
use App\Interfaces\Eloquent\IRecruitingStepSubStepService;
use App\Traits\Response;

class RecruitingStepSubStepController extends Controller
{
    use Response;

    /**
     * @var $recruitingStepSubStepService
     */
    private $recruitingStepSubStepService;

    /**
     * @param IRecruitingStepSubStepService $recruitingStepSubStepService
     */
    public function __construct(IRecruitingStepSubStepService $recruitingStepSubStepService)
    {
        $this->recruitingStepSubStepService = $recruitingStepSubStepService;
    }

    /**
     * @param GetAllByRecruitingStepIdRequest $request
     */
    public function getAllByRecruitingStepId(GetAllByRecruitingStepIdRequest $request)
    {
        $getAllResponse = $this->recruitingStepSubStepService->getAllByRecruitingStepId(
            $request->recruitingStepId
        );
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
     * @param GetByIdRequest $request
     */
    public function getById(GetByIdRequest $request)
    {
        $getByIdResponse = $this->recruitingStepSubStepService->getById(
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
        $createResponse = $this->recruitingStepSubStepService->create(
            $request->recruitingStepId,
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
        $updateResponse = $this->recruitingStepSubStepService->update(
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
        $deleteResponse = $this->recruitingStepSubStepService->delete(
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
