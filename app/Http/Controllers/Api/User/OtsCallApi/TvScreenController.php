<?php

namespace App\Http\Controllers\Api\User\OtsCallApi;

use App\Http\Controllers\Controller;
use App\Interfaces\OtsCallApi\ITvScreenService;
use App\Traits\Response;

class TvScreenController extends Controller
{
    use Response;

    private $tvScreenService;

    public function __construct(ITvScreenService $tvScreenService)
    {
        $this->tvScreenService = $tvScreenService;
    }

    public function getSantral()
    {
        return $this->success('Santral', $this->tvScreenService->GetSantral());
    }
}
