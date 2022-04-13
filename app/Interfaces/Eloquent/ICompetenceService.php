<?php

namespace App\Interfaces\Eloquent;

interface ICompetenceService extends IEloquentService
{
    /**
     * @param int $companyId
     */
    public function getByCompanyId(
        $companyId
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
