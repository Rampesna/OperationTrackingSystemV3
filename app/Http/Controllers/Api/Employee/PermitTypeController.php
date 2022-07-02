<?php

namespace App\Http\Controllers\Api\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Employee\PermitTypeController\GetAllRequest;
use App\Interfaces\Eloquent\IPermitTypeService;
use App\Traits\Response;

class PermitTypeController extends Controller
{
    use Response;

    private $permitTypeService;

    public function __construct(IPermitTypeService $permitTypeService)
    {
        $this->permitTypeService = $permitTypeService;
    }

    public function getAll(GetAllRequest $request)
    {
        return $this->success('Employee permitTypes', $this->permitTypeService->getAll());
    }
}
