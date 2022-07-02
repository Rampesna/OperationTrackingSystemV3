<?php


namespace App\Interfaces\OperationApi;

interface IOperationService
{
    public function GetJobList(
        $startDate,
        $endDate
    );

    public function GetPersonBreakList(
        $startDate,
        $endDate
    );

    public function GetUserList(
        $companyId
    );

    public function GetLostList();

    public function GetParametersList();

    public function GetUyumConstantValuesList();

    public function GetUyumCrmGroupNameList();

    public function GetTeamsList();

    public function SetLostList(
        $list
    );

    public function SetParameters(
        $dailyTotalBreakTime,
        $dailyTotalFoodBreakTime,
        $dailyTotalBioBreakTime,
        $instantFoodBreakTime,
        $instantBioBreakTime
    );

    public function SetUyumConstantValues(
        $id,
        $code,
        $name,
        $typeCode,
        $status
    );

    public function SetUser(
        $username,
        $password,
        $nameSurname,
        $assignmentAuth,
        $educationAuth,
        $uyumCrmUsername,
        $uyumCrmPassword,
        $uyumCrmUserId,
        $activeJobDescription,
        $role,
        $groupCode,
        $teamCode,
        $followerLeader,
        $followerLeaderAssistant,
        $callScanCode,
        $email,
        $internal
    );

    public function SetUyumCrmGroupName(
        $id,
        $groupName,
        $value
    );

    public function SetTeams(
        $id,
        $code,
        $name,
        $color,
        $logo,
        $description
    );

    public function GetDataScreening(
        $startDate,
        $endDate
    );

    public function SetUserInterest(
        $guid
    );

    public function GetEmployeeTasks();

    public function GetEmployeeWorkTasks();

    public function GetEmployeeGroupTasks();

    public function SetEmployee(
        $id,
        $companyId,
        $email,
        $username,
        $password,
        $nameSurname,
        $assignmentAuth,
        $educationAuth,
        $webCrmUserId,
        $webCrmUsername,
        $webCrmPassword,
        $progressCrmUsername,
        $progressCrmPassword,
        $activeJobDescription,
        $role,
        $groupCode,
        $teamCode,
        $followerLeader,
        $followerLeaderAssistant,
        $callScanCode,
        $santralCode,
        $taskList = [],
        $workTaskList = []
    );

    public function GetEmployeeTasksEdit(
        $guid
    );

    /**
     * @param int $guid
     */
    public function GetEmployeeWorkTasksEdit(
        int $guid
    );

    /**
     * @param int $guid
     */
    public function GetEmployeeGroupTasksEdit(
        int $guid
    );

    public function SetEmployeeTasksInsert(
        int        $guid,
        array|null $tasks = []
    );

    /**
     * @param int $guid
     * @param array $workTasks
     */
    public function SetEmployeeWorkTasksInsert(
        int        $guid,
        array|null $workTasks = []
    );

    /**
     * @param int $guid
     * @param array $groupTasks
     */
    public function SetEmployeeGroupTasksInsert(
        int        $guid,
        array|null $groupTasks = []
    );

    public function SetEmployeeTasksDelete(
        $id
    );

    public function SetEmployeeWorkTasksDelete(
        $id
    );

    public function SetEmployeeGroupTasksDelete(
        $id
    );

    public function GetEmployeeEdit(
        $id
    );

    /**
     * @param array $staffParameters
     */
    public function SetStaffParameter(
        array $staffParameters
    );

    public function GetStaffParameterEdit(
        $id
    );

    public function SetStaffParameterUpdate(
        $list
    );

    public function SetStaffParameterDelete(
        $id
    );
}
