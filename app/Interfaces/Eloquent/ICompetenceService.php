<?php

namespace App\Interfaces\Eloquent;

interface ICompetenceService extends IEloquentService
{
    /**
     * @param array $companyIds
     */
    public function getByCompanyIds(
        array $companyIds
    );

    /**
     * @param int $competenceId
     */
    public function getCompetenceEmployees(
        int $competenceId
    );

    /**
     * @param int $competenceId
     * @param array $employeeIds
     */
    public function setCompetenceEmployees(
        int   $competenceId,
        array $employeeIds
    );
}
