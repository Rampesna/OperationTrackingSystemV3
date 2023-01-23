<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\PrCritterController\DeleteRequest;
use App\Http\Requests\Api\User\PrCritterController\GetByIdRequest;
use App\Http\Requests\Api\User\PrCritterController\CreateRequest;
use App\Http\Requests\Api\User\PrCritterController\GetAllByCardIdRequest;
use App\Http\Requests\Api\User\PrCritterController\GetByJobDepartmentIdRequest;
use \App\Http\Requests\Api\User\PrCritterController\UpdateRequest;
use App\Interfaces\Eloquent\IPRCritterService;
use App\Traits\Response;

class PrCritterController extends Controller
{
    use Response;

    /**
     * @var $prCritterService
     */
    private $prCritterService;

    /**
     * @param IPRCritterService $prCritterService
     */
    public function __construct(IPRCritterService $prCritterService)
    {
        $this->prCritterService = $prCritterService;
    }

    /**
     * @param GetByJobDepartmentIdRequest\ $request
     */
    public function getByJobDepartmentId(GetByJobDepartmentIdRequest $request)
    {
        $getByJobDepartmentIdResponse = $this->prCritterService->getByJobDepartmentId(
            $request->jobDepartmentId,
        );
        if ($getByJobDepartmentIdResponse->isSuccess()) {
            return $this->success(
                $getByJobDepartmentIdResponse->getMessage(),
                $getByJobDepartmentIdResponse->getData(),
                $getByJobDepartmentIdResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getByJobDepartmentIdResponse->getMessage(),
                $getByJobDepartmentIdResponse->getStatusCode()
            );
        }
    }

    /**
     * @param CreateRequest $request
     */
    public function create(CreateRequest $request)
    {
        $createResponse = $this->prCritterService->create(
            $request->prCardId,
            $request->name,
            $request->minTarget,
            $request->minTargetPercent,
            $request->defaultTarget,
            $request->defaultTargetPercent,
            $request->maxTarget,
            $request->maxTargetPercent,
            $request->generalPercent,
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
        $updateResponse = $this->prCritterService->update(
            $request->id,
            $request->name,
            $request->minTarget,
            $request->minTargetPercent,
            $request->defaultTarget,
            $request->defaultTargetPercent,
            $request->maxTarget,
            $request->maxTargetPercent,
            $request->generalPercent,

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
     * @param int $id
     */
    public function getAllByCardId(GetAllByCardIdRequest $request)
    {
        $getAllByCardIdResponse = $this->prCritterService->getAllByCardId(
            $request->cardId,
        );
        if ($getAllByCardIdResponse->isSuccess()) {
            return $this->success(
                $getAllByCardIdResponse->getMessage(),
                $getAllByCardIdResponse->getData(),
                $getAllByCardIdResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getAllByCardIdResponse->getMessage(),
                $getAllByCardIdResponse->getStatusCode()
            );
        }
    }

    public function getById(GetByIdRequest $request)
    {
        $getByIdResponse = $this->prCritterService->getById(
            $request->id,
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

    public function delete(DeleteRequest $request)
    {
        $deleteResponse = $this->prCritterService->delete(
            $request->id,
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
