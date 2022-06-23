<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\CompetenceController\GetByCompanyIdsRequest;
use App\Http\Requests\Api\User\CompetenceController\GetByIdRequest;
use App\Http\Requests\Api\User\CompetenceController\CreateRequest;
use App\Http\Requests\Api\User\CompetenceController\UpdateRequest;
use App\Http\Requests\Api\User\CompetenceController\DeleteRequest;
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
        return $this->success('Competences', $this->competenceService->getByCompanyIds(
            $request->companyIds,
            $request->pageIndex,
            $request->pageSize,
            $request->keyword
        ));
    }

    public function getById(GetByIdRequest $request)
    {
        return $this->success('Competence', $this->competenceService->getById(
            $request->id
        ));
    }

    public function create(CreateRequest $request)
    {
        return $this->success('Competence created', $this->competenceService->create(
            $request->companyId,
            $request->name
        ));
    }

    public function update(UpdateRequest $request)
    {
        return $this->success('Competence updated', $this->competenceService->update(
            $request->id,
            $request->companyId,
            $request->name
        ));
    }

    public function delete(DeleteRequest $request)
    {
        return $this->success('Competence deleted', $this->competenceService->delete(
            $request->id
        ));
    }
}
