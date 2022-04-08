<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\IEmployeeService;
use App\Models\Eloquent\Employee;
use App\Traits\Response;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class EmployeeService implements IEmployeeService
{
    use Response;

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
    public function index(
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
     * @param string $email
     * @param string $password
     */
    public function login(
        string $email,
        string $password
    )
    {
        if (!$employee = $this->getByEmail($email)) {
            return $this->error('Employee not found', 404);
        }

        if (!Hash::check($password, $employee->password)) {
            return $this->error('Password is incorrect', 401);
        }

        return $this->success('Employee logged in successfully', [
            'token' => $this->generateSanctumToken($employee),
            'oAuth' => $this->generateOAuthToken($employee)
        ]);
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
