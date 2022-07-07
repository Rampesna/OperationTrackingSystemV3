<?php


namespace App\Interfaces\OperationApi;

use App\Services\ServiceResponse;

interface IOtsSystemService
{
    /**
     * @param string $query
     * @param string $queryType
     * @param string $connectionTimeout
     * @param string $queryParameters
     * @param string $databaseType
     * @param string $taskNumber
     *
     * @return ServiceResponse
     */
    public function execSql(
        string $query,
        string $queryType,
        string $connectionTimeout,
        string $queryParameters,
        string $databaseType,
        string $taskNumber
    ): ServiceResponse;

    /**
     * @param string $body
     *
     * @return ServiceResponse
     */
    public function execSqlList(
        string $body
    ): ServiceResponse;
}
