<?php

namespace App\Http\Controllers\Api\Global;

use App\Http\Controllers\Controller;
use App\Interfaces\Eloquent\IEmployeeService;
use App\Http\Requests\Api\Global\BirthdayController\CheckBirthdaysRequest;
use App\Interfaces\OneSignal\INotificationService;
use App\Mail\Employee\HappyBirthdayEmail;
use App\Mail\User\WelcomeEmail;
use App\Services\OneSignal\NotificationService;
use App\Traits\Response;
use Illuminate\Support\Facades\Mail;

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
        $list = [];
        $response = $this->employeeService->getByCompanyIdsWithPersonalInformation(
            0,
            1000,
            [1, 2]
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
                            $exploded = explode(' ', $employee->name);
                            $name = $exploded[0];
                            $list[] = [
                                [$employee->device_token],
                                ' 🎉🎉🎉 ' . 'İyi ki doğdun ' . ucwords($name) . ' 🎉🎉🎉 ',
                                'Ayssoft ailesi olarak doğum gününüzü kutlar, sağlık mutluluk ve başarı dolu nice yıllar dileriz.'
                            ];
                            $notificationService->sendNotification(
                                [$employee->device_token],
                                ' 🎉🎉🎉 ' . 'İyi ki doğdun ' . ucwords($name) . ' 🎉🎉🎉 ',
                                'Ayssoft ailesi olarak doğum gününüzü kutlar, sağlık mutluluk ve başarı dolu nice yıllar dileriz.'
                            );

                            Mail::to($employee->email)->send(new HappyBirthdayEmail(ucwords($name)));
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
