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

        return $this->callApi($this->baseUrl . $endpoint . '?' . http_build_query($params), 'get', $headers, $params)['response'];
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

        return $this->callApi($this->baseUrl . $endpoint, 'get', $headers, $parameters)->getBody();
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

        return $this->callApi($this->baseUrl . $endpoint, 'get', $headers)['response'];
    }

    public function GetEmployeeWorkTasks()
    {
        $endpoint = "Operation/GetEmployeeWorkTasks";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        return $this->callApi($this->baseUrl . $endpoint, 'get', $headers)['response'];
    }

    public function GetEmployeeGroupTasks()
    {
        $endpoint = "Operation/GetEmployeeGroupTasks";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        return $this->callApi($this->baseUrl . $endpoint, 'get', $headers)['response'];
    }

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
            'uyumCrmUserId' => $webCrmUserId,
            'uyumCrmUserName' => $webCrmUsername,
            'uyumCrmPassword' => $webCrmPassword,
            'uyumProgressUserName' => $progressCrmUsername,
            'uyumProgressUserPassword' => $progressCrmPassword,
            'aktifGorevTanimi' => $activeJobDescription,
            'rol' => $role,
            'grupKodu' => $groupCode,
            'takimKodu' => $teamCode,
            'takipLideri' => $followerLeader,
            'takipLiderYardimcisi' => $followerLeaderAssistant,
            'cagriTaramaKodu' => $callScanCode,
            'kullaniciMail' => $email,
            'dahili' => $santralCode,
            'taskList' => $taskList,
            'workTaskList' => $workTaskList
        ];

        return $this->callApi($this->baseUrl . $endpoint, 'post', $headers, $params);
    }

    public function GetEmployeeTasksEdit($guid)
    {
        $endpoint = "Operation/GetEmployeeTasksEdit";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $params = [
            'Id' => $guid
        ];

        return $this->callApi($this->baseUrl . $endpoint, 'get', $headers, $params)['response'];
    }

    /**
     * @param int $guid
     */
    public function GetEmployeeWorkTasksEdit(
        int $guid
    )
    {
        $endpoint = "Operation/GetEmployeeWorkTasksEdit";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $params = [
            'Id' => $guid
        ];

        return $this->callApi($this->baseUrl . $endpoint, 'get', $headers, $params)['response'];
    }

    /**
     * @param int $guid
     */
    public function GetEmployeeGroupTasksEdit(
        int $guid
    )
    {
        $endpoint = "Operation/GetEmployeeGroupTasksEdit";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $params = [
            'Id' => $guid
        ];

        return $this->callApi($this->baseUrl . $endpoint, 'get', $headers, $params)['response'];
    }

    public function SetEmployeeTasksInsert(
        int        $guid,
        array|null $tasks = []
    )
    {
        $endpoint = "Operation/SetEmployeeTasksInsert";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $employeeTasks = $this->GetEmployeeTasksEdit($guid);
        foreach ($employeeTasks ?? [] as $employeeTask) {
            $this->SetEmployeeTasksDelete($employeeTask['id']);
        }

        $list = [];
        if ($tasks != null) {
            foreach ($tasks as $task) {
                $list[] = [
                    'kullanicilarId' => $guid,
                    'gorevKodu' => $task
                ];
            }
        }

        return $this->callApi($this->baseUrl . $endpoint, 'post', $headers, $list)['response'];
    }

    /**
     * @param int $guid
     * @param array $workTasks
     */
    public function SetEmployeeWorkTasksInsert(
        int        $guid,
        array|null $workTasks = []
    )
    {
        $endpoint = "Operation/SetEmployeeWorkTasksInsert";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $employeeWorkTasks = $this->GetEmployeeWorkTasksEdit($guid);
        foreach ($employeeWorkTasks ?? [] as $employeeWorkTask) {
            $this->SetEmployeeWorkTasksDelete($employeeWorkTask['id']);
        }

        $list = [];
        if ($workTasks != null) {
            foreach ($workTasks as $workTask) {
                $list[] = [
                    'kullanicilarId' => $guid,
                    'gorevKodu' => $workTask
                ];
            }
        }

        return $this->callApi($this->baseUrl . $endpoint, 'post', $headers, $list)['response'];
    }

    /**
     * @param int $guid
     * @param array $groupTasks
     */
    public function SetEmployeeGroupTasksInsert(
        int        $guid,
        array|null $groupTasks = []
    )
    {
        $endpoint = "Operation/SetEmployeeGroupTasksInsert";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $employeeGroupTasks = $this->GetEmployeeGroupTasksEdit($guid);
        foreach ($employeeGroupTasks ?? [] as $employeeGroupTask) {
            $this->SetEmployeeGroupTasksDelete($employeeGroupTask['id']);
        }

        $list = [];
        if ($groupTasks != null) {
            foreach ($groupTasks as $groupTask) {
                $list[] = [
                    'kullanicilarId' => $guid,
                    'gorevKodu' => $groupTask
                ];
            }
        }

        return $this->callApi($this->baseUrl . $endpoint, 'post', $headers, $list)['response'];
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

    /**
     * @param array $staffParameters
     */
    public function SetStaffParameter(
        array $staffParameters
    )
    {
        $endpoint = "Operation/SetStaffParameter";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        return $this->callApi($this->baseUrl . $endpoint, 'post', $headers, $staffParameters)['response'];
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
