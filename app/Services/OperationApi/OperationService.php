<?php


namespace App\Services\OperationApi;

use App\Interfaces\OperationApi\IOperationService;

class OperationService extends OperationApiService implements IOperationService
{
    public function GetJobList($startDate, $endDate)
    {
        $endpoint = "Operation/GetJobList";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $parameters = [
            'BaslangicTarihi' => $startDate,
            'BitisTarihi' => $endDate
        ];

        return $this->callApi($this->baseUrl . $endpoint, 'get', $headers, $parameters);
    }

    public function GetPersonBreakList($startDate, $endDate)
    {
        $endpoint = "Operation/GetPersonBreakList";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $parameters = [
            'BaslangicTarihi' => $startDate,
            'BitisTarihi' => $endDate
        ];

        return $this->callApi($this->baseUrl . $endpoint, 'get', $headers, $parameters);
    }

    public function GetUserList($companyId)
    {
        $endpoint = "Operation/GetUserList";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $params = [
            'CompanyId' => $companyId
        ];

        return $this->callApi($this->baseUrl . $endpoint . '?' . http_build_query($params), 'get', $headers, $params);
    }

    public function GetLostList()
    {
        $endpoint = "Operation/GetLostList";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];
        return $this->callApi($this->baseUrl . $endpoint, 'get', $headers);
    }

    public function GetParametersList()
    {
        $endpoint = "Operation/GetParametersList";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];
        return $this->callApi($this->baseUrl . $endpoint, 'get', $headers);
    }

    public function GetUyumConstantValuesList()
    {
        $endpoint = "Operation/GetUyumConstantValuesList";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];
        return $this->callApi($this->baseUrl . $endpoint, 'get', $headers);
    }

    public function GetUyumCrmGroupNameList()
    {
        $endpoint = "Operation/GetUyumCrmGroupNameList";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];
        return $this->callApi($this->baseUrl . $endpoint, 'get', $headers);
    }

    public function GetTeamsList()
    {
        $endpoint = "Operation/GetTeamsList";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];
        return $this->callApi($this->baseUrl . $endpoint, 'get', $headers);
    }

    public function SetLostList($list)
    {
        $endpoint = "Operation/SetLostList";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        return $this->callApi($this->baseUrl . $endpoint, 'post', $headers, $list);
    }

    public function SetParameters($dailyTotalBreakTime, $dailyTotalFoodBreakTime, $dailyTotalBioBreakTime, $instantFoodBreakTime, $instantBioBreakTime)
    {
        $endpoint = "Operation/SetParameters";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $parameters = [
            'body' => [
                'gunlukMolaSuresi' => $dailyTotalBreakTime,
                'gunlukYemekMolaSuresi' => $dailyTotalFoodBreakTime,
                'gunlukIhtiyacMolaSuresi' => $dailyTotalBioBreakTime,
                'anlikYemekSuresi' => $instantFoodBreakTime,
                'anlikIhtiyacMolaSuresi' => $instantBioBreakTime
            ]
        ];

        return $this->callApi($this->baseUrl . $endpoint, 'post', $headers, $parameters);
    }

    public function SetUyumConstantValues($id, $code, $name, $typeCode, $status)
    {
        $endpoint = "Operation/SetUyumConstantValues";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $parameters = [
            'body' => [
                'id' => $id,
                'kodu' => $code,
                'adi' => $name,
                'turKodu' => $typeCode,
                'durum' => $status
            ]
        ];

        return $this->callApi($this->baseUrl . $endpoint, 'post', $headers, $parameters);
    }

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
    )
    {
        $endpoint = "Operation/SetUser";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $parameters = [
            'kullaniciAdi' => $username,
            'kullaniciSifre' => $password,
            'kullaniciAdSoyad' => $nameSurname,
            'yetkiGorevlendirme' => $assignmentAuth,
            'yetkiEgitim' => $educationAuth,
            'uyumCrmUserName' => $uyumCrmUsername,
            'uyumCrmPassword' => $uyumCrmPassword,
            'uyumCrmUserId' => $uyumCrmUserId,
            'aktifGorevTanimi' => $activeJobDescription,
            'rol' => $role,
            'grupKodu' => $groupCode,
            'takimKodu' => $teamCode,
            'takipLideri' => $followerLeader,
            'takipLiderYardimcisi' => $followerLeaderAssistant,
            'cagriTaramaKodu' => $callScanCode,
            'kullaniciMail' => $email,
            'dahili' => $internal
        ];

        return $this->callApi($this->baseUrl . $endpoint, 'post', $headers, $parameters);
    }

    public function SetUyumCrmGroupName($id, $groupName, $value)
    {
        $endpoint = "Operation/SetUyumCrmGroupName";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $parameters = [
            'body' => [
                'id' => $id,
                'grupAdi' => $groupName,
                'deger' => $value
            ]
        ];

        return $this->callApi($this->baseUrl . $endpoint, 'post', $headers, $parameters);
    }

    public function SetTeams($id, $code, $name, $color, $logo, $description)
    {
        $endpoint = "Operation/SetTeams";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $parameters = [
            'body' => [
                'id' => $id,
                'takimKodu' => $code,
                'takimAdi' => $name,
                'takimRengi' => $color,
                'takimLogosu' => $logo,
                'takimAciklamasi' => $description
            ]
        ];
        return $this->callApi($this->baseUrl . $endpoint, 'post', $headers, $parameters);
    }

    public function GetDataScreening($startDate, $endDate)
    {
        $endpoint = "Operation/GetDataScreening";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $parameters = [
            'BaslangicTarihi' => $startDate,
            'BitisTarihi' => $endDate
        ];

        return $this->callApi($this->baseUrl . $endpoint, 'get', $headers, $parameters);
    }

    public function SetUserInterest($guid)
    {
        $endpoint = "Operation/SetUserInterest";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $parameters = [
            'UserId' => $guid
        ];

        return $this->callApi($this->baseUrl . $endpoint . '?' . http_build_query($parameters), 'post', $headers, $parameters);
    }

    public function GetEmployeeTasks()
    {
        $endpoint = "Operation/GetEmployeeTasks";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        return $this->callApi($this->baseUrl . $endpoint, 'get', $headers);
    }

    public function GetEmployeeWorkTasks()
    {
        $endpoint = "Operation/GetEmployeeWorkTasks";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        return $this->callApi($this->baseUrl . $endpoint, 'get', $headers);
    }

    public function GetEmployeeGroupTasks()
    {
        $endpoint = "Operation/GetEmployeeGroupTasks";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        return $this->callApi($this->baseUrl . $endpoint, 'get', $headers);
    }

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
    )
    {
        $endpoint = "Operation/SetEmployee";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $params = [
            'id' => $id,
            'ofisKodu' => $companyId,
            'kullaniciAdi' => $username,
            'kullaniciSifre' => $password,
            'kullaniciAdSoyad' => $nameSurname,
            'yetkiGorevlendirme' => $assignmentAuth,
            'yetkiEgitim' => $educationAuth,
            'uyumCrmUserName' => $uyumCrmUsername,
            'uyumCrmPassword' => $uyumCrmPassword,
            'uyumCrmUserId' => $uyumCrmUserId,
            'uyumProgressUserName' => $uyumProgressCrmUsername,
            'uyumProgressUserPassword' => $uyumProgressCrmPassword,
            'aktifGorevTanimi' => $activeJobDescription,
            'rol' => $role,
            'grupKodu' => $groupCode,
            'takimKodu' => $teamCode,
            'takipLideri' => $followerLeader,
            'takipLiderYardimcisi' => $followerLeaderAssistant,
            'cagriTaramaKodu' => $callScanCode,
            'kullaniciMail' => $email,
            'dahili' => $internal,
            'taskList' => $taskList,
            'workTaskList' => $workTaskList
        ];

//        return $params;

        return $this->callApi($this->baseUrl . $endpoint, 'post', $headers, $params);
    }

    public function GetEmployeeTasksEdit($id)
    {
        $endpoint = "Operation/GetEmployeeTasksEdit";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $params = [
            'Id' => $id
        ];

        return $this->callApi($this->baseUrl . $endpoint, 'get', $headers, $params);
    }

    public function GetEmployeeWorkTasksEdit($id)
    {
        $endpoint = "Operation/GetEmployeeWorkTasksEdit";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $params = [
            'Id' => $id
        ];

        return $this->callApi($this->baseUrl . $endpoint, 'get', $headers, $params);
    }

    public function GetEmployeeGroupTasksEdit($id)
    {
        $endpoint = "Operation/GetEmployeeGroupTasksEdit";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $params = [
            'Id' => $id
        ];

        return $this->callApi($this->baseUrl . $endpoint, 'get', $headers, $params);
    }

    public function SetEmployeeTasksInsert($list)
    {
        $endpoint = "Operation/SetEmployeeTasksInsert";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        return $this->callApi($this->baseUrl . $endpoint, 'post', $headers, $list);
    }

    public function SetEmployeeWorkTasksInsert($list)
    {
        $endpoint = "Operation/SetEmployeeWorkTasksInsert";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        return $this->callApi($this->baseUrl . $endpoint, 'post', $headers, $list);
    }

    public function SetEmployeeGroupTasksInsert($list)
    {
        $endpoint = "Operation/SetEmployeeGroupTasksInsert";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        return $this->callApi($this->baseUrl . $endpoint, 'post', $headers, $list);
    }

    public function SetEmployeeTasksDelete($id)
    {
        $endpoint = "Operation/SetEmployeeTasksDelete";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $params = [
            'Id' => $id
        ];

        return $this->callApi($this->baseUrl . $endpoint . '?' . http_build_query($params), 'post', $headers, $params);
    }

    public function SetEmployeeWorkTasksDelete($id)
    {
        $endpoint = "Operation/SetEmployeeWorkTasksDelete";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $params = [
            'Id' => $id
        ];

        return $this->callApi($this->baseUrl . $endpoint . '?' . http_build_query($params), 'post', $headers, $params);
    }

    public function SetEmployeeGroupTasksDelete($id)
    {
        $endpoint = "Operation/SetEmployeeGroupTasksDelete";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $params = [
            'Id' => $id
        ];

        return $this->callApi($this->baseUrl . $endpoint . '?' . http_build_query($params), 'post', $headers, $params);
    }

    public function GetEmployeeEdit($id)
    {
        $endpoint = "Operation/GetEmployeeEdit";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $params = [
            'Id' => $id
        ];

        return $this->callApi($this->baseUrl . $endpoint, 'get', $headers, $params);
    }

    public function SetStaffParameter($list)
    {
        $endpoint = "Operation/SetStaffParameter";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        return $this->callApi($this->baseUrl . $endpoint, 'post', $headers, $list);
    }

    public function GetStaffParameterEdit($id)
    {
        $endpoint = "Operation/GetStaffParameterEdit";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $params = [
            'VardiyaId' => $id
        ];

        return $this->callApi($this->baseUrl . $endpoint . '?' . http_build_query($params), 'get', $headers, $params);
    }

    public function SetStaffParameterUpdate($list)
    {
        $endpoint = "Operation/SetStaffParameterUpdate";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        return $this->callApi($this->baseUrl . $endpoint, 'post', $headers, $list);
    }

    public function SetStaffParameterDelete($id)
    {
        $endpoint = "Operation/SetStaffParameterDelete";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $params = [
            'VardiyaId' => $id
        ];

        return $this->callApi($this->baseUrl . $endpoint . '?' . http_build_query($params), 'post', $headers, $params);
    }
}
