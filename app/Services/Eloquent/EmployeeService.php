<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\IEmployeeService;
use App\Models\Eloquent\Employee;
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
     * @param int $id
     *
     * @return ServiceResponse
     */
    public function getById(
        int $id
    ): ServiceResponse
    {
        $employee = Employee::find($id);
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
            'Employee found',
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
            return new ServiceResponse(
                false,
                'Employee not found',
                404,
                null
            );
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
        ])->whereIn('company_id', $companyIds)
            ->where('leave', $leave);

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
            return new ServiceResponse(
                false,
                'Employee not found',
                404,
                null
            );
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
            return new ServiceResponse(
                false,
                'Employee not found',
                404,
                null
            );
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
            return new ServiceResponse(
                false,
                'Employee not found',
                404,
                null
            );
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
            return new ServiceResponse(
                false,
                'Employee not found',
                404,
                null
            );
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
            return new ServiceResponse(
                false,
                'Employee not found',
                404,
                null
            );
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
            return new ServiceResponse(
                false,
                'Employee not found',
                404,
                null
            );
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
            return new ServiceResponse(
                false,
                'Employee not found',
                404,
                null
            );
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
        $employee->save();

        return new ServiceResponse(
            true,
            'Employee created',
            201,
            $employee
        );
    }

    public function update(): ServiceResponse
    {
        return new ServiceResponse(
            false,
            'Method not implemented',
            501,
            null
        );
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
                $employee->data->delete()
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
}
