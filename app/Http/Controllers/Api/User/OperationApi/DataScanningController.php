<?php

namespace App\Http\Controllers\Api\User\OperationApi;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\OperationApi\DataScanningController\GetDataScanningDetailsRequest;
use App\Http\Requests\Api\User\OperationApi\DataScanningController\GetDataScanNumbersListRequest;
use App\Http\Requests\Api\User\OperationApi\DataScanningController\GetDataScanSummaryListRequest;
use App\Http\Requests\Api\User\OperationApi\DataScanningController\GetDataScanTablesRequest;
use App\Interfaces\OperationApi\IDataScanningService;
use App\Traits\Response;

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
}
