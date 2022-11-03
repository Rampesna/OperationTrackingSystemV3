<?php

namespace App\Http\Controllers\Api\User\OperationApi;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\OperationApi\DataScanningController\GetDataScanningDetailsRequest;
use App\Http\Requests\Api\User\OperationApi\DataScanningController\GetDataScanNumbersListRequest;
use App\Http\Requests\Api\User\OperationApi\DataScanningController\GetDataScanSummaryListRequest;
use App\Http\Requests\Api\User\OperationApi\DataScanningController\GetDataScanTablesRequest;
use App\Http\Requests\Api\User\OperationApi\DataScanningController\SetDataScanningRequest;
use App\Http\Requests\Api\User\OperationApi\DataScanningController\SetCallDataScanningRequest;
use App\Http\Requests\Api\User\OperationApi\DataScanningController\GetDataScanGibListRequest;
use App\Interfaces\OperationApi\IDataScanningService;
use App\Traits\Response;
use Maatwebsite\Excel\Facades\Excel;

class DataScanningController extends Controller
{
    use Response;

    /**
     * @var $dataScanningService
     */
    private $dataScanningService;

    /**
     * @param IDataScanningService $dataScanningService
     */
    public function __construct(IDataScanningService $dataScanningService)
    {
        $this->dataScanningService = $dataScanningService;
    }

    /**
     * @param GetDataScanTablesRequest $request
     */
    public function getDataScanTables(GetDataScanTablesRequest $request)
    {
        $getDataScanTablesResponse = $this->dataScanningService->GetDataScanTables();
        if ($getDataScanTablesResponse->isSuccess()) {
            return $this->success(
                $getDataScanTablesResponse->getMessage(),
                $getDataScanTablesResponse->getData(),
                $getDataScanTablesResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getDataScanTablesResponse->getMessage(),
                $getDataScanTablesResponse->getStatusCode()
            );
        }
    }

    /**
     * @param GetDataScanNumbersListRequest $request
     */
    public function getDataScanNumbersList(GetDataScanNumbersListRequest $request)
    {
        $getDataScanNumbersListResponse = $this->dataScanningService->GetDataScanNumbersList(
            $request->startDate,
            $request->endDate,
            $request->tableName,
            $request->companyIds
        );
        if ($getDataScanNumbersListResponse->isSuccess()) {
            return $this->success(
                $getDataScanNumbersListResponse->getMessage(),
                $getDataScanNumbersListResponse->getData(),
                $getDataScanNumbersListResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getDataScanNumbersListResponse->getMessage(),
                $getDataScanNumbersListResponse->getStatusCode()
            );
        }
    }

    /**
     * @param GetDataScanningDetailsRequest $request
     */
    public function getDataScanningDetails(GetDataScanningDetailsRequest $request)
    {
        $getDataScanningDetailsResponse = $this->dataScanningService->GetDataScanningDetails(
            $request->startDate,
            $request->endDate,
            $request->tableName,
            $request->type,
            $request->companyIds
        );
        if ($getDataScanningDetailsResponse->isSuccess()) {
            return $this->success(
                $getDataScanningDetailsResponse->getMessage(),
                $getDataScanningDetailsResponse->getData(),
                $getDataScanningDetailsResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getDataScanningDetailsResponse->getMessage(),
                $getDataScanningDetailsResponse->getStatusCode()
            );
        }
    }

    /**
     * @param GetDataScanSummaryListRequest $request
     */
    public function getDataScanSummaryList(GetDataScanSummaryListRequest $request)
    {
        $getDataScanSummaryListResponse = $this->dataScanningService->GetDataScanSummaryList(
            $request->startDate,
            $request->endDate,
            $request->companyIds
        );
        if ($getDataScanSummaryListResponse->isSuccess()) {
            return $this->success(
                $getDataScanSummaryListResponse->getMessage(),
                $getDataScanSummaryListResponse->getData(),
                $getDataScanSummaryListResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getDataScanSummaryListResponse->getMessage(),
                $getDataScanSummaryListResponse->getStatusCode()
            );
        }
    }

    /**
     * @param SetDataScanningRequest $request
     */
    public function setDataScanning(SetDataScanningRequest $request)
    {
        $file = $request->file('file');

        $jobList = [];
        $jobs = Excel::toCollection(null, $file);

        foreach ($jobs[0] as $job) {
            $jobList[] = [
                'grupKodu' => $request->groupCode,
                'vknTckn' => $job[1],
                'unvan' => $job[2],
                'sehir' => !empty($job[3]) && is_string($job[3]) ? str_replace('.', '', str_replace('-', '', str_replace('*', '', $job[3]))) : ' ',
                'ilce' => !empty($job[4]) && is_string($job[4]) ? str_replace('.', '', str_replace('-', '', str_replace('*', '', $job[4]))) : ' ',
                'islemAdi' => $request->processName,
                'Oncelik' => $request->priority,
                'tabloAdi' => $request->tableName,
            ];
        }

        $setDataScanningResponse = $this->dataScanningService->SetDataScanning($jobList);

        if ($setDataScanningResponse->isSuccess()) {
            return $this->success(
                $setDataScanningResponse->getMessage(),
                $setDataScanningResponse->getData(),
                $setDataScanningResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $setDataScanningResponse->getMessage(),
                $setDataScanningResponse->getStatusCode()
            );
        }
    }

    /**
     * @param SetCallDataScanningRequest $request
     */
    public function setCallDataScanning(SetCallDataScanningRequest $request)
    {
        set_time_limit(86400);
        $file = $request->file('file');

        $jobList = [];
        $responses = [];
        $jobs = Excel::toCollection(null, $file);

        foreach ($jobs[0] as $job) {
            $jobList[] = [
                'anketId' => intval($request->surveyId),
                'musteriAdi' => $job[0] ?? '',
                'musteriTel' => strval($job[1]) ?? '',
                'yetkili' => $job[2] ?? '',
                'cariId' => $job[3] ?? '',
            ];
        }

        if (count($jobList) > 100) {
            $list = collect($jobList)->chunk(100)->toArray();
            $tryCount = 0;
            foreach ($list as $jList) {
                retry:
                if ($tryCount == 5) {
                    continue;
                }
                try {
                    $setCallDataScanningResponse = $this->dataScanningService->SetCallDataScanning($jList);
                    if ($setCallDataScanningResponse->isSuccess()) {
                        $responses[] = $this->dataScanningService->SetCallDataScanning($jList)->getData();
                        sleep(3);
                    } else {
                        sleep(3);
                        $tryCount++;
                        goto retry;
                    }
                } catch (\Exception $exception) {
                    sleep(3);
                    $tryCount++;
                    goto retry;
                }
            }
        } else {
            $setCallDataScanningResponse = $this->dataScanningService->SetCallDataScanning($jobList);
            if ($setCallDataScanningResponse->isSuccess()) {
                $responses[] = $setCallDataScanningResponse->getData();
            }
        }

        return $this->success('Call data scannings', $responses);
    }

    /**
     * @param GetDataScanGibListRequest $request
     */
    public function getDataScanGibList(GetDataScanGibListRequest $request)
    {
        $getDataScanGibListResponse = $this->dataScanningService->GetDataScanGibList(
            $request->startDate,
            $request->endDate,
            $request->companyIds
        );
        if ($getDataScanGibListResponse->isSuccess()) {
            return $this->success(
                $getDataScanGibListResponse->getMessage(),
                $getDataScanGibListResponse->getData(),
                $getDataScanGibListResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getDataScanGibListResponse->getMessage(),
                $getDataScanGibListResponse->getStatusCode()
            );
        }
    }
}
