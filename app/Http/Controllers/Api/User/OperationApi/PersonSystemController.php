<?php

namespace App\Http\Controllers\Api\User\OperationApi;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\OperationApi\PersonSystemController\GetPersonDataScanListRequest;
use App\Http\Requests\Api\User\OperationApi\PersonSystemController\SetPersonAuthorityRequest;
use App\Http\Requests\Api\User\OperationApi\PersonSystemController\SetPersonDataScanRequest;
use App\Http\Requests\Api\User\OperationApi\PersonSystemController\SetPersonDisplayTypeRequest;
use App\Http\Requests\Api\User\OperationApi\PersonSystemController\SetPersonWorkToDoTypeRequest;
use App\Interfaces\OperationApi\IPersonSystemService;
use App\Traits\Response;

class PersonSystemController extends Controller
{
    use Response;

    private $personSystemService;

    public function __construct(IPersonSystemService $personSystemService)
    {
        $this->personSystemService = $personSystemService;
    }

    public function setPersonAuthority(SetPersonAuthorityRequest $request)
    {
        return $this->success('Employee authorities successfully set', $this->personSystemService->SetPersonAuthority(
            $request->guids,
            $request->education,
            $request->assignment,
            $request->teamLead,
            $request->teamLeadAssistant
        ));
    }

    public function setPersonDataScan(SetPersonDataScanRequest $request)
    {
        return $this->success('Employee data scans successfully set', $this->personSystemService->SetPersonDataScan(
            $request->groupCode,
            $request->guids
        ));
    }

    public function getPersonDataScanList(GetPersonDataScanListRequest $request)
    {
        return $this->success('Employee data scan list', $this->personSystemService->GetPersonDataScanList());
    }

    public function setPersonDisplayType(SetPersonDisplayTypeRequest $request)
    {
        return $this->success('Employee lock type successfully set', $this->personSystemService->SetPersonDisplayType(
            $request->otsLockType,
            $request->guids
        ));
    }

    public function setPersonWorkToDoType(SetPersonWorkToDoTypeRequest $request)
    {
        return $this->success('Employee lock type successfully set', $this->personSystemService->SetPersonWorkToDoType(
            $request->jobCode,
            $request->guids
        ));
    }
}
