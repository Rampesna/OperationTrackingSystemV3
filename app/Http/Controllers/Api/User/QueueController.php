<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\QueueController\GetByCompanyIdsRequest;
use App\Http\Requests\Api\User\QueueController\GetByIdRequest;
use App\Http\Requests\Api\User\QueueController\CreateRequest;
use App\Http\Requests\Api\User\QueueController\UpdateRequest;
use App\Http\Requests\Api\User\QueueController\DeleteRequest;
use App\Interfaces\Eloquent\IQueueService;
use App\Traits\Response;

class QueueController extends Controller
{
    use Response;

    /**
     * @var $queueService
     */
    private $queueService;

    /**
     * @param IQueueService $queueService
     */
    public function __construct(IQueueService $queueService)
    {
        $this->queueService = $queueService;
    }

    /**
     * @param GetByCompanyIdsRequest $request
     */
    public function getByCompanyIds(GetByCompanyIdsRequest $request)
    {
        $companyIds = $request->user()->companies->pluck('id')->toArray();

        foreach ($request->companyIds as $companyId) {
            if (!in_array($companyId, $companyIds)) {
                return $this->error('Unauthorized', 401);
            }
        }

        $getByCompanyIdsResponse = $this->queueService->getByCompanyIds(
            $request->companyIds,
            $request->pageIndex,
            $request->pageSize,
            $request->keyword
        );

        if ($getByCompanyIdsResponse->isSuccess()) {
            return $this->success(
                $getByCompanyIdsResponse->getMessage(),
                $getByCompanyIdsResponse->getData(),
                $getByCompanyIdsResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getByCompanyIdsResponse->getMessage(),
                $getByCompanyIdsResponse->getStatusCode()
            );
        }
    }

    /**
     * @param GetByIdRequest $request
     */
    public function getById(GetByIdRequest $request)
    {
        $getByIdResponse = $this->queueService->getById(
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
        $createResponse = $this->queueService->create(
            $request->companyId,
            $request->name,
            $request->short,
            $request->groupCode,
            $request->otsCode
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
        $updateResponse = $this->queueService->update(
            $request->id,
            $request->companyId,
            $request->name,
            $request->short,
            $request->groupCode,
            $request->otsCode
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

    public function delete(DeleteRequest $request)
    {
        $deleteResponse = $this->queueService->delete(
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
