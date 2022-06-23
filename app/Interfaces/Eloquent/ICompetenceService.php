<?php

namespace App\Interfaces\Eloquent;

interface ICompetenceService extends IEloquentService
{
    /**
     * @param array $companyIds
     * @param int $pageIndex
     * @param int $companyIds
     * @param string $keyword
     */
    public function getByCompanyIds(
        array  $companyIds,
        int    $pageIndex = 0,
        int    $pageSize = 10,
        string $keyword = null
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

    /**
     * @param int $companyId
     * @param string $name
     */
    public function create(
        int    $companyId,
        string $name
    );

    /**
     * @param int $id
     * @param int $companyId
     * @param string $name
     */
    public function update(
        int    $id,
        int    $companyId,
        string $name
    );
}
