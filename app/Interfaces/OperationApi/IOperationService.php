<?php


namespace App\Interfaces\OperationApi;

use App\Services\ServiceResponse;

interface IOperationService
{
    /**
     * @param string $startDate
     * @param string $endDate
     *
     * @return ServiceResponse
     */
    public function GetJobList(
        string $startDate,
        string $endDate
    );

    /**
     * @param string $startDate
     * @param string $endDate
     *
     * @return ServiceResponse
     */
    public function GetPersonBreakList(
        string $startDate,
        string $endDate
    );

    /**
     * @param int $companyId
     *
     * @return ServiceResponse
     */
    public function GetUserList(
        int $companyId
    );

    /**
     * @return ServiceResponse
     */
    public function GetLostList();

    /**
     * @return ServiceResponse
     */
    public function GetParametersList();

    /**
     * @return ServiceResponse
     */
    public function GetUyumConstantValuesList();

    /**
     * @return ServiceResponse
     */
    public function GetUyumCrmGroupNameList();

    /**
     * @return ServiceResponse
     */
    public function GetTeamsList();

    /**
     * @param array $list
     *
     * @return ServiceResponse
     */
    public function SetLostList(
        array $list
    );

    /**
     * @param int $dailyTotalBreakTime
     * @param int $dailyTotalFoodBreakTime
     * @param int $dailyTotalBioBreakTime
     * @param int $instantFoodBreakTime
     * @param int $instantBioBreakTime
     *
     * @return ServiceResponse
     */
    public function SetParameters(
        int $dailyTotalBreakTime,
        int $dailyTotalFoodBreakTime,
        int $dailyTotalBioBreakTime,
        int $instantFoodBreakTime,
        int $instantBioBreakTime
    );

    /**
     * @param int $id
     * @param int $code
     * @param string $name
     * @param int $typeCode
     * @param int $status
     *
     * @return ServiceResponse
     */
    public function SetUyumConstantValues(
        int    $id,
        int    $code,
        string $name,
        int    $typeCode,
        int    $status
    );

    /**
     * @param string $username
     * @param string $password
     * @param string $nameSurname
     * @param int $assignmentAuth
     * @param int $educationAuth
     * @param int $uyumCrmUsername
     * @param int $uyumCrmPassword
     * @param int $uyumCrmUserId
     * @param string $activeJobDescription
     * @param int $role
     * @param int $groupCode
     * @param int $teamCode
     * @param int $followerLeader
     * @param int $followerLeaderAssistant
     * @param int $callScanCode
     * @param string $email
     * @param string $internal
     *
     * @return ServiceResponse
     */
    public function SetUser(
        string $username,
        string $password,
        string $nameSurname,
        int    $assignmentAuth,
        int    $educationAuth,
        int    $uyumCrmUsername,
        int    $uyumCrmPassword,
        int    $uyumCrmUserId,
        string $activeJobDescription,
        int    $role,
        int    $groupCode,
        int    $teamCode,
        int    $followerLeader,
        int    $followerLeaderAssistant,
        int    $callScanCode,
        string $email,
        string $internal
    );

    /**
     * @param int $id
     * @param string $groupName
     * @param string $value
     *
     * @return ServiceResponse
     */
    public function SetUyumCrmGroupName(
        int    $id,
        string $groupName,
        string $value
    );

    /**
     * @param int $id
     * @param int $code
     * @param string $name
     * @param string $color
     * @param string $logo
     * @param string $description
     *
     * @return ServiceResponse
     */
    public function SetTeams(
        int    $id,
        int    $code,
        string $name,
        string $color,
        string $logo,
        string $description
    );

    /**
     * @param string $startDate
     * @param string $endDate
     *
     * @return ServiceResponse
     */
    public function GetDataScreening(
        string $startDate,
        string $endDate
    );

    /**
     * @param int $guid
     *
     * @return ServiceResponse
     */
    public function SetUserInterest(
        int $guid
    );

    /**
     * @return ServiceResponse
     */
    public function GetEmployeeTasks();

    /**
     * @return ServiceResponse
     */
    public function GetEmployeeWorkTasks();

    /**
     * @return ServiceResponse
     */
    public function GetEmployeeGroupTasks();

    /**
     * @param int $id
     * @param int $companyId
     * @param string $email
     * @param string $username
     * @param string $password
     * @param string $nameSurname
     * @param int $assignmentAuth
     * @param int $educationAuth
     * @param int $webCrmUserId
     * @param string $webCrmUsername
     * @param string $webCrmPassword
     * @param string $progressCrmUsername
     * @param string $progressCrmPassword
     * @param string $activeJobDescription
     * @param int $role
     * @param int $groupCode
     * @param int $teamCode
     * @param int $followerLeader
     * @param int $followerLeaderAssistant
     * @param string $callScanCode
     * @param string $santralCode
     * @param array $taskList {}
     * @param array $workTaskList {}
     *
     * @return ServiceResponse
     */
    public function SetEmployee(
        int    $id,
        int    $companyId,
        string $email,
        string $username,
        string $password,
        string $nameSurname,
        int    $assignmentAuth,
        int    $educationAuth,
        int    $webCrmUserId,
        string $webCrmUsername,
        string $webCrmPassword,
        string $progressCrmUsername,
        string $progressCrmPassword,
        string $activeJobDescription,
        int    $role,
        int    $groupCode,
        int    $teamCode,
        int    $followerLeader,
        int    $followerLeaderAssistant,
        string $callScanCode,
        string $santralCode,
        array  $taskList = [],
        array  $workTaskList = []
    );

    /**
     * @param int $guid
     *
     * @return ServiceResponse
     */
    public function GetEmployeeTasksEdit(
        int $guid
    );

    /**
     * @param int $guid
     *
     * @return ServiceResponse
     */
    public function GetEmployeeWorkTasksEdit(
        int $guid
    );

    /**
     * @param int $guid
     *
     * @return ServiceResponse
     */
    public function GetEmployeeGroupTasksEdit(
        int $guid
    );

    /**
     * @param int $guid
     * @param array|null $tasks
     *
     * @return ServiceResponse
     */
    public function SetEmployeeTasksInsert(
        int        $guid,
        array|null $tasks = []
    );

    /**
     * @param int $guid
     * @param array|null $workTasks
     *
     * @return ServiceResponse
     */
    public function SetEmployeeWorkTasksInsert(
        int        $guid,
        array|null $workTasks = []
    );

    /**
     * @param int $guid
     * @param array|null $groupTasks
     *
     * @return ServiceResponse
     */
    public function SetEmployeeGroupTasksInsert(
        int        $guid,
        array|null $groupTasks = []
    );

    /**
     * @param int $id
     *
     * @return ServiceResponse
     */
    public function SetEmployeeTasksDelete(
        int $id
    );

    /**
     * @param int $id
     *
     * @return ServiceResponse
     */
    public function SetEmployeeWorkTasksDelete(
        int $id
    );

    /**
     * @param int $id
     *
     * @return ServiceResponse
     */
    public function SetEmployeeGroupTasksDelete(
        int $id
    );

    /**
     * @param int $id
     *
     * @return ServiceResponse
     */
    public function GetEmployeeEdit(
        int $id
    );

    /**
     * @param array $staffParameters
     *
     * @return ServiceResponse
     */
    public function SetStaffParameter(
        array $staffParameters
    );

    /**
     * @param int $id
     *
     * @return ServiceResponse
     */
    public function GetStaffParameterEdit(
        int $id
    );

    /**
     * @param array $list
     *
     * @return ServiceResponse
     */
    public function SetStaffParameterUpdate(
        array $list
    );

    /**
     * @param int $id
     *
     * @return ServiceResponse
     */
    public function SetStaffParameterDelete(
        int $id
    );
}
