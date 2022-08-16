<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\BatchSmsController\SendToEmployeesRequest;
use App\Http\Requests\Api\User\BatchSmsController\SendToNumbersRequest;
use App\Interfaces\Eloquent\IEmployeeService;
use App\Interfaces\MesajPaneli\IMesajPaneliService;
use App\Traits\Response;

class BatchSmsController extends Controller
{
    use Response;

    /**
     * @var $employeeService
     */
    private $employeeService;

    /**
     * @var $mesajPaneliService
     */
    private $mesajPaneliService;

    /**
     * @param IMesajPaneliService $mesajPaneliService
     * @param IEmployeeService $employeeService
     */
    public function __construct(
        IMesajPaneliService $mesajPaneliService,
        IEmployeeService    $employeeService
    )
    {
        $this->mesajPaneliService = $mesajPaneliService;
        $this->employeeService = $employeeService;
    }

    /**
     * @param SendToEmployeesRequest $request
     */
    public function sendToEmployees(SendToEmployeesRequest $request)
    {
        $employees = $this->employeeService->getByIds(
            $request->employeeIds
        );
        if ($employees->isSuccess()) {
            $phoneNumbers = [];
            foreach ($employees->getData() as $employee) {
                if ($employee->phone) $phoneNumbers[] = $employee->phone;
            }
            $sendSms = $this->mesajPaneliService->sendSms(
                [[
                    'msg' => $request->message,
                    'tel' => $phoneNumbers
                ]]
            );

            return $this->success(
                $sendSms->getMessage(),
                $sendSms->getData(),
                $sendSms->getStatusCode()
            );
        } else {
            return $this->error(
                $employees->getMessage(),
                $employees->getStatusCode()
            );
        }
    }

    /**
     * @param SendToNumbersRequest $request
     */
    public function sendToNumbers(SendToNumbersRequest $request)
    {
        $phoneNumbers = [];
        foreach ($request->numbers as $number) {
            $phoneNumbers[] = $number;
        }

        $sendSms = $this->mesajPaneliService->sendSms(
            [[
                'msg' => $request->message,
                'tel' => $phoneNumbers
            ]]
        );
        return $this->success(
            $sendSms->getMessage(),
            $sendSms->getData(),
            $sendSms->getStatusCode()
        );
    }
}
