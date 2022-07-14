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

    /**
     * @var $personSystemService
     */
    private $personSystemService;

    /**
     * @param IPersonSystemService $personSystemService
     */
    public function __construct(IPersonSystemService $personSystemService)
    {
        $this->personSystemService = $personSystemService;
    }

    /**
     * @param SetPersonAuthorityRequest $request
     */
    public function setPersonAuthority(SetPersonAuthorityRequest $request)
    {
        $setPersonAuthorityResponse = $this->personSystemService->SetPersonAuthority(
            $request->guids,
            $request->education,
            $request->assignment,
            $request->teamLead,
            $request->teamLeadAssistant
        );
        if ($setPersonAuthorityResponse->isSuccess()) {
            return $this->success(
                $setPersonAuthorityResponse->getMessage(),
                $setPersonAuthorityResponse->getData(),
                $setPersonAuthorityResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $setPersonAuthorityResponse->getMessage(),
                $setPersonAuthorityResponse->getStatusCode()
            );
        }
    }

    /**
     * @param SetPersonDataScanRequest $request
     */
    public function setPersonDataScan(SetPersonDataScanRequest $request)
    {
        $setPersonDataScanResponse = $this->personSystemService->SetPersonDataScan(
            $request->groupCode,
            $request->guids
        );
        if ($setPersonDataScanResponse->isSuccess()) {
            return $this->success(
                $setPersonDataScanResponse->getMessage(),
                $setPersonDataScanResponse->getData(),
                $setPersonDataScanResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $setPersonDataScanResponse->getMessage(),
                $setPersonDataScanResponse->getStatusCode()
            );
        }
    }

    /**
     * @param GetPersonDataScanListRequest $request
     */
    public function getPersonDataScanList(GetPersonDataScanListRequest $request)
    {
        $getPersonDataScanListResponse = $this->personSystemService->GetPersonDataScanList();
        if ($getPersonDataScanListResponse->isSuccess()) {
            return $this->success(
                $getPersonDataScanListResponse->getMessage(),
                $getPersonDataScanListResponse->getData(),
                $getPersonDataScanListResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getPersonDataScanListResponse->getMessage(),
                $getPersonDataScanListResponse->getStatusCode()
            );
        }
    }

    /**
     * @param SetPersonDisplayTypeRequest $request
     */
    public function setPersonDisplayType(SetPersonDisplayTypeRequest $request)
    {
        $setPersonDisplayTypeResponse = $this->personSystemService->SetPersonDisplayType(
            $request->otsLockType,
            $request->guids
        );
        if ($setPersonDisplayTypeResponse->isSuccess()) {
            return $this->success(
                $setPersonDisplayTypeResponse->getMessage(),
                $setPersonDisplayTypeResponse->getData(),
                $setPersonDisplayTypeResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $setPersonDisplayTypeResponse->getMessage(),
                $setPersonDisplayTypeResponse->getStatusCode()
            );
        }
    }

    /**
     * @param SetPersonWorkToDoTypeRequest $request
     */
    public function setPersonWorkToDoType(SetPersonWorkToDoTypeRequest $request)
    {
        $setPersonWorkToDoTypeResponse = $this->personSystemService->SetPersonWorkToDoType(
            $request->jobCode,
            $request->guids
        );
        if ($setPersonWorkToDoTypeResponse->isSuccess()) {
            return $this->success(
                $setPersonWorkToDoTypeResponse->getMessage(),
                $setPersonWorkToDoTypeResponse->getData(),
                $setPersonWorkToDoTypeResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $setPersonWorkToDoTypeResponse->getMessage(),
                $setPersonWorkToDoTypeResponse->getStatusCode()
            );
        }
    }
}
