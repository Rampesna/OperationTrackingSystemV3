<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\TargetTypeController\GetAllRequest;
use App\Interfaces\Eloquent\ITargetTypeService;
use App\Traits\Response;

class TargetTypeController extends Controller
{
    use Response;

    private $targetTypeService;

    public function __construct(ITargetTypeService $targetTypeService)
    {
        $this->targetTypeService = $targetTypeService;
    }

    public function getAll(GetAllRequest $request)
    {
        $targetTypes = $this->targetTypeService->getAll();
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
