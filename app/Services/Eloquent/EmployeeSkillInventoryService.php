<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\IEmployeeSkillInventoryService;
use App\Models\Eloquent\EmployeeSkillInventory;
use App\Models\Eloquent\Employee;
use App\Services\ServiceResponse;

class EmployeeSkillInventoryService implements IEmployeeSkillInventoryService
{
    /**
     * @return ServiceResponse
     */
    public function getAll(): ServiceResponse
    {
        return new ServiceResponse(
            true,
            'All employee skill inventories',
            200,
            EmployeeSkillInventory::with([
                'employee',
            ])->get()
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
        $employeeSkillInventory = EmployeeSkillInventory::find($id);
        if ($employeeSkillInventory) {
            return new ServiceResponse(
                true,
                'Employee skill inventory',
                200,
                $employeeSkillInventory
            );
        } else {
            return new ServiceResponse(
                false,
                'Employee skill inventory not found',
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
        $employeeSkillInventory = $this->getById($id);
        if ($employeeSkillInventory->isSuccess()) {
            return new ServiceResponse(
                $employeeSkillInventory->getData()->delete(),
                'Employee skill inventory deleted',
                200,
                null
            );
        } else {
            return $employeeSkillInventory;
        }
    }

    /**
     * @param int $employeeId
     */
    public function checkIfExists(
        int $employeeId
    ): ServiceResponse
    {
        $employeeSkillInventory = EmployeeSkillInventory::where('employee_id', $employeeId)->first();
        if ($employeeSkillInventory) {
            return new ServiceResponse(
                true,
                'Employee skill inventory exists',
                200,
                $employeeSkillInventory
            );
        } else {
            return new ServiceResponse(
                false,
                'Employee skill inventory not found',
                404,
                null
            );
        }
    }

    /**
     * @param array $companyIds
     */
    public function getByCompanyIds(
        array $companyIds
    ): ServiceResponse
    {
        $employees = Employee::whereIn('company_id', $companyIds)->where('leave', 0)->get();
        $employeeSkillInventorys = EmployeeSkillInventory::with([
            'employee'
        ])->whereIn('employee_id', $employees->pluck('id')->toArray())->get();

        return new ServiceResponse(
            true,
            'Employee skill inventories',
            200,
            $employeeSkillInventorys
        );
    }

    /**
     * @param array $companyIds
     */
    public function getUnregisteredByCompanyIds(
        array $companyIds
    ): ServiceResponse
    {
        $unregisteredEmployees = collect();
        $employees = Employee::whereIn('company_id', $companyIds)->where('leave', 0)->get();
        $employeeSkillInventorys = EmployeeSkillInventory::all();

        foreach ($employees as $employee) {
            $employeeEmployeeSkillInventory = $employeeSkillInventorys->where('employee_id', $employee->id)->first();
            if (!$employeeEmployeeSkillInventory) {
                $unregisteredEmployees->push($employee);
            } else if ($employeeEmployeeSkillInventory->city == '' || $employeeEmployeeSkillInventory->city == null) {
                $unregisteredEmployees->push($employee);
            }
        }

        return new ServiceResponse(
            true,
            'Unregistered employees',
            200,
            $unregisteredEmployees
        );
    }

    /**
     * @param int $employeeId
     */
    public function getByEmployeeId(
        int $employeeId
    ): ServiceResponse
    {
        $employeeSkillInventory = EmployeeSkillInventory::where('employee_id', $employeeId)->first();
        if ($employeeSkillInventory) {
            return new ServiceResponse(
                true,
                'Employee skill inventory',
                200,
                $employeeSkillInventory
            );
        } else {
            $employeeSkillInventory = new EmployeeSkillInventory;
            $employeeSkillInventory->employee_id = $employeeId;
            $employeeSkillInventory->save();

            return new ServiceResponse(
                true,
                'Employee skill inventory',
                200,
                $employeeSkillInventory
            );
        }
    }

    /**
     * @param int $employeeId
     * @param string|null $centralCode
     * @param string|null $department
     * @param string|null $educationLevel
     * @param string|null $languages
     * @param string|null $certificates
     * @param string|null $jobStartDate
     * @param string|null $products
     * @param string|null $totalWorkExperience
     * @param string|null $age
     * @param string|null $gender
     * @param string|null $hobbies
     * @param string|null $oldWorkCompanies
     * @param string|null $oldWorkPositions
     * @param string|null $futureWorksTaken
     * @param string|null $notes
     *
     * @return ServiceResponse
     */
    public function create(
        int     $employeeId,
        ?string $centralCode,
        ?string $department,
        ?string $educationLevel,
        ?string $languages,
        ?string $certificates,
        ?string $jobStartDate,
        ?string $products,
        ?string $totalWorkExperience,
        ?string $age,
        ?string $gender,
        ?string $hobbies,
        ?string $oldWorkCompanies,
        ?string $oldWorkPositions,
        ?string $futureWorksTaken,
        ?string $notes
    ): ServiceResponse
    {
        $employeeSkillInventory = new EmployeeSkillInventory;
        $employeeSkillInventory->employee_id = $employeeId;
        $employeeSkillInventory->central_code = $centralCode;
        $employeeSkillInventory->department = $department;
        $employeeSkillInventory->education_level = $educationLevel;
        $employeeSkillInventory->languages = $languages;
        $employeeSkillInventory->certificates = $certificates;
        $employeeSkillInventory->job_start_date = $jobStartDate;
        $employeeSkillInventory->products = $products;
        $employeeSkillInventory->total_work_experience = $totalWorkExperience;
        $employeeSkillInventory->age = $age;
        $employeeSkillInventory->gender = $gender;
        $employeeSkillInventory->hobbies = $hobbies;
        $employeeSkillInventory->old_work_companies = $oldWorkCompanies;
        $employeeSkillInventory->old_work_positions = $oldWorkPositions;
        $employeeSkillInventory->future_works_taken = $futureWorksTaken;
        $employeeSkillInventory->notes = $notes;
        $employeeSkillInventory->save();

        return new ServiceResponse(
            true,
            'Employee skill inventory created',
            201,
            $employeeSkillInventory
        );
    }

    /**
     * @param int $employeeId
     * @param string|null $centralCode
     * @param string|null $department
     * @param string|null $educationLevel
     * @param string|null $languages
     * @param string|null $certificates
     * @param string|null $jobStartDate
     * @param string|null $products
     * @param string|null $totalWorkExperience
     * @param string|null $age
     * @param string|null $gender
     * @param string|null $hobbies
     * @param string|null $oldWorkCompanies
     * @param string|null $oldWorkPositions
     * @param string|null $futureWorksTaken
     * @param string|null $notes
     *
     * @return ServiceResponse
     */
    public function update(
        int     $employeeId,
        ?string $centralCode,
        ?string $department,
        ?string $educationLevel,
        ?string $languages,
        ?string $certificates,
        ?string $jobStartDate,
        ?string $products,
        ?string $totalWorkExperience,
        ?string $age,
        ?string $gender,
        ?string $hobbies,
        ?string $oldWorkCompanies,
        ?string $oldWorkPositions,
        ?string $futureWorksTaken,
        ?string $notes
    ): ServiceResponse
    {
        $employeeSkillInventory = EmployeeSkillInventory::where('employee_id', $employeeId)->first();
        if ($employeeSkillInventory) {
            $employeeSkillInventory->employee_id = $employeeId;
            $employeeSkillInventory->central_code = $centralCode;
            $employeeSkillInventory->department = $department;
            $employeeSkillInventory->education_level = $educationLevel;
            $employeeSkillInventory->languages = $languages;
            $employeeSkillInventory->certificates = $certificates;
            $employeeSkillInventory->job_start_date = $jobStartDate;
            $employeeSkillInventory->products = $products;
            $employeeSkillInventory->total_work_experience = $totalWorkExperience;
            $employeeSkillInventory->age = $age;
            $employeeSkillInventory->gender = $gender;
            $employeeSkillInventory->hobbies = $hobbies;
            $employeeSkillInventory->old_work_companies = $oldWorkCompanies;
            $employeeSkillInventory->old_work_positions = $oldWorkPositions;
            $employeeSkillInventory->future_works_taken = $futureWorksTaken;
            $employeeSkillInventory->notes = $notes;
            $employeeSkillInventory->save();

            return new ServiceResponse(
                true,
                'Employee skill inventory updated',
                200,
                $employeeSkillInventory
            );
        } else {
            return new ServiceResponse(
                false,
                'Employee skill inventory not found',
                404,
                null
            );
        }
    }
}
