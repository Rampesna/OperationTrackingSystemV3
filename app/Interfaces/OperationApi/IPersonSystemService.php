<?php

namespace App\Interfaces\OperationApi;

use App\Services\ServiceResponse;

interface IPersonSystemService
{
    /**
     * @param array $guids
     * @param int $education
     * @param int $assignment
     * @param int $teamLead
     * @param int $teamLeadAssistant
     *
     * @return ServiceResponse
     */
    public function SetPersonAuthority(
        array $guids,
        int   $education,
        int   $assignment,
        int   $teamLead,
        int   $teamLeadAssistant
    );

    /**
     * @param int $otsLockType
     * @param array $list
     *
     * @return ServiceResponse
     */
    public function SetPersonDisplayType(
        int   $otsLockType,
        array $list
    );

    /**
     * @return ServiceResponse
     */
    public function GetPersonDataScanList();

    /**
     * @param int $groupCode
     * @param array $guids
     *
     * @return ServiceResponse
     */
    public function SetPersonDataScan(
        int   $groupCode,
        array $guids
    );

    /**
     * @param int $jobCode
     * @param array $guids
     *
     * @return ServiceResponse
     */
    public function SetPersonWorkToDoType(
        int   $jobCode,
        array $guids
    );
}
