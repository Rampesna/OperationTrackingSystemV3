<?php

namespace App\Http\Controllers\Api\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Employee\QueueController\GetByCompanyIdRequest;
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
     * @param GetByCompanyIdRequest $request
     */
    public function getByCompanyId(GetByCompanyIdRequest $request)
    {
        $companyIds = $request->user()->company_id == 1 || $request->user()->company_id == 2 ? [1, 2] : [$request->user()->company_id];

        $getByCompanyIdsResponse = $this->queueService->getByCompanyIds(
            $companyIds,
            0,
            10000
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
}
