<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\IEmployeeService;
use App\Models\Eloquent\Employee;
use App\Models\Eloquent\Position;
use App\Services\OperationApi\OperationService;
use App\Services\ServiceResponse;
use Illuminate\Support\Facades\Crypt;

class EmployeeService implements IEmployeeService
{
    /**
     * @return ServiceResponse
     */
    public function getAll(): ServiceResponse
    {
        return new ServiceResponse(
            true,
            'All employees',
            200,
            Employee::all()
        );
    }

    /**
     * @return ServiceResponse
     */
    public function getAllWorkers(): ServiceResponse
    {
        return new ServiceResponse(
            true,
            'All worker employees',
            200,
            Employee::where('leave', 0)->get()
        );
    }

    /**
     * @param int $id
     *
     * @return ServiceResponse
     */
    public function getById(
        int $id
    ): ServiceResponse
    {
        $employee = Employee::with([
            'jobDepartment',
            'company',
        ])->find($id);
        if ($employee) {
            return new ServiceResponse(
                true,
                'Employee',
                200,
                $employee
            );
        } else {
            return new ServiceResponse(
                false,
                'Employee not found',
                404,
                null
            );
        }
    }

    /**
     * @param int $id
     *
     * @return ServiceResponse
     */
    public function getProfile(
        int $id
    ): ServiceResponse
    {
        $employee = Employee::with([
            'personalInformation',
            'jobDepartment',
            'company',
        ])->find($id);
        if ($employee) {
            return new ServiceResponse(
                true,
                'Employee',
                200,
                [
                    'id' => $employee->id,
                    'guid' => $employee->guid,
                    'name' => $employee->name,
                    'email' => $employee->email,
                    'phone' => $employee->phone,
                    'identity' => $employee->identity,
                    'image' => $employee->image,
                    'santral_code' => $employee->santral_code,
                    'device_token' => $employee->device_token,
                    'theme' => $employee->theme,
                    'birth_date' => $employee->personalInformation->birth_date,
                    'jobDepartment' => [
                        'id' => $employee->jobDepartment->id,
                        'name' => $employee->jobDepartment->name,
                    ],
                    'company' => [
                        'id' => $employee->company->id,
                        'name' => $employee->company->name,
                    ],
                ]
            );
        } else {
            return new ServiceResponse(
                false,
                'Employee not found',
                404,
                null
            );
        }
    }

    /**
     * @param string $name
     * @param string $email
     * @param string $password
     *
     * @return ServiceResponse
     */
    public function register(
        string $name,
        string $email,
        string $password
    ): ServiceResponse
    {
        $employee = new Employee;
        $employee->company_id = 1;
        $employee->role_id = 1;
        $employee->name = $name;
        $employee->email = $email;
        $employee->password = bcrypt($password);
        $employee->suspend = 0;
        $employee->saturday_permit_order = 1;
        $employee->save();

        return new ServiceResponse(
            true,
            'Employee registered',
            201,
            $employee
        );
    }

    /**
     * @param array $ids
     *
     * @return ServiceResponse
     */
    public function getByIds(
        array $ids
    ): ServiceResponse
    {
        return new ServiceResponse(
            true,
            'Employees found',
            200,
            Employee::whereIn('id', $ids)->get()
        );
    }

    /**
     * @param string $email
     *
     * @return ServiceResponse
     */
    public function getByEmail(
        string $email
    ): ServiceResponse
    {
        return new ServiceResponse(
            true,
            'Employee by email',
            200,
            Employee::where('email', $email)->first()
        );
    }

    /**
     * @param int $employeeId
     * @param int $theme
     *
     * @return ServiceResponse
     */
    public function swapTheme(
        int $employeeId,
        int $theme
    ): ServiceResponse
    {
        $employee = $this->getById($employeeId);
        if ($employee->isSuccess()) {
            $employee->getData()->theme = $theme;
            $employee->getData()->save();

            return new ServiceResponse(
                true,
                'Theme swapped',
                200,
                $employee->getData()
            );
        } else {
            return $employee;
        }
    }

    /**
     * @param int $employeeId
     * @param string $deviceToken
     *
     * @return ServiceResponse
     */
    public function setDeviceToken(
        int    $employeeId,
        string $deviceToken
    ): ServiceResponse
    {
        $employee = $this->getById($employeeId);
        if ($employee->isSuccess()) {
            $employee->getData()->device_token = $deviceToken;
            $employee->getData()->save();

            return new ServiceResponse(
                true,
                'Device token set',
                200,
                $employee->getData()
            );
        } else {
            return $employee;
        }
    }

    /**
     * @param int $pageIndex
     * @param int $pageSize
     * @param array $companyIds
     * @param int $leave
     * @param string|null $keyword
     * @param array|null $jobDepartmentIds
     *
     * @return ServiceResponse
     */
    public function getByCompanyIds(
        int         $pageIndex = 0,
        int         $pageSize = 10,
        array       $companyIds = [],
        int         $leave = 0,
        string|null $keyword = null,
        array|null  $jobDepartmentIds = []
    ): ServiceResponse
    {
        $employees = Employee::with([
            'company',
            'jobDepartment',
        ])->orderBy('name')->whereIn('company_id', $companyIds)
            ->where('leave', $leave);

        if ($keyword) {
            $employees->where(function ($employees) use ($keyword) {
                $employees
                    ->where('name', 'like', '%' . $keyword . '%')
                    ->orWhere('identity', 'like', '%' . $keyword . '%')
                    ->orWhere('email', 'like', '%' . $keyword . '%')
                    ->orWhere('phone', 'like', '%' . $keyword . '%');
            });

        }

        if ($jobDepartmentIds && count($jobDepartmentIds) > 0) {
            $employees->whereIn('job_department_id', $jobDepartmentIds);
        }

        return new ServiceResponse(
            true,
            'Employees',
            200,
            [
                'totalCount' => $employees->count(),
                'pageIndex' => $pageIndex,
                'pageSize' => $pageSize,
                'employees' => $employees->skip($pageSize * $pageIndex)
                    ->take($pageSize)
                    ->get()
            ]
        );
    }

    /**
     * @param int $pageIndex
     * @param int $pageSize
     * @param array $companyIds
     * @param int $leave
     * @param string|null $keyword
     * @param array|null $jobDepartmentIds
     *
     * @return ServiceResponse
     */
    public function getByCompanyIdsWithBalance(
        int         $pageIndex = 0,
        int         $pageSize = 10,
        array       $companyIds = [],
        int         $leave = 0,
        string|null $keyword = null,
        array|null  $jobDepartmentIds = []
    ): ServiceResponse
    {
        $employees = Employee::with([
            'jobDepartment'
        ])->whereIn('company_id', $companyIds)
            ->where('leave', $leave);

        if ($keyword) {
            $employees->where(function ($employees) use ($keyword) {
                $employees
                    ->where('name', 'like', '%' . $keyword . '%')
                    ->orWhere('identity', 'like', '%' . $keyword . '%')
                    ->orWhere('email', 'like', '%' . $keyword . '%')
                    ->orWhere('phone', 'like', '%' . $keyword . '%');
            });

        }

        if ($jobDepartmentIds && count($jobDepartmentIds) > 0) {
            $employees->whereIn('job_department_id', $jobDepartmentIds);
        }

        return new ServiceResponse(
            true,
            'Employees',
            200,
            [
                'totalCount' => $employees->count(),
                'pageIndex' => $pageIndex,
                'pageSize' => $pageSize,
                'employees' => $employees->skip($pageSize * $pageIndex)
                    ->take($pageSize)
                    ->get()->append('balance')
            ]
        );
    }

    /**
     * @param int $pageIndex
     * @param int $pageSize
     * @param array $companyIds
     * @param int $leave
     * @param string|null $keyword
     * @param array|null $jobDepartmentIds
     *
     * @return ServiceResponse
     */
    public function getByCompanyIdsWithPersonalInformation(
        int         $pageIndex = 0,
        int         $pageSize = 10,
        array       $companyIds = [],
        int         $leave = 0,
        string|null $keyword = null,
        array|null  $jobDepartmentIds = []
    ): ServiceResponse
    {
        $employees = Employee::with([
            'personalInformation',
        ])->whereIn('company_id', $companyIds)->where('leave', $leave);

        if ($keyword) {
            $employees->where('name', 'like', '%' . $keyword . '%');
        }

        if ($jobDepartmentIds && count($jobDepartmentIds) > 0) {
            $employees->whereIn('job_department_id', $jobDepartmentIds);
        }

        return new ServiceResponse(
            true,
            'Employees',
            200,
            $employees->orderBy('name')->skip($pageIndex * $pageSize)
                ->take($pageSize)
                ->get()
        );
    }

    /**
     * @param int $pageIndex
     * @param int $pageSize
     * @param array $companyIds
     * @param int $leave
     * @param string|null $keyword
     * @param array|null $jobDepartmentIds
     *
     * @return ServiceResponse
     */
    public function getByCompanyIdsWithDevices(
        int         $pageIndex = 0,
        int         $pageSize = 10,
        array       $companyIds = [],
        int         $leave = 0,
        string|null $keyword = null,
        array|null  $jobDepartmentIds = []
    ): ServiceResponse
    {
        $employees = Employee::with([
            'devices' => function ($devices) {
                $devices->with([
                    'status',
                    'category'
                ]);
            },
        ])->whereIn('company_id', $companyIds)->where('leave', $leave);

        if ($keyword) {
            $employees->where('name', 'like', '%' . $keyword . '%');
        }

        if ($jobDepartmentIds && count($jobDepartmentIds) > 0) {
            $employees->whereIn('job_department_id', $jobDepartmentIds);
        }

        return new ServiceResponse(
            true,
            'Employees',
            200,
            [
                'totalCount' => $employees->count(),
                'pageIndex' => $pageIndex,
                'pageSize' => $pageSize,
                'employees' => $employees->skip($pageSize * $pageIndex)
                    ->take($pageSize)
                    ->get()
            ]
        );
    }

    /**
     * @param int $employeeId
     *
     * @return ServiceResponse
     */
    public function getEmployeeQueues(
        int $employeeId
    ): ServiceResponse
    {
        $employee = $this->getById($employeeId);
        if ($employee->isSuccess()) {
            return new ServiceResponse(
                true,
                'Employee queues',
                200,
                $employee->getData()->queues
            );
        } else {
            return $employee;
        }
    }

    /**
     * @param int $employeeId
     * @param array $queueIds
     *
     * @return ServiceResponse
     */
    public function setEmployeeQueues(
        int   $employeeId,
        array $queueIds
    ): ServiceResponse
    {
        $employee = $this->getById($employeeId);
        if ($employee->isSuccess()) {
            return new ServiceResponse(
                true,
                'Employee queues synced',
                200,
                $employee->getData()->queues()->sync($queueIds)
            );
        } else {
            return $employee;
        }
    }

    /**
     * @param int $employeeId
     *
     * @return ServiceResponse
     */
    public function getEmployeeCompetences(
        int $employeeId
    ): ServiceResponse
    {
        $employee = $this->getById($employeeId);
        if ($employee->isSuccess()) {
            return new ServiceResponse(
                true,
                'Employee competences',
                200,
                $employee->getData()->competences
            );
        } else {
            return $employee;
        }
    }

    /**
     * @param int $employeeId
     * @param array $competenceIds
     *
     * @return ServiceResponse
     */
    public function setEmployeeCompetences(
        int   $employeeId,
        array $competenceIds
    ): ServiceResponse
    {
        $employee = $this->getById($employeeId);
        if ($employee->isSuccess()) {
            return new ServiceResponse(
                true,
                'Employee competences synced',
                200,
                $employee->getData()->competences()->sync($competenceIds)
            );
        } else {
            return $employee;
        }
    }

    /**
     * @param int $employeeId
     *
     * @return ServiceResponse
     */
    public function getEmployeeShiftGroups(
        int $employeeId
    ): ServiceResponse
    {
        $employee = $this->getById($employeeId);
        if ($employee->isSuccess()) {
            return new ServiceResponse(
                true,
                'Employee shift groups',
                200,
                $employee->getData()->shiftGroups
            );
        } else {
            return $employee;
        }
    }

    /**
     * @param int $employeeId
     * @param array $shiftGroupIds
     *
     * @return ServiceResponse
     */
    public function setEmployeeShiftGroups(
        int   $employeeId,
        array $shiftGroupIds
    ): ServiceResponse
    {
        $employee = $this->getById($employeeId);
        if ($employee->isSuccess()) {
            return new ServiceResponse(
                true,
                'Employee shift groups synced',
                200,
                $employee->getData()->shiftGroups()->sync($shiftGroupIds)
            );
        } else {
            return $employee;
        }
    }

    /**
     * @param int $employeeId
     * @param int $jobDepartmentId
     *
     * @return ServiceResponse
     */
    public function updateJobDepartment(
        int $employeeId,
        int $jobDepartmentId
    ): ServiceResponse
    {
        $employee = $this->getById($employeeId);
        if ($employee->isSuccess()) {
            $employee->getData()->job_department_id = $jobDepartmentId;
            $employee->getData()->save();

            return new ServiceResponse(
                true,
                'Job department updated',
                200,
                $employee->getData()
            );
        } else {
            return $employee;
        }
    }

    public function generateSanctumToken(
        Employee $employee
    )
    {
        $token = $employee->createToken('employeeApiToken')->plainTextToken;

        $employee->api_token = $token;
        $employee->save();

        return $token;
    }

    public function generateOAuthToken(
        Employee $employee
    )
    {
        return Crypt::encrypt($employee->id);
    }

    /**
     * @param int|null $guid
     * @param int $companyId
     * @param int $roleId
     * @param int $jobDepartmentId
     * @param string $name
     * @param string $email
     * @param string|null $phone
     * @param string|null $identity
     * @param string|null $santralCode
     * @param string|null $password
     *
     * @return ServiceResponse
     */
    public function create(
        ?int    $guid,
        int     $companyId,
        int     $roleId,
        int     $jobDepartmentId,
        string  $name,
        string  $email,
        ?string $phone,
        ?string $identity,
        ?string $santralCode,
        ?string $password
    ): ServiceResponse
    {
        $employeesByJobDepartment = Employee::where('job_department_id', $jobDepartmentId)->get();
        $saturdayPermitOrderOnes = $employeesByJobDepartment->where('saturday_permit_order', 1)->all();
        $saturdayPermitOrderZeros = $employeesByJobDepartment->where('saturday_permit_order', 0)->all();

        $employee = new Employee();
        $employee->guid = $guid;
        $employee->company_id = $companyId;
        $employee->role_id = $roleId;
        $employee->job_department_id = $jobDepartmentId;
        $employee->name = $name;
        $employee->email = $email;
        $employee->phone = $phone;
        $employee->identity = $identity;
        $employee->santral_code = $santralCode;
        $employee->password = bcrypt($password);
        $employee->saturday_permit_order =
            $employeesByJobDepartment->where('saturday_permit_order', 1)->count() >=
            $employeesByJobDepartment->where('saturday_permit_order', 0)->count()
                ? 1 : 0;
        $employee->save();

        $token = "Bearer 70|70Yw6CA4Wi0UdSE1gR0TGC9rC91WLTZsRvdIWUnr";
        $endpoint = "http://inventory.ayssoft.com/api/user/employee/create";
        $client = new \GuzzleHttp\Client();
        $inventoryResponse = $client->request('POST', $endpoint, [
            'headers' => [
                'Authorization' => $token,
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'otsId' => $employee->id,
                'name' => $employee->name,
                'email' => $employee->email,
                'password' => $employee->password,
            ]
        ]);

        return new ServiceResponse(
            true,
            'Employee created',
            201,
            $employee
        );
    }

    /**
     * @param int $id
     * @param string $name
     * @param string $email
     * @param string|null $phone
     * @param string|null $identity
     * @param string|null $santralCode
     * @param int $saturdayPermitExemption
     */
    public function update(
        int     $id,
        string  $name,
        string  $email,
        ?string $phone,
        ?string $identity,
        ?string $santralCode,
        int     $saturdayPermitExemption
    ): ServiceResponse
    {
        $employee = $this->getById($id);
        if ($employee->isSuccess()) {
            $employee->getData()->name = $name;
            $employee->getData()->email = $email;
            $employee->getData()->phone = $phone;
            $employee->getData()->identity = $identity;
            $employee->getData()->santral_code = $santralCode;
            $employee->getData()->saturday_permit_exemption = $saturdayPermitExemption;
            $employee->getData()->save();

            return new ServiceResponse(
                true,
                'Employee updated',
                200,
                $employee->getData()
            );
        } else {
            return $employee;
        }
    }

    /**
     * @param int $employeeId
     * @param int $employeeGuid
     * @param string $date
     * @param int $leavingReasonId
     */
    public function leave(
        int    $employeeId,
        int    $employeeGuid,
        string $date,
        int    $leavingReasonId
    ): ServiceResponse
    {
        $employee = $this->getById($employeeId);
        if ($employee->isSuccess()) {
            $employee->getData()->leave = 1;
            $employee->getData()->password = '';
            $employee->getData()->save();

            $position = Position::where('employee_id', $employeeId)->where('end_date', null)->first();

            if ($position) {
                $position->end_date = $date;
                $position->leaving_reason_id = $leavingReasonId;
                $position->save();
            }

            $shiftGroups = $employee->getData()->shiftGroups()->get();

            foreach ($shiftGroups as $shiftGroup) {
                $shiftGroup->employees()->detach($employeeId);
            }

            $operationService = new OperationService;
            $setUserInterestResponse = $operationService->SetUserInterest($employeeGuid);

            $token = "Bearer 70|70Yw6CA4Wi0UdSE1gR0TGC9rC91WLTZsRvdIWUnr";
            $endpoint = "http://inventory.ayssoft.com/api/user/employee/deleteByOtsId";
            $client = new \GuzzleHttp\Client();
            $inventoryResponse = $client->request('DELETE', $endpoint, [
                'headers' => [
                    'Authorization' => $token,
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'otsId' => $employeeId,
                ]
            ]);

            if ($setUserInterestResponse->isSuccess()) {
                return new ServiceResponse(
                    true,
                    'Employee left',
                    200,
                    $employee->getData()
                );
            } else {
                return $setUserInterestResponse;
            }
        } else {
            return $employee;
        }
    }

    /**
     * @param int $employeeId
     */
    public function reActivate(
        int    $employeeId
    ): ServiceResponse
    {
        $employee = $this->getById($employeeId);
        if ($employee->isSuccess()) {
            $employee->getData()->leave = 0;
            $employee->getData()->suspend = 0;
            $employee->getData()->password = bcrypt('123456');
            $employee->getData()->save();

            $token = "Bearer 70|70Yw6CA4Wi0UdSE1gR0TGC9rC91WLTZsRvdIWUnr";
            $endpoint = "http://inventory.ayssoft.com/api/user/employee/reActivateByOtsId";
            $client = new \GuzzleHttp\Client();
            $inventoryResponse = $client->request('POST', $endpoint, [
                'headers' => [
                    'Authorization' => $token,
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'otsId' => $employeeId,
                ]
            ]);

            return new ServiceResponse(
                true,
                'Employee reactivated',
                200,
                $employee->getData()
            );
        } else {
            return $employee;
        }
    }

    /**
     * @param int $employeeId
     *
     * @return ServiceResponse
     */
    public function getMarketPayments(
        int $employeeId
    ): ServiceResponse
    {
        $employee = $this->getById($employeeId);
        if ($employee->isSuccess()) {
            return new ServiceResponse(
                true,
                'Employee market payments',
                200,
                $employee->getData()->marketPayments
            );
        } else {
            return $employee;
        }
    }

    /**
     * @param int $employeeId
     *
     * @return ServiceResponse
     */
    public function getPositions(
        int $employeeId
    ): ServiceResponse
    {
        $employee = $this->getById($employeeId);
        if ($employee->isSuccess()) {
            return new ServiceResponse(
                true,
                'Employee positions',
                200,
                $employee->getData()->positions()->with([
                    'company',
                    'branch',
                    'department',
                    'title'
                ])->orderBy('start_date', 'desc')->get()
            );
        } else {
            return $employee;
        }
    }

    /**
     * @param int $id
     *
     * @return ServiceResponse
     */
    public function delete(
        int $id
    ): ServiceResponse
    {
        $employee = $this->getById($id);
        if ($employee->isSuccess()) {
            return new ServiceResponse(
                true,
                'Employee deleted',
                200,
                $employee->getData()->delete()
            );
        } else {
            return $employee;
        }
    }

    /**
     * @param int $employeeId
     * @param string $password
     *
     * @return ServiceResponse
     */
    public function updatePassword(
        int    $employeeId,
        string $password
    ): ServiceResponse
    {
        $employee = $this->getById($employeeId);
        if ($employee->isSuccess()) {
            $employee->getData()->password = $password;
            $employee->getData()->save();

            return new ServiceResponse(
                true,
                'Employee password updated',
                200,
                $employee->getData()
            );
        } else {
            return $employee;
        }
    }
}
