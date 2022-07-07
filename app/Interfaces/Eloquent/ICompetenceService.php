<?php

namespace App\Interfaces\Eloquent;

use App\Services\ServiceResponse;

interface ICompetenceService extends IEloquentService
{
    /**
     * @param array $companyIds
     * @param int $pageIndex
     * @param int $companyIds
     * @param string $keyword
     *
     * @return ServiceResponse
     */
    public function getByCompanyIds(
        array  $companyIds,
        int    $pageIndex = 0,
        int    $pageSize = 10,
        string $keyword = null
    );

    /**
     * @param int $competenceId
     *
     * @return ServiceResponse
     */
    public function getCompetenceEmployees(
        int $competenceId
    );

    /**
     * @param int $competenceId
     * @param array $employeeIds
     *
     * @return ServiceResponse
     */
    public function setCompetenceEmployees(
        int   $competenceId,
        array $employeeIds
    );

    /**
     * @param int $companyId
     * @param string $name
     *
     * @return ServiceResponse
     */
    public function create(
        int    $companyId,
        string $name
    );

    /**
     * @param int $id
     * @param int $companyId
     * @param string $name
     *
     * @return ServiceResponse
     */
    public function update(
        int    $id,
        int    $companyId,
        string $name
    );
}
