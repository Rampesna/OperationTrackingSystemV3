<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\LeavingReasonController\GetAllRequest;
use App\Interfaces\Eloquent\ILeavingReasonService;
use App\Traits\Response;

class LeavingReasonController extends Controller
{
    use Response;

    /**
     * @var $leavingReasonService
     */
    private $leavingReasonService;

    /**
     * @param ILeavingReasonService $leavingReasonService
     */
    public function __construct(ILeavingReasonService $leavingReasonService)
    {
        $this->leavingReasonService = $leavingReasonService;
    }

    /**
     * @param GetAllRequest $request
     */
    public function getAll(GetAllRequest $request)
    {
        $getAllResponse = $this->leavingReasonService->getAll();
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
}
