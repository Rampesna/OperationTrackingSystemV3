<?php

namespace App\Http\Controllers\Api\Global;

use App\Http\Controllers\Controller;
use App\Interfaces\Eloquent\IEmployeeService;
use App\Http\Requests\Api\Global\BirthdayController\CheckBirthdaysRequest;
use App\Interfaces\OneSignal\INotificationService;
use App\Services\OneSignal\NotificationService;
use App\Traits\Response;

class BirthdayController extends Controller
{
    use Response;

    /**
     * @var $employeeService
     */
    private $employeeService;

    /**
     * @param IEmployeeService $employeeService
     */
    public function __construct(IEmployeeService $employeeService)
    {
        $this->employeeService = $employeeService;
    }

    /**
     * @param CheckBirthdaysRequest $request
     */
    public function checkBirthdays(CheckBirthdaysRequest $request)
    {
        $response = $this->employeeService->getByCompanyIdsWithPersonalInformation(
            0,
            1000,
            [1,2]
        );

        if ($response->isSuccess()) {
            $notificationService = new NotificationService;
            foreach ($response->getData() as $employee) {
                if ($employee->personalInformation) {
                    if (
                        date('m-d', strtotime($employee->personalInformation->birth_date)) ==
                        date('m-d', strtotime(now()))
                    ) {
                        if ($employee->device_token) {
                            $list[] = [
                                [$employee->device_token],
                                'İyi ki doğdun ' . ucwords($employee->name) . '!',
                                'Ayssoft ailesi olarak doğum gününüzü kutlar, sağlık mutluluk ve başarı dolu nice yıllar dileriz.'
                            ];
                            $notificationService->sendNotification(
                                [$employee->device_token],
                                'İyi ki doğdun ' . ucwords($employee->name) . '!',
                                'Ayssoft ailesi olarak doğum gününüzü kutlar, sağlık mutluluk ve başarı dolu nice yıllar dileriz.'
                            );
                        }
                    }
                }
            }

            return $this->success(
                'Notifications sent',
                $list,
                200
            );
        } else {
            return $this->error(
                $response->getMessage(),
                $response->getStatusCode()
            );
        }
    }
}
