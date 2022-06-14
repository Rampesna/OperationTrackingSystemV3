<?php

namespace App\Http\Controllers\Api\User\OperationApi;

use App\Http\Controllers\Controller;
use App\Interfaces\OperationApi\ITvScreenService;
use App\Traits\Response;

class TvScreenController extends Controller
{
    use Response;

    private $tvScreenService;

    public function __construct(ITvScreenService $tvScreenService)
    {
        $this->tvScreenService = $tvScreenService;
    }

    public function getJobList()
    {
        return $this->success('Job list', $this->tvScreenService->GetJobList());
    }
}
