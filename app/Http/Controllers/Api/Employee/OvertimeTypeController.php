<?php

namespace App\Http\Controllers\Api\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Employee\OvertimeTypeController\GetAllRequest;
use App\Interfaces\Eloquent\IOvertimeTypeService;
use App\Traits\Response;

class OvertimeTypeController extends Controller
{
    use Response;

    private $overtimeTypeService;

    public function __construct(IOvertimeTypeService $overtimeTypeService)
    {
        $this->overtimeTypeService = $overtimeTypeService;
    }

    public function getAll(GetAllRequest $request)
    {
        return $this->success('Employee overtime types', $this->overtimeTypeService->getAll());
    }
}
