<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Interfaces\Eloquent\ISaturdayPermitService;
use App\Http\Requests\Api\User\SaturdayPermitController\GetDateBetweenRequest;
use App\Http\Requests\Api\User\SaturdayPermitController\CancelRequest;
use App\Traits\Response;
use Illuminate\Http\Request;

class SaturdayPermitController extends Controller
{
    use Response;

    /**
     * @var $saturdayPermitService
     */
    private $saturdayPermitService;

    /**
     * @param ISaturdayPermitService $saturdayPermitService
     */
    public function __construct(ISaturdayPermitService $saturdayPermitService)
    {
        $this->saturdayPermitService = $saturdayPermitService;
    }

    /**
     * @param GetDateBetweenRequest $request
     */
    public function getDateBetween(GetDateBetweenRequest $request)
    {
        $getDateBetweenResponse = $this->saturdayPermitService->getDateBetween(
            $request->companyIds,
            $request->startDate,
            $request->endDate,
            $request->keyword,
            $request->jobDepartmentIds
        );
        if ($getDateBetweenResponse->isSuccess()) {
            return $this->success(
                $getDateBetweenResponse->getMessage(),
                $getDateBetweenResponse->getData(),
                $getDateBetweenResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getDateBetweenResponse->getMessage(),
                $getDateBetweenResponse->getStatusCode()
            );
        }
    }

    /**
     * @param CancelRequest $request
     */
    public function cancel(CancelRequest $request)
    {
        $cancelResponse = $this->saturdayPermitService->cancel(
            $request->id,
            $request->shiftGroupId,
            $request->cancelReasonId,
            $request->user()->id
        );
        if ($cancelResponse->isSuccess()) {
            return $this->success(
                $cancelResponse->getMessage(),
                $cancelResponse->getData(),
                $cancelResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $cancelResponse->getMessage(),
                $cancelResponse->getStatusCode()
            );
        }
    }
}
