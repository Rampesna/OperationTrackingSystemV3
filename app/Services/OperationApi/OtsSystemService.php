<?php


namespace App\Services\OperationApi;

use App\Interfaces\OperationApi\IOtsSystemService;
use App\Services\ServiceResponse;

class OtsSystemService extends OperationApiService implements IOtsSystemService
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
    ): ServiceResponse
    {
        $endpoint = "OtsSystem/execSql";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $parameters = [
            'body' => [
                'query' => $query,
                'queryType' => $queryType,
                'conTimeOut' => $connectionTimeout,
                'queryParameters' => $queryParameters,
                'dbType' => $databaseType,
                'taskNo' => $taskNumber
            ]
        ];

        return new ServiceResponse(
            true,
            'Execute sql',
            200,
            $this->callApi($this->baseUrl . $endpoint, 'post', $headers, $parameters)['response']
        );
    }

    /**
     * @param string $body
     *
     * @return ServiceResponse
     */
    public function execSqlList(
        string $body
    ): ServiceResponse
    {
        $endpoint = "OtsSystem/execSqlList";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $parameters = [
            'body' => $body
        ];

        return new ServiceResponse(
            true,
            'Execute sql list',
            200,
            $this->callApi($this->baseUrl . $endpoint, 'post', $headers, $parameters)['response']
        );
    }
}
