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
     * @param array $list
     */
    public function SetPersonDisplayType(
        $list
    );

    public function GetPersonDataScanList();

    /**
     * @param array $list
     */
    public function SetPersonDataScan(
        $list
    );

    /**
     * @param array $list
     */
    public function SetPersonWorkToDoType(
        $list
    );
}
