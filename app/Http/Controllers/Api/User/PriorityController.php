<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Interfaces\Eloquent\IPriorityService;
use App\Http\Requests\Api\User\PriorityController\GetByCompanyIdRequest;
use App\Traits\Response;

class PriorityController extends Controller
{
    use Response;

    private $priorityService;

    public function __construct(IPriorityService $priorityService)
    {
        $this->priorityService = $priorityService;
    }

    public function getByCompanyId(GetByCompanyIdRequest $request)
    {
        return $this->success('Priorities', $this->priorityService->getByCompanyId($request->companyId));
    }
}
