<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\QueueController\GetByCompanyIdsRequest;
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
        return $this->success('Queues', $this->queueService->getByCompanyIds($request->companyIds));
    }
}
