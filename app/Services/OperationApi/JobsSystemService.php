<?php


namespace App\Services\OperationApi;

use App\Interfaces\OperationApi\IJobsSystemService;
use App\Services\ServiceResponse;

class JobsSystemService extends OperationApiService implements IJobsSystemService
{
    /**
     * @param array $jobList
     *
     * @return ServiceResponse
     */
    public function SetJobsExcel(
        array $jobList
    ): ServiceResponse
    {
        $endpoint = "JobsSystem/SetJobsExcel";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        return new ServiceResponse(
            true,
            'Set jobs excel',
            200,
            json_decode($this->callApi($this->baseUrl . $endpoint, 'post', $headers, $jobList)->body())
        );
    }

    /**
     * @param int $id
     * @param int $priority
     * @param int $type
     *
     * @return ServiceResponse
     */
    public function SetJobsUyumIsId(
        int $id,
        int $priority,
        int $type
    ): ServiceResponse
    {
        $endpoint = "JobsSystem/SetJobsExcel";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $parameters = [
            'UyumIsId' => $id,
            'Oncelik' => $priority,
            'Turu' => $type
        ];

        return new ServiceResponse(
            true,
            'Set jobs uyum is id',
            200,
            $this->callApi($this->baseUrl . $endpoint, 'post', $headers, $parameters)['response']
        );
    }

    /**
     * @return ServiceResponse
     */
    public function SetJobSuspend(): ServiceResponse
    {
        $endpoint = "JobsSystem/SetJobSuspend";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        return new ServiceResponse(
            true,
            'Set job suspend',
            200,
            $this->callApi($this->baseUrl . $endpoint, 'post', $headers)['response']
        );
    }

    /**
     * @param int $id
     *
     * @return ServiceResponse
     */
    public function SetJobCaseWorkDelete(
        int $id
    ): ServiceResponse
    {
        $endpoint = "JobsSystem/SetJobCaseWorkDelete";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $parameters = [
            'Id' => $id
        ];

        return new ServiceResponse(
            true,
            'Set job case work delete',
            200,
            $this->callApi($this->baseUrl . $endpoint, 'post', $headers, $parameters)['response']
        );
    }

    /**
     * @param array $jobList
     *
     * @return ServiceResponse
     */
    public function SetJobsClosedExcel(
        array $jobList
    ): ServiceResponse
    {
        $endpoint = "JobsSystem/SetJobsClosedExcel";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        return new ServiceResponse(
            true,
            'Set jobs closed excel',
            200,
            $this->callApi($this->baseUrl . $endpoint, 'post', $headers, $jobList)['response']
        );
    }
}
