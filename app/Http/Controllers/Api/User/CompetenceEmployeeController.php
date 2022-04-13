<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Interfaces\Eloquent\IEmployeeService;
use App\Interfaces\Eloquent\ICompetenceService;
use App\Http\Requests\Api\User\CompetenceEmployeeController\GetEmployeeCompetencesRequest;
use App\Http\Requests\Api\User\CompetenceEmployeeController\SetEmployeeCompetencesRequest;
use App\Http\Requests\Api\User\CompetenceEmployeeController\GetCompetenceEmployeesRequest;
use App\Http\Requests\Api\User\CompetenceEmployeeController\SetCompetenceEmployeesRequest;
use App\Traits\Response;

class CompetenceEmployeeController extends Controller
{
    use Response;

    private $employeeService;
    private $competenceService;

    public function __construct(IEmployeeService $employeeService, ICompetenceService $competenceService)
    {
        $this->employeeService = $employeeService;
        $this->competenceService = $competenceService;
    }

    public function getEmployeeCompetences(GetEmployeeCompetencesRequest $request)
    {
        return $this->success('Employee competences', $this->employeeService->getEmployeeCompetences($request->employeeId));
    }

    public function setEmployeeCompetences(SetEmployeeCompetencesRequest $request)
    {
        return $this->success('Employee competences updated', $this->employeeService->setEmployeeCompetences($request->employeeId, $request->competenceIds));
    }

    public function getCompetenceEmployees(GetCompetenceEmployeesRequest $request)
    {
        return $this->success('Competence employees', $this->competenceService->getCompetenceEmployees($request->competenceId));
    }

    public function setCompetenceEmployees(SetCompetenceEmployeesRequest $request)
    {
        return $this->success('Competence employees updated', $this->competenceService->setCompetenceEmployees($request->competenceId, $request->employeeIds));
    }
}

