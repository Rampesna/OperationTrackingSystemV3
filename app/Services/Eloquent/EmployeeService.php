<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\IEmployeeService;
use App\Models\Eloquent\Employee;
use Illuminate\Support\Facades\Crypt;

class EmployeeService implements IEmployeeService
{
    public function getAll()
    {
        return Employee::all();
    }

    public function getById(
        int $id
    )
    {
        return Employee::find($id);
    }

    public function getByIds(
        array $ids
    )
    {
        return Employee::whereIn('id', $ids)->get();
    }

    public function getByEmail(
        string $email
    )
    {
        return Employee::where('email', $email)->first();
    }

    public function swapTheme(
        int $employeeId,
        int $theme
    )
    {
        $employee = $this->getById($employeeId);

        if (!$employee) {
            return false;
        }

        $employee->theme = $theme;
        $employee->save();

        return $employee;
    }

    public function getByCompanies(
        int         $pageIndex = 0,
        int         $pageSize = 10,
        array       $companyIds = [],
        int         $leave = 0,
        string|null $keyword = null,
        array|null  $jobDepartmentIds = []
    )
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

        return $employees->orderBy('name')->skip($pageIndex * $pageSize)
            ->take($pageSize)
            ->get();
    }

    public function getEmployeeQueues(
        int $employeeId
    )
    {
        return $this->getById($employeeId)->queues;
    }

    public function setEmployeeQueues(
        int   $employeeId,
        array $queueIds
    )
    {
        $employee = $this->getById($employeeId);
        $employee->queues()->sync($queueIds);
    }

    public function getEmployeeCompetences(
        int $employeeId
    )
    {
        return $this->getById($employeeId)->competences;
    }

    public function setEmployeeCompetences(
        int   $employeeId,
        array $competenceIds
    )
    {
        $employee = $this->getById($employeeId);
        $employee->competences()->sync($competenceIds);
    }

    public function getEmployeeShiftGroups(
        int $employeeId
    )
    {
        return $this->getById($employeeId)->shiftGroups;
    }

    public function setEmployeeShiftGroups(
        int   $employeeId,
        array $shiftGroupIds
    )
    {
        $employee = $this->getById($employeeId);
        $employee->shiftGroups()->sync($shiftGroupIds);
    }

    public function updateJobDepartment(
        int $employeeId,
        int $jobDepartmentId
    )
    {
        $employee = $this->getById($employeeId);
        $employee->job_department_id = $jobDepartmentId;
        return $employee->save();
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
    )
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

        return $employee;
    }

    public function update()
    {

    }

    public function getMarketPayments(
        int $employeeId
    )
    {
        return $this->getById($employeeId)->marketPayments;
    }

    public function delete(
        int $id
    )
    {
        return $this->getById($id)->delete();
    }
}
