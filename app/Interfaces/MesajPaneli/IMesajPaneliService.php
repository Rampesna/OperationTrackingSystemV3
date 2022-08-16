<?php

namespace App\Interfaces\MesajPaneli;

use App\Services\ServiceResponse;

interface IMesajPaneliService
{
    /**
     * @param array $messages
     *
     * @return ServiceResponse
     */
    public function sendSms(
        array $messages
    ): ServiceResponse;
}
