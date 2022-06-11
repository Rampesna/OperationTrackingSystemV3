<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\PersonReportController\GetPersonAppointmentReportRequest;
use App\Interfaces\OperationApi\IPersonReportService;
use App\Traits\Response;

class PersonReportController extends Controller
{
    use Response;

    private $personReportService;

    public function __construct(IPersonReportService $personReportService)
    {
        $this->personReportService = $personReportService;
    }

    public function getPersonAppointmentReport(GetPersonAppointmentReportRequest $request)
    {
        return $this->success('Person appointments', $this->personReportService->GetPersonAppointmentReport(
            $request->companyIds
        ));
    }
}
