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
        $companyId,
        $username,
        $password,
        $nameSurname,
        $assignmentAuth,
        $educationAuth,
        $uyumCrmUsername,
        $uyumCrmPassword,
        $uyumCrmUserId,
        $uyumProgressCrmUsername,
        $uyumProgressCrmPassword,
        $activeJobDescription,
        $role,
        $groupCode,
        $teamCode,
        $followerLeader,
        $followerLeaderAssistant,
        $callScanCode,
        $email,
        $internal,
        $taskList = [],
        $workTaskList = [],
        $id = null
    );

    public function GetEmployeeTasksEdit(
        $id
    );

    public function GetEmployeeWorkTasksEdit(
        $id
    );

    public function GetEmployeeGroupTasksEdit(
        $id
    );

    public function SetEmployeeTasksInsert(
        $list
    );

    public function SetEmployeeWorkTasksInsert(
        $list
    );

    public function SetEmployeeGroupTasksInsert(
        $list
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

    public function SetStaffParameter(
        $list
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
