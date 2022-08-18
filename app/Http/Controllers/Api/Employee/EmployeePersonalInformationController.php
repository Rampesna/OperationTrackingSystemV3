<?php

namespace App\Http\Controllers\Api\Employee;

use App\Http\Controllers\Controller;
use App\Interfaces\Eloquent\IEmployeePersonalInformationService;
use App\Http\Requests\Api\User\EmployeePersonalInformationController\GetByEmployeeIdRequest;
use App\Http\Requests\Api\User\EmployeePersonalInformationController\UpdateRequest;
use App\Traits\Response;

class EmployeePersonalInformationController extends Controller
{
    use Response;

    /**
     * @var $employeePersonalInformationService
     */
    private $employeePersonalInformationService;

    /**
     * @param IEmployeePersonalInformationService $employeePersonalInformationService
     */
    public function __construct(IEmployeePersonalInformationService $employeePersonalInformationService)
    {
        $this->employeePersonalInformationService = $employeePersonalInformationService;
    }

    /**
     * @param GetByEmployeeIdRequest $request
     */
    public function getByEmployeeId(GetByEmployeeIdRequest $request)
    {
        $getByEmployeeIdResponse = $this->employeePersonalInformationService->getByEmployeeId(
            $request->employeeId
        );
        if ($getByEmployeeIdResponse->isSuccess()) {
            return $this->success(
                $getByEmployeeIdResponse->getMessage(),
                $getByEmployeeIdResponse->getData(),
                $getByEmployeeIdResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getByEmployeeIdResponse->getMessage(),
                $getByEmployeeIdResponse->getStatusCode()
            );
        }
    }

    /**
     * @param UpdateRequest $request
     */
    public function update(UpdateRequest $request)
    {
        $updateResponse = $this->employeePersonalInformationService->update(
            $request->id,
            $request->birthDate,
            $request->civilStatus,
            $request->gender,
            $request->nationality,
            $request->bloodGroup,
            $request->education,
            $request->identity,
            $request->wifeWorkingStatus,
            $request->degreeOfObstacle,
            $request->numberOfChild,
            $request->educationStatus,
            $request->lastCompletedSchool,
            $request->address,
            $request->homePhoneNumber,
            $request->city,
            $request->postalCode,
            $request->bankName,
            $request->bankAccountType,
            $request->accountNumber,
            $request->iban,
            $request->emergencyPerson,
            $request->emergencyPersonDegree,
            $request->emergencyPersonPhoneNumber
        );
        if ($updateResponse->isSuccess()) {
            return $this->success(
                $updateResponse->getMessage(),
                $updateResponse->getData(),
                $updateResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $updateResponse->getMessage(),
                $updateResponse->getStatusCode()
            );
        }
    }
}
