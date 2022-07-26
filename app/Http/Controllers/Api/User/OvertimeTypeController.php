<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\OvertimeTypeController\GetAllRequest;
use App\Interfaces\Eloquent\IOvertimeTypeService;
use App\Traits\Response;

class OvertimeTypeController extends Controller
{
    use Response;

    /**
     * @var $overtimeTypeService
     */
    private $overtimeTypeService;

    /**
     * @param IOvertimeTypeService $overtimeTypeService
     */
    public function __construct(IOvertimeTypeService $overtimeTypeService)
    {
        $this->overtimeTypeService = $overtimeTypeService;
    }

    /**
     * @param GetAllRequest $request
     */
    public function getAll(GetAllRequest $request)
    {
        $getAllResponse = $this->overtimeTypeService->getAll();
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
