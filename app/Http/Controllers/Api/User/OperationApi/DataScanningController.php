<?php

namespace App\Http\Controllers\Api\User\OperationApi;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\OperationApi\DataScanningController\GetDataScanningDetailsRequest;
use App\Http\Requests\Api\User\OperationApi\DataScanningController\GetDataScanNumbersListRequest;
use App\Http\Requests\Api\User\OperationApi\DataScanningController\GetDataScanSummaryListRequest;
use App\Http\Requests\Api\User\OperationApi\DataScanningController\GetDataScanTablesRequest;
use App\Http\Requests\Api\User\OperationApi\DataScanningController\SetDataScanningRequest;
use App\Http\Requests\Api\User\OperationApi\DataScanningController\SetCallDataScanningRequest;
use App\Interfaces\OperationApi\IDataScanningService;
use App\Traits\Response;
use Maatwebsite\Excel\Facades\Excel;

class DataScanningController extends Controller
{
    use Response;

    private $dataScanningService;

    public function __construct(IDataScanningService $dataScanningService)
    {
        $this->dataScanningService = $dataScanningService;
    }

    public function getDataScanTables(GetDataScanTablesRequest $request)
    {
        return $this->success('Data scan tables', $this->dataScanningService->GetDataScanTables());
    }

    public function getDataScanNumbersList(GetDataScanNumbersListRequest $request)
    {
        return $this->success('Data scan number list', $this->dataScanningService->GetDataScanNumbersList(
            $request->startDate,
            $request->endDate,
            $request->tableName,
            $request->companyIds
        ));
    }

    public function getDataScanningDetails(GetDataScanningDetailsRequest $request)
    {
        return $this->success('Data scanning details', $this->dataScanningService->GetDataScanningDetails(
            $request->startDate,
            $request->endDate,
            $request->tableName,
            $request->type,
            $request->companyIds
        ));
    }

    public function getDataScanSummaryList(GetDataScanSummaryListRequest $request)
    {
        return $this->success('Data scan summary list', $this->dataScanningService->GetDataScanSummaryList(
            $request->startDate,
            $request->endDate,
            $request->companyIds
        ));
    }

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

        return $this->success('Data scannings', $this->dataScanningService->SetDataScanning($jobList));
    }

    public function setCallDataScanning(SetCallDataScanningRequest $request)
    {
        $file = $request->file('file');

        $jobList = [];
        $jobs = Excel::toCollection(null, $file);

        foreach ($jobs[0] as $job) {
            $jobList[] = [
                'anketId' => $request->surveyId,
                'musteriAdi' => $job[0] ?? '',
                'musteriTel' => $job[1] ?? '',
                'yetkili' => $job[2] ?? '',
                'cariId' => $job[3] ?? ''
            ];
        }

        return $this->success('Call data scannings', $this->dataScanningService->SetCallDataScanning($jobList));
    }
}
