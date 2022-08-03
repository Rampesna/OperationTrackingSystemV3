<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\IEmployeePersonalInformationService;
use App\Interfaces\Eloquent\IEmployeeService;
use App\Models\Eloquent\EmployeePersonalInformation;
use App\Services\ServiceResponse;

class EmployeePersonalInformationService implements IEmployeePersonalInformationService
{
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
     * @return ServiceResponse
     */
    public function getAll(): ServiceResponse
    {
        return new ServiceResponse(
            true,
            'All employee personal informations',
            200,
            EmployeePersonalInformation::all()
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
        $employeePersonalInformation = EmployeePersonalInformation::find($id);
        if ($employeePersonalInformation) {
            return new ServiceResponse(
                true,
                'Employee personal information',
                200,
                $employeePersonalInformation
            );
        } else {
            return new ServiceResponse(
                false,
                'Employee personal information not found',
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
        $employeePersonalInformation = $this->getById($id);
        if ($employeePersonalInformation->isSuccess()) {
            return new ServiceResponse(
                true,
                'Employee personal information deleted',
                200,
                $employeePersonalInformation->getData()->delete()
            );
        } else {
            return $employeePersonalInformation;
        }
    }

    /**
     * @param int $employeeId
     *
     * @return ServiceResponse
     */
    public function getByEmployeeId(
        int $employeeId
    ): ServiceResponse
    {
        $employeePersonalInformation = EmployeePersonalInformation::where('employee_id', $employeeId)->first();
        if ($employeePersonalInformation) {
            return new ServiceResponse(
                true,
                'Employee personal information',
                200,
                $employeePersonalInformation
            );
        } else {
            $employeeResponse = $this->employeeService->getById($employeeId);
            if ($employeeResponse->isSuccess()) {
                $employeePersonalInformation = $this->create($employeeId);
                if ($employeePersonalInformation->isSuccess()) {
                    return new ServiceResponse(
                        false,
                        'Employee personal information',
                        200,
                        $employeePersonalInformation->getData()
                    );
                } else {
                    return $employeePersonalInformation;
                }
            } else {
                return $employeeResponse;
            }
        }
    }

    /**
     * @param int $employeeId
     * @param string|null $birthDate
     * @param string|null $civilStatus
     * @param string|null $gender
     * @param string|null $nationality
     * @param string|null $bloodGroup
     * @param string|null $education
     * @param string|null $identity
     * @param string|null $wifeWorkingStatus
     * @param string|null $degreeOfObstacle
     * @param string|null $numberOfChild
     * @param string|null $educationStatus
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
     * @param string|null $emergencyPersonDegree
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
        string $emergencyPersonDegree = null,
        string $emergencyPersonPhoneNumber = null
    ): ServiceResponse
    {
        $employeePersonalInformation = new EmployeePersonalInformation;
        $employeePersonalInformation->employee_id = $employeeId;
        $employeePersonalInformation->birth_date = $birthDate;
        $employeePersonalInformation->civil_status = $civilStatus;
        $employeePersonalInformation->gender = $gender;
        $employeePersonalInformation->nationality = $nationality;
        $employeePersonalInformation->blood_group = $bloodGroup;
        $employeePersonalInformation->education = $education;
        $employeePersonalInformation->identity = $identity;
        $employeePersonalInformation->wife_working_status = $wifeWorkingStatus;
        $employeePersonalInformation->degree_of_obstacle = $degreeOfObstacle;
        $employeePersonalInformation->number_of_child = $numberOfChild;
        $employeePersonalInformation->education_status = $educationStatus;
        $employeePersonalInformation->last_completed_school = $lastCompletedSchool;
        $employeePersonalInformation->address = $address;
        $employeePersonalInformation->home_phone_number = $homePhoneNumber;
        $employeePersonalInformation->city = $city;
        $employeePersonalInformation->postal_code = $postalCode;
        $employeePersonalInformation->bank_name = $bankName;
        $employeePersonalInformation->bank_account_type = $bankAccountType;
        $employeePersonalInformation->account_number = $accountNumber;
        $employeePersonalInformation->iban = $iban;
        $employeePersonalInformation->emergency_person = $emergencyPerson;
        $employeePersonalInformation->emergency_person_degree = $emergencyPersonDegree;
        $employeePersonalInformation->emergency_person_phone_number = $emergencyPersonPhoneNumber;
        $employeePersonalInformation->save();

        return new ServiceResponse(
            true,
            'Employee personal information created',
            201,
            $employeePersonalInformation
        );
    }

    /**
     * @param int $id
     * @param string|null $birthDate
     * @param string|null $civilStatus
     * @param string|null $gender
     * @param string|null $nationality
     * @param string|null $bloodGroup
     * @param string|null $education
     * @param string|null $identity
     * @param string|null $wifeWorkingStatus
     * @param string|null $degreeOfObstacle
     * @param string|null $numberOfChild
     * @param string|null $educationStatus
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
     * @param string|null $emergencyPersonDegree
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
        string $emergencyPersonDegree = null,
        string $emergencyPersonPhoneNumber = null
    ): ServiceResponse
    {
        $employeePersonalInformation = $this->getById($id);
        if ($employeePersonalInformation->isSuccess()) {
            $employeePersonalInformation->getData()->birth_date = $birthDate;
            $employeePersonalInformation->getData()->civil_status = $civilStatus;
            $employeePersonalInformation->getData()->gender = $gender;
            $employeePersonalInformation->getData()->nationality = $nationality;
            $employeePersonalInformation->getData()->blood_group = $bloodGroup;
            $employeePersonalInformation->getData()->education = $education;
            $employeePersonalInformation->getData()->identity = $identity;
            $employeePersonalInformation->getData()->wife_working_status = $wifeWorkingStatus;
            $employeePersonalInformation->getData()->degree_of_obstacle = $degreeOfObstacle;
            $employeePersonalInformation->getData()->number_of_child = $numberOfChild;
            $employeePersonalInformation->getData()->education_status = $educationStatus;
            $employeePersonalInformation->getData()->last_completed_school = $lastCompletedSchool;
            $employeePersonalInformation->getData()->address = $address;
            $employeePersonalInformation->getData()->home_phone_number = $homePhoneNumber;
            $employeePersonalInformation->getData()->city = $city;
            $employeePersonalInformation->getData()->postal_code = $postalCode;
            $employeePersonalInformation->getData()->bank_name = $bankName;
            $employeePersonalInformation->getData()->bank_account_type = $bankAccountType;
            $employeePersonalInformation->getData()->account_number = $accountNumber;
            $employeePersonalInformation->getData()->iban = $iban;
            $employeePersonalInformation->getData()->emergency_person = $emergencyPerson;
            $employeePersonalInformation->getData()->emergency_person_degree = $emergencyPersonDegree;
            $employeePersonalInformation->getData()->emergency_person_phone_number = $emergencyPersonPhoneNumber;
            $employeePersonalInformation->getData()->save();

            return new ServiceResponse(
                true,
                'Employee personal information updated',
                200,
                $employeePersonalInformation->getData()
            );
        } else {
            return $employeePersonalInformation;
        }
    }
}
