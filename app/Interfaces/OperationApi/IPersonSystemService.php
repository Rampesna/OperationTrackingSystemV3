<?php

namespace App\Interfaces\OperationApi;

interface IPersonSystemService
{
    /**
     * @param array $list
     */
    public function SetPersonAuthority(
        $guids,
        $education,
        $assignment,
        $teamLead,
        $teamLeadAssistant
    );

    /**
     * @param int $otsLockType
     * @param array $guids
     */
    public function SetPersonDisplayType(
        int   $otsLockType,
        array $list
    );

    public function GetPersonDataScanList();

    /**
     * @param int $groupCode
     * @param array $guids
     */
    public function SetPersonDataScan(
        int   $groupCode,
        array $guids
    );

    /**
     * @param int $jobCode
     * @param array $guids
     */
    public function SetPersonWorkToDoType(
        int   $jobCode,
        array $guids
    );
}
