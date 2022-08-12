<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\CompetenceEmployeeController\GetCompetenceEmployeesRequest;
use App\Http\Requests\Api\User\CompetenceEmployeeController\GetEmployeeCompetencesRequest;
use App\Http\Requests\Api\User\CompetenceEmployeeController\SetCompetenceEmployeesRequest;
use App\Http\Requests\Api\User\CompetenceEmployeeController\SetEmployeeCompetencesRequest;
use App\Interfaces\Eloquent\ICompetenceService;
use App\Interfaces\Eloquent\IEmployeeService;
use App\Traits\Response;

class CompetenceEmployeeController extends Controller
{
    use Response;

    /**
     * @var $employeeService
     */
    private $employeeService;

    /**
     * @var $competenceService
     */
    private $competenceService;

    /**
     * @param IEmployeeService $employeeService
     * @param ICompetenceService $competenceService
     */
    public function __construct(
        IEmployeeService   $employeeService,
        ICompetenceService $competenceService
    )
    {
        $this->employeeService = $employeeService;
        $this->competenceService = $competenceService;
    }

    /**
     * @param GetEmployeeCompetencesRequest $request
     */
    public function getEmployeeCompetences(GetEmployeeCompetencesRequest $request)
    {
        $getEmployeeCompetencesResponse = $this->employeeService->getEmployeeCompetences($request->employeeId);
        if ($getEmployeeCompetencesResponse->isSuccess()) {
            return $this->success(
                $getEmployeeCompetencesResponse->getMessage(),
                $getEmployeeCompetencesResponse->getData(),
                $getEmployeeCompetencesResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getEmployeeCompetencesResponse->getMessage(),
                $getEmployeeCompetencesResponse->getStatusCode()
            );
        }
    }

    /**
     * @param SetEmployeeCompetencesRequest $request
     */
    public function setEmployeeCompetences(SetEmployeeCompetencesRequest $request)
    {
        $setEmployeeCompetencesResponse = $this->employeeService->setEmployeeCompetences($request->employeeId, $request->competenceIds ?? []);
        if ($setEmployeeCompetencesResponse->isSuccess()) {
            return $this->success(
                $setEmployeeCompetencesResponse->getMessage(),
                $setEmployeeCompetencesResponse->getData(),
                $setEmployeeCompetencesResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $setEmployeeCompetencesResponse->getMessage(),
                $setEmployeeCompetencesResponse->getStatusCode()
            );
        }
    }

    /**
     * @param GetCompetenceEmployeesRequest $request
     */
    public function getCompetenceEmployees(GetCompetenceEmployeesRequest $request)
    {
        $getCompetenceEmployeesResponse = $this->competenceService->getCompetenceEmployees($request->competenceId);
        if ($getCompetenceEmployeesResponse->isSuccess()) {
            return $this->success(
                $getCompetenceEmployeesResponse->getMessage(),
                $getCompetenceEmployeesResponse->getData(),
                $getCompetenceEmployeesResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getCompetenceEmployeesResponse->getMessage(),
                $getCompetenceEmployeesResponse->getStatusCode()
            );
        }
    }

    /**
     * @param SetCompetenceEmployeesRequest $request
     */
    public function setCompetenceEmployees(SetCompetenceEmployeesRequest $request)
    {
        $setCompetenceEmployeesResponse = $this->competenceService->setCompetenceEmployees($request->competenceId, $request->employeeIds);
        if ($setCompetenceEmployeesResponse->isSuccess()) {
            return $this->success(
                $setCompetenceEmployeesResponse->getMessage(),
                $setCompetenceEmployeesResponse->getData(),
                $setCompetenceEmployeesResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $setCompetenceEmployeesResponse->getMessage(),
                $setCompetenceEmployeesResponse->getStatusCode()
            );
        }
    }
}

