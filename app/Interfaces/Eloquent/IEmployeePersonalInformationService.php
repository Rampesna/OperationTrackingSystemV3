<?php

namespace App\Interfaces\Eloquent;

use App\Services\ServiceResponse;

interface IEmployeePersonalInformationService extends IEloquentService
{
    /**
     * @param int $employeeId
     *
     * @return ServiceResponse
     */
    public function getByEmployeeId(
        int $employeeId
    ): ServiceResponse;

    /**
     * @param int $employeeId
     * @param string|null $birthDate
     * @param int|null $civilStatus
     * @param int|null $gender
     * @param string|null $nationality
     * @param string|null $bloodGroup
     * @param string|null $education
     * @param string|null $identity
     * @param int|null $wifeWorkingStatus
     * @param int|null $degreeOfObstacle
     * @param int|null $numberOfChild
     * @param int|null $educationStatus
     * @param string|null $lastCompletedSchool
     * @param string|null $address
     * @param string|null $homePhoneNumber
     * @param string|null $city
     * @param string|null $postalCode
     * @param string|null $bankName
     * @param string|null $bankAccountType
     * @param string|null $accountNumber
     * @param string|null $iban
     * @param string|null $emergencyPerson
     * @param string|null $emergencyPerson_degree
     * @param string|null $emergencyPersonPhoneNumber
     *
     * @return ServiceResponse
     */
    public function create(
        int    $employeeId,
        string $birthDate = null,
        int    $civilStatus = null,
        int    $gender = null,
        string $nationality = null,
        string $bloodGroup = null,
        string $education = null,
        string $identity = null,
        int    $wifeWorkingStatus = null,
        int    $degreeOfObstacle = null,
        int    $numberOfChild = null,
        int    $educationStatus = null,
        string $lastCompletedSchool = null,
        string $address = null,
        string $homePhoneNumber = null,
        string $city = null,
        string $postalCode = null,
        string $bankName = null,
        string $bankAccountType = null,
        string $accountNumber = null,
        string $iban = null,
        string $emergencyPerson = null,
        string $emergencyPerson_degree = null,
        string $emergencyPersonPhoneNumber = null
    ): ServiceResponse;

    /**
     * @param int $id
     * @param string|null $birthDate
     * @param int|null $civilStatus
     * @param int|null $gender
     * @param string|null $nationality
     * @param string|null $bloodGroup
     * @param string|null $education
     * @param string|null $identity
     * @param int|null $wifeWorkingStatus
     * @param int|null $degreeOfObstacle
     * @param int|null $numberOfChild
     * @param int|null $educationStatus
     * @param string|null $lastCompletedSchool
     * @param string|null $address
     * @param string|null $homePhoneNumber
     * @param string|null $city
     * @param string|null $postalCode
     * @param string|null $bankName
     * @param string|null $bankAccountType
     * @param string|null $accountNumber
     * @param string|null $iban
     * @param string|null $emergencyPerson
     * @param string|null $emergencyPerson_degree
     * @param string|null $emergencyPersonPhoneNumber
     *
     * @return ServiceResponse
     */
    public function update(
        int    $id,
        string $birthDate = null,
        int    $civilStatus = null,
        int    $gender = null,
        string $nationality = null,
        string $bloodGroup = null,
        string $education = null,
        string $identity = null,
        int    $wifeWorkingStatus = null,
        int    $degreeOfObstacle = null,
        int    $numberOfChild = null,
        int    $educationStatus = null,
        string $lastCompletedSchool = null,
        string $address = null,
        string $homePhoneNumber = null,
        string $city = null,
        string $postalCode = null,
        string $bankName = null,
        string $bankAccountType = null,
        string $accountNumber = null,
        string $iban = null,
        string $emergencyPerson = null,
        string $emergencyPerson_degree = null,
        string $emergencyPersonPhoneNumber = null
    ): ServiceResponse;
}
