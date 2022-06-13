<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\CompetenceController\GetByCompanyIdsRequest;
use App\Interfaces\Eloquent\ICompetenceService;
use App\Traits\Response;

class CompetenceController extends Controller
{
    use Response;

    private $competenceService;

    public function __construct(ICompetenceService $competenceService)
    {
        $this->competenceService = $competenceService;
    }

    public function getByCompanyIds(GetByCompanyIdsRequest $request)
    {
        return $this->success('Competences', $this->competenceService->getByCompanyIds($request->companyIds));
    }
}
