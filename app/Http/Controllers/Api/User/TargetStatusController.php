<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\TargetStatusController\GetAllRequest;
use App\Interfaces\Eloquent\ITargetStatusService;
use App\Traits\Response;

class TargetStatusController extends Controller
{
    use Response;

    private $targetStatusService;

    public function __construct(ITargetStatusService $targetStatusService)
    {
        $this->targetStatusService = $targetStatusService;
    }

    public function getAll(GetAllRequest $request)
    {
        $targetTypes = $this->targetStatusService->getAll();
        if ($targetTypes->isSuccess()) {
            return $this->success(
                $targetTypes->getMessage(),
                $targetTypes->getData(),
                $targetTypes->getStatusCode()
            );
        } else {
            return $this->error(
                $targetTypes->getMessage(),
                $targetTypes->getStatusCode()
            );
        }
    }

}
