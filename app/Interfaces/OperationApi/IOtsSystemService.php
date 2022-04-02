<?php


namespace App\Interfaces\OperationApi;

interface IOtsSystemService
{
    public function execSql(
        $query,
        $queryType,
        $connectionTimeout,
        $queryParameters,
        $databaseType,
        $taskNumber
    );

    public function execSqlList(
        $body
    );
}
