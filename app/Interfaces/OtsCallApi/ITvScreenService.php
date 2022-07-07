<?php


namespace App\Interfaces\OtsCallApi;

use App\Services\ServiceResponse;

interface ITvScreenService
{
    /**
     * @return ServiceResponse
     */
    public function GetSantral(): ServiceResponse;
}
