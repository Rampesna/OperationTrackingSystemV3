<?php


namespace App\Services\OperationApi;

use App\Interfaces\OperationApi\IOperationService;
use App\Models\Eloquent\Shift;
use App\Models\Eloquent\ShiftGroup;
use App\Services\ServiceResponse;

class OperationService extends OperationApiService implements IOperationService
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
    ): ServiceResponse
    {
        $endpoint = "Operation/GetJobList";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $parameters = [
            'BaslangicTarihi' => $startDate,
            'BitisTarihi' => $endDate
        ];

        return new ServiceResponse(
            true,
            'Get job list',
            200,
            $this->callApi($this->baseUrl . $endpoint, 'get', $headers, $parameters)['response']
        );
    }

    /**
     * @param string $startDate
     * @param string $endDate
     *
     * @return ServiceResponse
     */
    public function GetPersonBreakList(
        string $startDate,
        string $endDate
    ): ServiceResponse
    {
        $endpoint = "Operation/GetPersonBreakList";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $parameters = [
            'BaslangicTarihi' => $startDate,
            'BitisTarihi' => $endDate
        ];

        return new ServiceResponse(
            true,
            'Get person break list',
            200,
            $this->callApi($this->baseUrl . $endpoint, 'get', $headers, $parameters)['response']
        );
    }

    /**
     * @param int $companyId
     *
     * @return ServiceResponse
     */
    public function GetUserList(
        int $companyId
    ): ServiceResponse
    {
        $endpoint = "Operation/GetUserList";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $params = [
            'CompanyId' => $companyId
        ];

        return new ServiceResponse(
            true,
            'Get user list',
            200,
            $this->callApi($this->baseUrl . $endpoint . '?' . http_build_query($params), 'get', $headers, $params)['response']
        );
    }

    /**
     * @return ServiceResponse
     */
    public function GetLostList(): ServiceResponse
    {
        $endpoint = "Operation/GetLostList";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];
        return new ServiceResponse(
            true,
            'Get lost list',
            200,
            $this->callApi($this->baseUrl . $endpoint, 'get', $headers)['response']
        );
    }

    /**
     * @return ServiceResponse
     */
    public function GetParametersList(): ServiceResponse
    {
        $endpoint = "Operation/GetParametersList";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];
        return new ServiceResponse(
            true,
            'Get parameters list',
            200,
            $this->callApi($this->baseUrl . $endpoint, 'get', $headers)['response']
        );
    }

    /**
     * @return ServiceResponse
     */
    public function GetUyumConstantValuesList(): ServiceResponse
    {
        $endpoint = "Operation/GetUyumConstantValuesList";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];
        return new ServiceResponse(
            true,
            'Get uyum constant values list',
            200,
            $this->callApi($this->baseUrl . $endpoint, 'get', $headers)['response']
        );
    }

    /**
     * @return ServiceResponse
     */
    public function GetUyumCrmGroupNameList(): ServiceResponse
    {
        $endpoint = "Operation/GetUyumCrmGroupNameList";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];
        return new ServiceResponse(
            true,
            'Get uyum crm group name list',
            200,
            $this->callApi($this->baseUrl . $endpoint, 'get', $headers)['response']
        );
    }

    /**
     * @return ServiceResponse
     */
    public function GetTeamsList(): ServiceResponse
    {
        $endpoint = "Operation/GetTeamsList";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];
        return new ServiceResponse(
            true,
            'Get teams list',
            200,
            $this->callApi($this->baseUrl . $endpoint, 'get', $headers)['response']
        );
    }

    /**
     * @param array $list
     *
     * @return ServiceResponse
     */
    public function SetLostList(
        array $list
    ): ServiceResponse
    {
        $endpoint = "Operation/SetLostList";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        return new ServiceResponse(
            true,
            'Set lost list',
            200,
            $this->callApi($this->baseUrl . $endpoint, 'post', $headers, $list)['response']
        );
    }

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
    ): ServiceResponse
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

        return new ServiceResponse(
            true,
            'Set parameters',
            200,
            $this->callApi($this->baseUrl . $endpoint, 'post', $headers, $parameters)['response']
        );
    }

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
    ): ServiceResponse
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

        return new ServiceResponse(
            true,
            'Set uyum constant values',
            200,
            $this->callApi($this->baseUrl . $endpoint, 'post', $headers, $parameters)['response']
        );
    }

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
    ): ServiceResponse
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

        return new ServiceResponse(
            true,
            'Set user',
            200,
            $this->callApi($this->baseUrl . $endpoint, 'post', $headers, $parameters)['response']
        );
    }

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
    ): ServiceResponse
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

        return new ServiceResponse(
            true,
            'Set uyum crm group name',
            200,
            $this->callApi($this->baseUrl . $endpoint, 'post', $headers, $parameters)['response']
        );
    }

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
    ): ServiceResponse
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
        return new ServiceResponse(
            true,
            'Set teams',
            200,
            $this->callApi($this->baseUrl . $endpoint, 'post', $headers, $parameters)['response']
        );
    }

    /**
     * @param string $startDate
     * @param string $endDate
     *
     * @return ServiceResponse
     */
    public function GetDataScreening(
        string $startDate,
        string $endDate
    ): ServiceResponse
    {
        $endpoint = "Operation/GetDataScreening";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $parameters = [
            'BaslangicTarihi' => $startDate,
            'BitisTarihi' => $endDate
        ];

        return new ServiceResponse(
            true,
            'Get data screening',
            200,
            $this->callApi($this->baseUrl . $endpoint, 'get', $headers, $parameters)['response']
        );
    }

    /**
     * @param int $guid
     *
     * @return ServiceResponse
     */
    public function SetUserInterest(
        int $guid
    ): ServiceResponse
    {
        $endpoint = "Operation/SetUserInterest";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $parameters = [
            'UserId' => $guid
        ];

        return new ServiceResponse(
            true,
            'Set user interest',
            200,
            $this->callApi($this->baseUrl . $endpoint . '?' . http_build_query($parameters), 'post', $headers, $parameters)['response']
        );
    }

    /**
     * @return ServiceResponse
     */
    public function GetEmployeeTasks(): ServiceResponse
    {
        $endpoint = "Operation/GetEmployeeTasks";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        return new ServiceResponse(
            true,
            'Get employee tasks',
            200,
            $this->callApi($this->baseUrl . $endpoint, 'get', $headers)['response']
        );
    }

    /**
     * @return ServiceResponse
     */
    public function GetEmployeeWorkTasks(): ServiceResponse
    {
        $endpoint = "Operation/GetEmployeeWorkTasks";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        return new ServiceResponse(
            true,
            'Get employee work tasks',
            200,
            $this->callApi($this->baseUrl . $endpoint, 'get', $headers)['response']
        );
    }

    /**
     * @return ServiceResponse
     */
    public function GetEmployeeGroupTasks(): ServiceResponse
    {
        $endpoint = "Operation/GetEmployeeGroupTasks";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        return new ServiceResponse(
            true,
            'Get employee group tasks',
            200,
            $this->callApi($this->baseUrl . $endpoint, 'get', $headers)['response']
        );
    }

    /**
     * @param int|null $id
     * @param int $companyId
     * @param string $email
     * @param string|null $username
     * @param string|null $password
     * @param string $nameSurname
     * @param int|null $assignmentAuth
     * @param int|null $educationAuth
     * @param int $webCrmUserId
     * @param string $webCrmUsername
     * @param string $webCrmPassword
     * @param string $progressCrmUsername
     * @param string $progressCrmPassword
     * @param string|null $activeJobDescription
     * @param int $role
     * @param int|null $groupCode
     * @param int $teamCode
     * @param int|null $followerLeader
     * @param int|null $followerLeaderAssistant
     * @param string|null $callScanCode
     * @param string $santralCode
     * @param array $taskList {}
     * @param array $workTaskList {}
     * @param string|null $uyumSatisApiCrmUserName
     * @param string|null $uyumSatisApiCrmUserPassword
     *
     * @return ServiceResponse
     */
    public function SetEmployee(
        ?int    $id,
        int     $companyId,
        string  $email,
        ?string $username,
        ?string $password,
        string  $nameSurname,
        ?int    $assignmentAuth,
        ?int    $educationAuth,
        int     $webCrmUserId,
        string  $webCrmUsername,
        string  $webCrmPassword,
        string  $progressCrmUsername,
        string  $progressCrmPassword,
        string  $marketingCrmUsername,
        string  $marketingCrmPassword,
        ?string $activeJobDescription,
        int     $uyumCrmCompanyId,
        int     $uyumCrmBranchId,
        string  $uyumCrmBranchCode,
        string  $activeYear,
        int     $role,
        ?int    $groupCode,
        int     $teamCode,
        ?int    $followerLeader,
        ?int    $followerLeaderAssistant,
        ?string $callScanCode,
        string  $santralCode,
        array   $taskList,
        array   $workTaskList,
        string|null $uyumSatisApiCrmUserName,
        string|null $uyumSatisApiCrmUserPassword
    ): ServiceResponse
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
            'uyumSatisCrmUserName' => $marketingCrmUsername,
            'uyumSatisCrmUserPassword' => $marketingCrmPassword,
            'aktifGorevTanimi' => $activeJobDescription ?? '',
            "uyumCrmCoId" => $uyumCrmCompanyId,
            "uyumCrmBranchId" => $uyumCrmBranchId,
            "uyumCrmBranchCode" => $uyumCrmBranchCode,
            "aktifDonemYili" => $activeYear,
            'rol' => $role,
            'grupKodu' => $groupCode,
            'takimKodu' => $teamCode,
            'takipLideri' => $followerLeader,
            'takipLiderYardimcisi' => $followerLeaderAssistant,
            'cagriTaramaKodu' => $callScanCode,
            'kullaniciMail' => $email,
            'dahili' => $santralCode,
            'taskList' => $taskList,
            'workTaskList' => $workTaskList,
            'uyumSatisApiCrmUserName' => $uyumSatisApiCrmUserName,
            'uyumSatisApiCrmUserPassword' => $uyumSatisApiCrmUserPassword
        ];

        return new ServiceResponse(
            true,
            'Set employee',
            200,
            [
                'guid' => $this->callApi($this->baseUrl . $endpoint, 'post', $headers, $params)->body(),
                'params' => $params
            ]
        );
    }

    /**
     * @param int $guid
     *
     * @return ServiceResponse
     */
    public function GetEmployeeTasksEdit(
        int $guid
    ): ServiceResponse
    {
        $endpoint = "Operation/GetEmployeeTasksEdit";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $params = [
            'Id' => $guid
        ];

        return new ServiceResponse(
            true,
            'Get employee tasks edit',
            200,
            $this->callApi($this->baseUrl . $endpoint, 'get', $headers, $params)['response']
        );
    }

    /**
     * @param int $guid
     *
     * @return ServiceResponse
     */
    public function GetEmployeeWorkTasksEdit(
        int $guid
    ): ServiceResponse
    {
        $endpoint = "Operation/GetEmployeeWorkTasksEdit";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $params = [
            'Id' => $guid
        ];

        return new ServiceResponse(
            true,
            'Get employee work tasks edit',
            200,
            $this->callApi($this->baseUrl . $endpoint, 'get', $headers, $params)['response']
        );
    }

    /**
     * @param int $guid
     *
     * @return ServiceResponse
     */
    public function GetEmployeeGroupTasksEdit(
        int $guid
    ): ServiceResponse
    {
        $endpoint = "Operation/GetEmployeeGroupTasksEdit";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $params = [
            'Id' => $guid
        ];

        return new ServiceResponse(
            true,
            'Get employee group tasks edit',
            200,
            $this->callApi($this->baseUrl . $endpoint, 'get', $headers, $params)['response']
        );
    }

    /**
     * @param int $guid
     * @param array|null $tasks
     *
     * @return ServiceResponse
     */
    public function SetEmployeeTasksInsert(
        int        $guid,
        array|null $tasks = []
    ): ServiceResponse
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

        return new ServiceResponse(
            true,
            'Set employee tasks insert',
            200,
            $this->callApi($this->baseUrl . $endpoint, 'post', $headers, $list)['response']
        );
    }

    /**
     * @param int $guid
     * @param array|null $workTasks
     *
     * @return ServiceResponse
     */
    public function SetEmployeeWorkTasksInsert(
        int        $guid,
        array|null $workTasks = []
    ): ServiceResponse
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

        return new ServiceResponse(
            true,
            'Set employee work tasks insert',
            200,
            $this->callApi($this->baseUrl . $endpoint, 'post', $headers, $list)['response']
        );
    }

    /**
     * @param int $guid
     * @param array|null $groupTasks
     *
     * @return ServiceResponse
     */
    public function SetEmployeeGroupTasksInsert(
        int        $guid,
        array|null $groupTasks = []
    ): ServiceResponse
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

        return new ServiceResponse(
            true,
            'Set employee group tasks insert',
            200,
            $this->callApi($this->baseUrl . $endpoint, 'post', $headers, $list)['response']
        );
    }

    /**
     * @param int $id
     *
     * @return ServiceResponse
     */
    public function SetEmployeeTasksDelete(
        int $id
    ): ServiceResponse
    {
        $endpoint = "Operation/SetEmployeeTasksDelete";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $params = [
            'Id' => $id
        ];

        return new ServiceResponse(
            true,
            'Set employee tasks delete',
            200,
            $this->callApi($this->baseUrl . $endpoint . '?' . http_build_query($params), 'post', $headers, $params)['response']
        );
    }

    /**
     * @param int $id
     *
     * @return ServiceResponse
     */
    public function SetEmployeeWorkTasksDelete(
        int $id
    ): ServiceResponse
    {
        $endpoint = "Operation/SetEmployeeWorkTasksDelete";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $params = [
            'Id' => $id
        ];

        return new ServiceResponse(
            true,
            'Set employee work tasks delete',
            200,
            $this->callApi($this->baseUrl . $endpoint . '?' . http_build_query($params), 'post', $headers, $params)['response']
        );
    }

    /**
     * @param int $id
     *
     * @return ServiceResponse
     */
    public function SetEmployeeGroupTasksDelete(
        int $id
    ): ServiceResponse
    {
        $endpoint = "Operation/SetEmployeeGroupTasksDelete";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $params = [
            'Id' => $id
        ];

        return new ServiceResponse(
            true,
            'Set employee group tasks delete',
            200,
            $this->callApi($this->baseUrl . $endpoint . '?' . http_build_query($params), 'post', $headers, $params)['response']
        );
    }

    /**
     * @param int $id
     *
     * @return ServiceResponse
     */
    public function GetEmployeeEdit(
        int $id
    ): ServiceResponse
    {
        $endpoint = "Operation/GetEmployeeEdit";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $params = [
            'Id' => $id
        ];

        return new ServiceResponse(
            true,
            'Get employee edit',
            200,
            $this->callApi($this->baseUrl . $endpoint, 'get', $headers, $params)['response']
        );
    }

    /**
     * @param array $staffParameters
     *
     * @return ServiceResponse
     */
    public function SetStaffParameter(
        array $staffParameters
    ): ServiceResponse
    {
        $endpoint = "Operation/SetStaffParameter";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        return new ServiceResponse(
            true,
            'Set staff parameter',
            200,
            $this->callApi($this->baseUrl . $endpoint, 'post', $headers, $staffParameters)['response']
        );
    }

    /**
     * @param array $companyIds
     * @param string $startDate
     * @param string $endDate
     *
     * @return ServiceResponse
     */
    public function SetStaffParameterByCompanyId(
        array  $companyIds,
        string $startDate,
        string $endDate,
    ): ServiceResponse
    {
        $endpoint = "Operation/SetStaffParameter";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $shifts = Shift::whereIn('company_id', $companyIds)->whereBetween('start_date', [
            $startDate . ' 00:00:00',
            $endDate . ' 23:59:59'
        ])->get();

        $staffParameters = [];

        foreach ($shifts as $shift) {
            $shiftGroup = ShiftGroup::find($shift->shift_group_id);
            $staffParameters[] = [
                "vardiyaId" => $shift->id,
                "kullanicilarId" => $shift->employee->guid,
                "tarih" => date('Y-m-d', strtotime($shift->start_date)),
                "yemekBaslangicSaati" => date('Y-m-d', strtotime($shift->start_date)) . ' ' . $shiftGroup->food_break_start,
                "yemekBitisSaati" => date('Y-m-d', strtotime($shift->start_date)) . ' ' . $shiftGroup->food_break_end,
                "yemekMolasindaIhtiyacMolasi" => $shiftGroup->get_break_while_food_time,
                "yemekMolasiDisindaYemekMolasi" => $shiftGroup->get_food_break_without_food_time,
                "birMolaHakkiDakikasi" => $shiftGroup->single_break_duration,
                "vardiyaBasiIlkMolaHakkiDakikasi" => $shiftGroup->get_first_break_after_shift_start,
                "vardiyaSonuMolaYasagiDakikasi" => $shiftGroup->get_last_break_before_shift_end,
                "sonMoladanSonraMolaMusadesiDakikasi" => $shiftGroup->get_break_after_last_break,
                "gunlukYemekMolasiHakkiSayisi" => $shiftGroup->daily_food_break_amount,
                "gunlukToplamMolaDakikasi" => intval(date('w', strtotime($shift->start_date))) == 5 ?
                    $shiftGroup->daily_break_duration + $shiftGroup->friday_additional_break_duration : $shiftGroup->daily_break_duration,
                "gunlukYemekMolasiDakikasi" => $shiftGroup->daily_food_break_duration,
                "gunlukIhtiyacMolasiDakikasi" => intval(date('w', strtotime($shift->start_date))) == 5 ?
                    $shiftGroup->daily_break_break_duration + $shiftGroup->friday_additional_break_duration : $shiftGroup->daily_break_break_duration,
                "anlikYemekMolasiDakikasi" => $shiftGroup->momentary_food_break_duration,
                "anlikIhtiyacMolasiDakikasi" => $shiftGroup->momentary_break_break_duration,
                "molaKullanimKisitlamasiVarMi" => $shiftGroup->suspend_break_using
            ];
        }

        $response = $this->callApi($this->baseUrl . $endpoint, 'post', $headers, $staffParameters);

        return new ServiceResponse(
            true,
            $response['message'],
            200,
            $staffParameters
        );
    }

    /**
     * @param int $shiftId
     *
     * @return ServiceResponse
     */
    public function GetStaffParameterEdit(
        int $shiftId
    ): ServiceResponse
    {
        $endpoint = "Operation/GetStaffParameterEdit";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $params = [
            'VardiyaId' => $shiftId
        ];

        return new ServiceResponse(
            true,
            'Get staff parameter edit',
            200,
            $this->callApi($this->baseUrl . $endpoint . '?' . http_build_query($params), 'get', $headers, $params)['response'][0]
        );
    }

    /**
     * @param array $list
     *
     * @return ServiceResponse
     */
    public function SetStaffParameterUpdate(
        array $list
    ): ServiceResponse
    {
        $endpoint = "Operation/SetStaffParameterUpdate";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        return new ServiceResponse(
            true,
            'Set staff parameter update',
            200,
            $this->callApi($this->baseUrl . $endpoint, 'post', $headers, $list)['response']
        );
    }

    /**
     * @param int $shiftId
     *
     * @return ServiceResponse
     */
    public function SetStaffParameterDelete(
        int $shiftId
    ): ServiceResponse
    {
        $endpoint = "Operation/SetStaffParameterDelete";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $params = [
            'VardiyaId' => $shiftId
        ];

        return new ServiceResponse(
            true,
            'Set staff parameter delete',
            200,
            $this->callApi($this->baseUrl . $endpoint . '?' . http_build_query($params), 'post', $headers, $params)['response']
        );
    }
}
