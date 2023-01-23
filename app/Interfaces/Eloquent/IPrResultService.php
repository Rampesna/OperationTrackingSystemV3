<?php
namespace App\Interfaces\Eloquent;
use App\Interfaces\Eloquent\IEloquentService;
use App\Services\ServiceResponse;

interface IPrResultService extends IEloquentService
{
    /**
     * @param int $prCardId
     * @param string $date
     *
     * @return ServiceResponse
     */
    public function getResult(
        int $prCardId,
        string $date,
    ): ServiceResponse;
}
