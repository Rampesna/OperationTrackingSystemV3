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

    /**
     * @param int $id
     */
    public function getById(
        int $id
    )
    {
        return Employee::find($id);
    }

    /**
     * @param string $email
     */
    public function getByEmail(
        string $email
    )
    {
        return Employee::where('email', $email)->first();
    }

    /**
     * @param int $pageIndex
     * @param int $pageSize
     * @param array $companyIds
     * @param int $leave
     */
    public function getByCompanies(
        int   $pageIndex = 0,
        int   $pageSize = 10,
        array $companyIds = [],
        int   $leave = 0
    )
    {
        return Employee::with([
            'company',
            'jobDepartments',
        ])->whereIn('company_id', $companyIds)
            ->where('leave', $leave)
            ->skip($pageIndex * $pageSize)
            ->take($pageSize)
            ->get();
    }

    /**
     * @param int $employeeId
     */
    public function getEmployeeQueues(
        int $employeeId
    )
    {
        return $this->getById($employeeId)->queues;
    }

    /**
     * @param int $employeeId
     * @param array $queueIds
     */
    public function setEmployeeQueues(
        int   $employeeId,
        array $queueIds
    )
    {
        $employee = $this->getById($employeeId);
        $employee->queues()->sync($queueIds);
    }

    /**
     * @param int $employeeId
     */
    public function getEmployeeCompetences(
        int $employeeId
    )
    {
        return $this->getById($employeeId)->competences;
    }

    /**
     * @param int $employeeId
     * @param array $competenceIds
     */
    public function setEmployeeCompetences(
        int   $employeeId,
        array $competenceIds
    )
    {
        $employee = $this->getById($employeeId);
        $employee->competences()->sync($competenceIds);
    }

    /**
     * @param int $employeeId
     */
    public function getEmployeePriorities(
        int $employeeId
    )
    {
        return $this->getById($employeeId)->priorities;
    }

    /**
     * @param int $employeeId
     * @param array $priorityIds
     */
    public function setEmployeePriorities(
        int   $employeeId,
        array $priorityIds
    )
    {
        $employee = $this->getById($employeeId);
        $employee->priorities()->sync($priorityIds);
    }

    /**
     * @param Employee $employee
     */
    public function generateSanctumToken(
        Employee $employee
    )
    {
        return $employee->createToken('employeeApiToken')->plainTextToken;
    }

    /**
     * @param Employee $employee
     */
    public function generateOAuthToken(
        Employee $employee
    )
    {
        return Crypt::encrypt($employee->id);
    }

    public function create(
        int    $roleId,
        string $name,
        string $email,
        string $phoneNumber = null,
        string $identificationNumber = null,
        int    $defaultCompanyId = null,
        string $password
    )
    {
        $employee = new Employee();
        $employee->role_id = $roleId;
        $employee->name = $name;
        $employee->email = $email;
        $employee->phone_number = $phoneNumber;
        $employee->identification_number = $identificationNumber;
        $employee->default_company_id = $defaultCompanyId;
        $employee->password = $password;
        $employee->save();

        return $employee;
    }

    public function update()
    {

    }

    /**
     * @param int $id
     */
    public function delete(
        int $id
    )
    {
        return $this->getById($id)->delete();
    }
}
