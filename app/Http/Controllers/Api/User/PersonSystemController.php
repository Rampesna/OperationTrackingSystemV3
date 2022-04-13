<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\PersonSystemController\SetPersonAuthorityRequest;
use App\Http\Requests\Api\User\PersonSystemController\GetPersonDataScanListRequest;
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
        return $this->success('Person authorities successfully set', $this->personSystemService->SetPersonAuthority(
            $request->guids,
            $request->education,
            $request->assignment,
            $request->teamLead,
            $request->teamLeadAssistant
        ));
    }

    public function getPersonDataScanList(GetPersonDataScanListRequest $request)
    {
        return $this->success('Person data scan list', $this->personSystemService->GetPersonDataScanList());
    }
}
