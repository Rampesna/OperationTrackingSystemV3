<?php

namespace App\Interfaces\Eloquent;

use App\Services\ServiceResponse;

interface IEmployeeSkillInventoryService extends IEloquentService
{
    /**
     * @param int $employeeId
     */
    public function checkIfExists(
        int $employeeId
    ): ServiceResponse;

    /**
     * @param array $companyIds
     */
    public function getByCompanyIds(
        array $companyIds
    ): ServiceResponse;

    /**
     * @param array $companyIds
     */
    public function getUnregisteredByCompanyIds(
        array $companyIds
    ): ServiceResponse;

    /**
     * @param int $employeeId
     */
    public function getByEmployeeId(
        int $employeeId
    ): ServiceResponse;

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
    ): ServiceResponse;

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
    ): ServiceResponse;
}
