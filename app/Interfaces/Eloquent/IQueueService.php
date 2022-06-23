<?php

namespace App\Interfaces\Eloquent;

interface IQueueService extends IEloquentService
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
     * @param int $queueId
     */
    public function getQueueEmployees(
        int $queueId
    );

    /**
     * @param int $queueId
     * @param array $employeeIds
     */
    public function setQueueEmployees(
        int   $queueId,
        array $employeeIds
    );

    /**
     * @param int $companyId
     * @param string $name
     * @param string $short
     * @param int|null $groupCode
     * @param int|null $otsCode
     */
    public function create(
        int    $companyId,
        string $name,
        string $short,
        ?int   $groupCode = null,
        ?int   $otsCode = null
    );

    /**
     * @param int $id
     * @param int $companyId
     * @param string $name
     * @param string $short
     * @param int|null $groupCode
     * @param int|null $otsCode
     */
    public function update(
        int    $id,
        int    $companyId,
        string $name,
        string $short,
        ?int   $groupCode = null,
        ?int   $otsCode = null
    );
}
