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

    private $queueService;

    public function __construct(IQueueService $queueService)
    {
        $this->queueService = $queueService;
    }

    public function getByCompanyIds(GetByCompanyIdsRequest $request)
    {
        $companyIds = $request->user()->companies->pluck('id')->toArray();

        foreach ($request->companyIds as $companyId) {
            if (!in_array($companyId, $companyIds)) {
                return $this->error('Unauthorized', 401);
            }
        }

        return $this->success('Queues', $this->queueService->getByCompanyIds(
            $request->companyIds,
            $request->pageIndex,
            $request->pageSize,
            $request->keyword
        ));
    }

    public function getById(GetByIdRequest $request)
    {
        return $this->success('Queue', $this->queueService->getById(
            $request->id
        ));
    }

    public function create(CreateRequest $request)
    {
        return $this->success('Queue created', $this->queueService->create(
            $request->companyId,
            $request->name,
            $request->short,
            $request->groupCode,
            $request->otsCode
        ));
    }

    public function update(UpdateRequest $request)
    {
        return $this->success('Queue updated', $this->queueService->update(
            $request->id,
            $request->companyId,
            $request->name,
            $request->short,
            $request->groupCode,
            $request->otsCode
        ));
    }

    public function delete(DeleteRequest $request)
    {
        return $this->success('Queue deleted', $this->queueService->delete(
            $request->id
        ));
    }
}
